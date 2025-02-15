<template>
  <div>
    <Alert class="alert" v-if="$page.props.flash.message">{{ $page.props.flash.message }}<button @click="closeFlashMessage" class="absolute top-0 right-0 mt-2 mr-2 text-green-600 hover:text-green-400">
    </button></Alert>
  </div>
  <div>
    <Calendar :workOrders="workOrders" />
    <div class="text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
      <GroqQuery />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Calendar from '@/Components/Calendar.vue'
import { usePage } from '@inertiajs/vue3';
import GroqQuery from './GroqQuery.vue';
import Alert from '@/Components/alert.vue';

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