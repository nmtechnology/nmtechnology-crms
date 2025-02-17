<template>
  <div>
    <button @click="openCreateModal" class="btn btn-primary">Add Workorder</button>

    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
      <div class="bg-gray-800 p-6 rounded-lg">
        <h2>{{ mode === 'create' ? 'Create Work Order' : 'Edit Work Order' }}</h2>
        <form @submit.prevent="submit">
          <!-- Form fields for title, description, date & time, price, customer text input, file upload, notes -->
          <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" v-model="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent" required>
          </div>
          <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent" required></textarea>
          </div>
          <div class="mb-4">
            <label for="date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
            <input type="datetime-local" v-model="date_time" id="date_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent" required>
          </div>
          <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" v-model="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent" required>
          </div>
          <div class="mb-4">
            <label for="customer" class="block text-sm font-medium text-gray-700">Customer</label>
            <input type="text" v-model="customer" id="customer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent" required>
          </div>
          <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700">File</label>
            <input type="file" @change="handleFileUpload" id="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent">
          </div>
          <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea v-model="notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-transparent"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">{{ mode === 'create' ? 'Create' : 'Update' }} Work Order</button>
          <button type="button" @click="close" class="btn btn-secondary">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    show: Boolean,
    mode: String,
    workOrder: Object,
  },
  setup(props, { emit }) {
    const showModal = ref(false);
    const mode = ref('create');
    const title = ref('');
    const description = ref('');
    const date_time = ref('');
    const price = ref('');
    const customer = ref('');
    const file = ref(null);
    const notes = ref('');

    watch(props, (newProps) => {
      if (newProps.workOrder) {
        mode.value = 'edit';
        title.value = newProps.workOrder.title || '';
        description.value = newProps.workOrder.description || '';
        date_time.value = newProps.workOrder.date_time || '';
        price.value = newProps.workOrder.price || '';
        customer.value = newProps.workOrder.customer || '';
        notes.value = newProps.workOrder.notes || '';
      }
    });

    function openCreateModal() {
      mode.value = 'create';
      title.value = '';
      description.value = '';
      date_time.value = '';
      price.value = '';
      customer.value = '';
      notes.value = '';
      showModal.value = true;
    }

    function submit() {
      const formData = new FormData();
      formData.append('title', title.value);
      formData.append('description', description.value);
      formData.append('date_time', date_time.value);
      formData.append('price', price.value);
      formData.append('customer', customer.value);
      if (file.value) {
        formData.append('file', file.value);
      }
      formData.append('notes', notes.value);

      if (mode.value === 'create') {
        Inertia.post('/work-orders', formData);
      } else {
        Inertia.put(`/work-orders/${props.workOrder.id}`, formData);
      }

      close();
    }

    function close() {
      showModal.value = false;
      emit('close');
    }

    return {
      showModal,
      mode,
      title,
      description,
      date_time,
      price,
      customer,
      file,
      notes,
      submit,
      close,
      openCreateModal,
    };
  },
};
</script>

<style scoped>
.btn {
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
}

.btn-primary {
  background-color: green;
  color: white;
}

.btn-secondary {
  background-color: transparent;
  color: #374151;
}

.fixed {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.5);
  z-index: 50; /* Ensure the modal has a higher z-index */
}

.bg-white {
  background-color: transparent;
}

.p-6 {
  padding: 1.5rem;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.shadow-lg {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.mb-4 {
  margin-bottom: 1rem;
}

.text-xl {
  font-size: 1.25rem;
}

.font-bold {
  font-weight: 700;
}

.block {
  display: block;
}

.text-sm {
  font-size: 0.875rem;
}

.font-medium {
  font-weight: 500;
}

.text-gray-700 {
  color: #4a5568;
}

.mt-1 {
  margin-top: 0.25rem;
}

.w-full {
  width: 100%;
}

.border {
  border-width: 1px;
}

.border-gray-300 {
  border-color: #d2d6dc;
}

.rounded-md {
  border-radius: 0.375rem;
}

.shadow-sm {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.focus\:ring-indigo-500:focus {
  --tw-ring-color: outline-green-400;
}

.focus\:border-indigo-500:focus {
  border-color: #6cae00
}

.sm\:text-sm {
  font-size: 0.875rem;
}

.flex {
  display: flex;
}

.justify-end {
  justify-content: flex-end;
}

.mr-2 {
  margin-right: 0.5rem;
}

.bg-transparent {
  background-color: transparent;
}
</style>