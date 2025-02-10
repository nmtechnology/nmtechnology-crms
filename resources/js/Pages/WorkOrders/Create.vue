<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">{{ workOrder.title }}</h1>
      <p><strong>Description:</strong> {{ workOrder.description }}</p>
      <p><strong>Scheduled At:</strong> {{ workOrder.scheduled_at }}</p>
      <p><strong>Status:</strong> {{ workOrder.status }}</p>
      <p><strong>Notes:</strong> {{ workOrder.notes }}</p>
      <div v-if="workOrder.images && workOrder.images.length">
        <h2 class="text-xl font-bold mt-4">Attachments</h2>
        <ul>
          <li v-for="(image, index) in workOrder.images" :key="index">
            <a :href="`/storage/${image}`" target="_blank">{{ image }}</a>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  
  export default {
    name: 'Create',
    setup() {
      const route = useRoute();
      const workOrder = ref(null);
  
      const fetchWorkOrder = async () => {
        try {
          const response = await axios.get(`/api/work-orders/${route.params.id}`);
          workOrder.value = response.data;
        } catch (error) {
          console.error('Error fetching work order:', error);
        }
      };
  
      onMounted(fetchWorkOrder);
  
      return {
        workOrder,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add any styles you need here */
  </style>