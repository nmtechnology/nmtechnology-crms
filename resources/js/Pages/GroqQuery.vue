<template>
  <h1 class="mt-10 text-accent text-2xl">NM Tech's AI Assistant Jerry The Janitor</h1>
  <div class="outline text-accent rounded-sm">
    <input v-model="query" type="text" placeholder="Ask a question" class="bg-transparent outline text-accent rounded-sm ml-5" />
    <button @click="submitQuery" class="outline text-green-500 rounded-sm ml-10 btn-lg m-10">Ask</button>
    <div v-if="response" class="outline text-accent rounded-sm">
      <h2>Response:</h2>
      <p class="text-green-500">{{ response }}</p>
    </div>
    <div v-if="error">
      <h2>Error:</h2>
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';


export default {
  
  setup() {
    const query = ref('');
    const response = ref(null);
    const error = ref(null);

    const submitQuery = async () => {
      try {
        const { data } = await axios.post('/api/groq/query', {
          query: query.value,
        });
        response.value = data.response;
        error.value = null; // Clear any previous errors
      } catch (err) {
        console.error(err);
        error.value = err.response ? err.response.data.message : err.message;
        response.value = null; // Clear any previous response
          }
        };
    
        return {
          query,
          response,
          error,
          submitQuery,
        };
      },
    };

</script>

<style scoped>
/* Add any styles you need here */
</style>