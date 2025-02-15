<template>
  <div><GroqQuery />
    <AddWorkorder class="mt-5" />
    <div class="text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
      <Calendar :workOrders="workOrders" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import AddWorkorder from '@/Components/AddWorkorder.vue';
import Calendar from '@/Components/Calendar.vue';
import { usePage } from '@inertiajs/vue3';
import GroqQuery from './GroqQuery.vue';

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