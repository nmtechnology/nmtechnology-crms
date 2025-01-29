<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                  New Work Order
                </h3>
                <div class="mt-2">
                  <form @submit.prevent="submitForm">
                    <div class="mb-4">
                      <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                      <input type="text" v-model="form.title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                      <textarea v-model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                    </div>
                    <div class="mb-4">
                      <label for="scheduled_at" class="block text-sm font-medium text-gray-700">Scheduled Date and Time</label>
                      <input type="datetime-local" v-model="form.scheduled_at" id="scheduled_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                      <label for="images" class="block text-sm font-medium text-gray-700">Attachments</label>
                      <input type="file" @change="handleFileUpload" id="images" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" multiple>
                    </div>
                    <div class="mb-4">
                      <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                      <textarea v-model="form.notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mt-5 sm:mt-6">
                      <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-success text-base font-medium text-white hover:bg-success focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success sm:text-lg">
                        Submit
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    props: {
      show: {
        type: Boolean,
        required: true,
      },
    },
    emits: ['close'],
    setup(props, { emit }) {
      const form = ref({
        title: '',
        description: '',
        scheduled_at: '',
        images: [],
        notes: '',
      });
  
      const handleFileUpload = (event) => {
        form.value.images = Array.from(event.target.files);
      };
  
      const submitForm = async () => {
        const formData = new FormData();
        formData.append('title', form.value.title);
        formData.append('description', form.value.description);
        formData.append('scheduled_at', form.value.scheduled_at);
        form.value.images.forEach((image, index) => {
          formData.append(`images[${index}]`, image);
        });
        formData.append('notes', form.value.notes);
  
        try {
          await axios.post('/api/work-orders', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
          closeModal();
        } catch (error) {
          console.error('Error creating work order:', error);
        }
      };
  
      const closeModal = () => {
        emit('close');
      };
  
      return {
        form,
        handleFileUpload,
        submitForm,
        closeModal,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add any styles you need here */
  </style>