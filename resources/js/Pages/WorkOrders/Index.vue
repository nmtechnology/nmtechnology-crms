<template>
       <Head title="Index" />
    <div>
      <h1 class="text-2xl font-bold mb-4">Work Orders</h1>
      <ul>
        <li v-for="(workOrder, index) in workOrders" :key="index">
          <router-link :to="{ name: 'workOrder', params: { id: workOrder.id } }">
            {{ workOrder.title }}
          </router-link>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref, onMounted } from 'vue';
  
  export default {
    name: 'WorkOrdersIndex',
    setup() {
      const workOrders = ref([]);
  
      const fetchWorkOrders = async () => {
        try {
          const response = await axios.get('/api/work-orders');
          workOrders.value = response.data.workOrders;
        } catch (error) {
          console.error('Error fetching work orders:', error);
        }
      };
  
      onMounted(fetchWorkOrders);
  
      return {
        workOrders,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add any styles you need here */
  </style>