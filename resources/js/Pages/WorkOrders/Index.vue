<template>
  <div class="mt-5 px-4 sm:px-6 lg:px-8 w-full mx-auto">
    <div class="sm:flex sm:items-center outline text-accent rounded-lg">
      <div class="sm:flex-auto">
        <h1 class="text-2xl font-bold mb-4 text-accent p-2">Active Work Orders</h1>
        <p class="mt-2 text-sm text-green-400 p-4">A list of all the work orders in your account including their title, description, and status.</p>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <div class="p-4">
          <AddWorkorder class="justify-end" />
        </div>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="scrollable-container -mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-accent shadow sm:rounded-lg">
            <div class="table-wrapper">
              <table class="min-w-full divide-y divide-accent table-fixed table-zebra outline outline-green-400">
                <thead class="bg-gray-900 backdrop-blur-md opacity-95">
                  <tr>
                    <th scope="col" class="sticky top-0 z-10 py-3.5 pl-4 pr-3 text-left text-2xl font-semibold text-accent sm:pl-0">Title</th>
                    <th scope="col" class="sticky top-0 z-10 px-3 py-3.5 text-left text-2xl font-semibold text-accent">Description</th>
                    <th scope="col" class="sticky top-0 z-10 px-3 py-3.5 text-left text-2xl font-semibold text-accent">Scheduled Time</th>
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
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-accent description-column">
                      <div class="text-accent-300">{{ workOrder.description }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-accent">
                      <div class="text-green-400">{{ formatDate(workOrder.scheduled_at) }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                      <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ workOrder.status }}</span>
                    </td>
                    <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <button @click="openModal(workOrder)" class="text-warning hover:text-warning-900">
                        View<span class="sr-only">, {{ workOrder.title }}</span>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <WorkOrder v-if="selectedWorkOrder" :workOrder="selectedWorkOrder" :showModal="showModal" @close="closeModal" />
  </div>
</template>

<script>
import { ref } from 'vue';
import { format } from 'date-fns';
import { usePage } from '@inertiajs/vue3';
import AddWorkorder from '@/Components/AddWorkorder.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Alert from '@/Components/alert.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import WorkOrder from './WorkOrder.vue';

export default {
  layout: AppLayout,
  name: 'WorkOrdersIndex',
  components: {
    AddWorkorder,
    Alert,
    ApplicationLogo,
    WorkOrder,
  },
  setup() {
    const { props } = usePage();
    const workOrders = ref(props.workOrders || []);
    const selectedWorkOrder = ref(null);
    const showModal = ref(false);

    const openModal = (workOrder) => {
      selectedWorkOrder.value = workOrder;
      showModal.value = true;
    };

    const closeModal = () => {
      showModal.value = false;
      selectedWorkOrder.value = null;
    };

    const formatDate = (date) => {
      return format(new Date(date), 'MMMM dd, yyyy hh:mm a');
    };

    return {
      workOrders,
      selectedWorkOrder,
      showModal,
      openModal,
      closeModal,
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

.description-column {
  max-width: 200px; /* Adjust the max-width as needed */
  word-wrap: break-word;
}
</style>