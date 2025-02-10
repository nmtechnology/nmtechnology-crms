<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
          <div class="bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-2xl leading-6 font-medium text-accent" id="modal-title">
                  New Work Order 
                </h3>
                <div class="mt-2">
                  <form @submit.prevent="submitForm">
                    <div class="mb-4">
                      <label for="title" class="block text-sm font-medium text-accent bg-slate-700" placeholder="CCTV / WO####### / CITY">Title</label>
                      <input type="text" v-model="form.title" id="title" class="mt-1 block w-full rounded-md bg-slate-800 border-gray-300 shadow-sm focus:border-white focus:ring-white sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                      <label for="description" class="block text-sm font-medium text-accent">Description</label>
                      <textarea v-model="form.description" id="description" class="mt-1 block w-full rounded-md bg-slate-800 border-gray-300 shadow-sm focus:border-white focus:ring-white sm:text-sm" required></textarea>
                    </div>
                    <div class="mb-4">
                      <label for="scheduled_at" class="block text-sm font-medium text-accent">Scheduled Date and Time</label>
                      <input type="datetime-local" v-model="form.scheduled_at" id="scheduled_at" class="mt-1 block w-full rounded-md bg-slate-800 border-gray-300 shadow-sm focus:border-white focus:ring-white sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                      <label for="images" class="block text-sm font-medium text-accent">Attachments</label>
                      <input type="file" @change="handleFileUpload" id="images" class="mt-1 block w-full rounded-md bg-slate-800 border-gray-300 shadow-sm focus:border-white focus:ring-white sm:text-sm" multiple>
                    </div>
                    <div class="mb-4">
                      <label for="notes" class="block text-sm font-medium text-accent">Notes</label>
                      <textarea v-model="form.notes" id="notes" class="mt-1 block w-full rounded-md bg-slate-800 border-gray-300 shadow-sm focus:border-white focus:ring-white sm:text-sm"></textarea>
                    </div>
                        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse sm:mt-6 rounded">
                            <button @click="closeModal" type="button" class="mt-6 w-full inline-flex justify-center rounded border border-gray-300 shadow-sm px-4 py-2 bg-red-600 font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        
                      <button type="submit" class="mt-6 w-full inline-flex justify-center rounded border border-gray-300 shadow-sm px-4 py-2 bg-success text-base font-medium text-white hover:bg-success focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success sm:text-sm">
                        Submit
                      </button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
import CurrentTime from './CurrentTime.vue';
import { useForm } from '@inertiajs/vue3';
  
  export default {
    props: {
      show: {
        type: Boolean,
        required: true,
      },
    },
    emits: ['close'],
    setup(props, { emit }) {
      const form = useForm({
        title: '',
        description: '',
        scheduled_at: '',
        images: [],
        notes: '',
      });
  
      const handleFileUpload = (event) => {
        form.value.images = Array.from(event.target.files);
      };
  
      const submitForm = () => {
      form.post('/api/work-orders', {
        onSuccess: () => closeModal(),
        onError: (errors) => {
          console.error('Error creating work order. Please try again:', errors);
        },
      });
    };

      // const submitForm = async () => {
      //   const formData = new FormData();
      //   formData.append('title', form.value.title);
      //   formData.append('description', form.value.description);
      //   formData.append('scheduled_at', form.value.scheduled_at);
      //   form.value.images.forEach((image, index) => {
      //     formData.append(`images[${index}]`, image);
      //   });
      //   formData.append('notes', form.value.notes);
  
      //   try {
      //     await axios.post('/api/work-orders', formData, {
      //       headers: {
      //         'Content-Type': 'multipart/form-data',
      //       },
      //     });
      //     closeModal();
      //   } catch (error) {
      //     console.error('Error creating work order. Please try again:', error);
      //   }
      // };
  
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