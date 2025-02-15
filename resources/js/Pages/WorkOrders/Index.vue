<template>
  <Head title="Index" />
  <div class="mt-5 px-4 sm:px-6 lg:px-8 w-full mx-auto">
    <div class="sm:flex sm:items-center outline text-accent rounded-lg">
      <div class="sm:flex-auto">
        <h1 class="text-2xl font-bold mb-4 text-accent p-2">Active Work Orders</h1>
        <p class="mt-2 text-sm text-green-400 p-4">A list of all the work orders in your account including their title, description, and status.</p>
      </div>
      <alert class="alert" v-if="$page.props.flash.message">{{ $page.props.flash.message }}<button @click="closeFlashMessage" class="absolute top-0 right-0 mt-2 mr-2 text-black hover:text-gray-700">
              <XMarkIcon class="size-6" aria-hidden="true" />
            </button></alert>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
          <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 20.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
        </div>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="scrollable-container -mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-accent shadow sm:rounded-lg">
            <div class="table-wrapper">
              <table class="min-w-full divide-y divide-accent table-fixed table-zebra outline outline-green-400">
                <thead class="bg-gray-700">
                  <tr>
                    <th scope="col" class="sticky top-0 z-10 py-3.5 pl-4 pr-3 text-left text-2xl font-semibold text-accent sm:pl-0">Title</th>
                    <th scope="col" class="sticky top-0 z-10 px-3 py-3.5 text-left text-2xl font-semibold text-accent">Description</th>
                    <th scope="col" class="sticky top-0 z-10 px-3 py-3.5 text-left text-2xl font-semibold text-accent">Time</th>
                    <th scope="col" class="sticky top-0 z-10 px-3 py-3.5 text-left text-2xl font-semibold text-accent">Status</th>
                    <th scope="col" class="sticky top-0 z-10 py-3.5 pl-3 pr-4 sm:pr-0">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-accent bg-transparent">
                  <tr v-for="(workOrder, index) in workOrders" :key="index">
                    <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="font-medium text-accent">{{ workOrder.title }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-accent">
                      <div class="text-accent-300">{{ workOrder.description }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-accent">
                      <div class="text-green-400">{{ formatDate(workOrder.scheduled_at) }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                      <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ workOrder.status }}</span>
                    </td>
                    <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <router-link :to="{ name: 'workOrder', params: { id: workOrder.id } }" class="text-warning hover:text-warning-900">
                        Edit<span class="sr-only">, {{ workOrder.title }}</span>
                      </router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { format } from 'date-fns';
import { Head, usePage } from '@inertiajs/vue3';
import AddWorkorder from '@/Components/AddWorkorder.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Alert from '@/Components/alert.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
  layout: AppLayout,
  name: 'WorkOrdersIndex',
  setup() {
    const { props } = usePage();
    const workOrders = ref(props.workOrders || []);

    const closeFlashMessage = () => {
      props.flash.message = null;
    };

    const formatDate = (date) => {
      return format(new Date(date), 'MMMM dd, yyyy hh:mm a');
    };

    return {
      workOrders,
      closeFlashMessage,
      formatDate,
    };
  },
};
</script>

<style scoped>
.scrollable-container {
  max-height: 400px; /* Adjust the height as needed */
  overflow-y: auto;
}

.table-wrapper {
  max-height: 400px; /* Adjust the height as needed */
  overflow-y: auto;
  position: relative;
}

thead th {
  position: sticky;
  top: 0;
  background: #1f2937; /* Match the background color of the thead */
  z-index: 1;
}
</style>