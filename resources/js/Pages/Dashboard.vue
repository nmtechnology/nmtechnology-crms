<template>
  <div>
    <AddWorkorder />
    <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
      <Calendar :workOrders="workOrders" />
      <Index class="mt-40" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import AddWorkorder from '@/Components/AddWorkorder.vue';
import Calendar from '@/Components/Calendar.vue';
import Index from './WorkOrders/Index.vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const workOrders = ref(props.workOrders || []);
</script>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
  layout: AppLayout,
};
</script>

<style scoped>
/* Add any styles you need here */
</style>