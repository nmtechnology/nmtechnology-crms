<template>
    <div>
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
          <div class="bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-2xl leading-6 font-medium text-accent" id="modal-title">
                  Work Order Details
                </h3>
                <div class="mt-2">
                  <div v-if="workOrder">
                    <h1>{{ workOrder.title }}</h1>
                    <p>{{ workOrder.description }}</p>
                    <p>{{ formatDate(workOrder.scheduled_at) }}</p>
                    <p>{{ workOrder.status }}</p>
                  </div>
                  <div v-else>
                    <p>Loading...</p>
                  </div>
                </div>
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse sm:mt-6 rounded">
                  <button @click="closeModal" type="button" class="mt-6 w-full inline-flex justify-center rounded border border-gray-300 shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success sm:text-sm">
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, watch } from 'vue';
  import { format } from 'date-fns';
  
  export default {
    name: 'WorkOrder',
    props: {
      workOrder: {
        type: Object,
        required: true,
      },
      showModal: {
        type: Boolean,
        required: true,
      },
    },
    setup(props, { emit }) {
      const formatDate = (date) => {
        return format(new Date(date), 'MMMM dd, yyyy hh:mm a');
      };
  
      const closeModal = () => {
        emit('close');
      };
  
      watch(() => props.showModal, (newVal) => {
        if (!newVal) {
          closeModal();
        }
      });
  
      return {
        formatDate,
        closeModal,
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
    background-color: hsl(90, 100%, 50%);
    color: white;
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
  }
  
  .bg-white {
    background-color: white;
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
    --tw-ring-color: #6cae00;
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
  </style>