<template>
    <!-- MODAL -->
    <button @click="addWorkOrder" class="btn w-60 btn-lg btn-outline mt-8 text-accent text-2xl shadow-2xl hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent-600">Add Work Order</button>
    
    <div v-for="(workOrder, index) in workOrders" :key="index">
      <Modal :show="workOrder.showModal" @close="closeModal(index)" :workOrder="workOrder"></Modal>
    </div>
    <!-- Modal ends -->
  </template>
  
  <script>
  import { ref } from 'vue';
  import Modal from './Modal.vue';
  import { usePage } from '@inertiajs/vue3';
  
  export default {
    components: {
      Modal,
    },
    setup() {
      const { props } = usePage();
      const workOrders = ref(props.workOrders || []);
  
      const addWorkOrder = () => {
        workOrders.value.push({
          id: Date.now(), // Unique ID for each work order
          title: '',
          description: '',
          scheduled_at: '',
          images: [],
          notes: '',
          showModal: true,
        });
      };
  
      const closeModal = (index) => {
        workOrders.value[index].showModal = false;
      };
  
      return {
        workOrders,
        addWorkOrder,
        closeModal,
      };
    },
  };
  const flashMessageVisible = ref(true);
const closeFlashMessage = () => {
  flashMessageVisible.value = false;
};
  </script>
  
  <style scoped>
  /* Add any styles you need here */
  </style>