<template>
  <h1 class="mt-10 text-accent text-2xl">NM Tech's AI Assistant Jerry The Janitor</h1>
  <div class="p-4 border border-accent rounded-md">
    <div class="flex items-center gap-4">
      <input 
        v-model="query" 
        type="text" 
        placeholder="Ask a question" 
        class="flex-1 bg-transparent border border-accent rounded-md px-4 py-2 text-accent focus:outline-none focus:ring-2 focus:ring-accent"
      />
      <button 
        @click="submitQuery" 
        class="border border-green-500 text-green-500 px-6 py-2 rounded-md hover:bg-green-500 hover:text-white transition-colors duration-200"
        :disabled="!query"
      >
        Ask
      </button>
    </div>

    <div v-if="response" class="mt-4 border border-accent rounded-md p-4">
      <h2 class="font-bold mb-2 text-accent">Response:</h2>
      <p class="text-green-500">{{ response }}</p>
    </div>

    <div v-if="error" class="mt-4 border border-red-500 rounded-md p-4">
      <h2 class="font-bold mb-2 text-red-500">Error:</h2>
      <p class="text-red-500">{{ error }}</p>
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
      if (!query.value) return;

      try {
        const { data } = await axios.post('/api/groq/query', {
          query: query.value
        });
        
        response.value = data.response;
        error.value = null;
      } catch (err) {
        console.error('Groq API Error:', err);
        error.value = err.response?.data?.error || 'An error occurred while processing your request';
        response.value = null;
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
input::placeholder {
  @apply text-accent opacity-50;
}

button:disabled {
  @apply opacity-50 cursor-not-allowed;
}
</style>