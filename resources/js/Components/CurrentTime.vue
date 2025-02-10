<template>
  <div>
    <p class="text-white">Current Time: {{ currentTime }}</p>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  name: 'CurrentTime',
  setup() {
    const currentTime = ref('');

    const fetchCurrentTime = () => {
      try {
        const response = axios.get('/api/current-time');
        currentTime.value = response.data.current_time;
      } catch (error) {
        console.error('Error fetching current time:', error);
      }
    };

    onMounted(() => {
      fetchCurrentTime();
      // setInterval(fetchCurrentTime, 60000); // Refresh every minute
      setInterval(fetchCurrentTime, 1000); // Refresh every second
    });

    return {
      currentTime,
    };
  },
};
</script>

<style scoped>
/* Add any styles you need here */
</style>