<template>
  <div class="p-4">
    <h1 class="text-3xl font-bold mb-4">Document List</h1>
    <router-link
      to="/documents/create"
      class="bg-blue-500 text-white rounded-md py-2 px-4 mb-4 inline-block hover:bgblue-600 transition-colors"
      >Create a new Document</router-link
    >
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div
        v-for="document in documents"
        :key="document.id"
        class="bg-white rounded-lg p-4 shadow-md"
      >
        <img :src="document.foto_ktp" alt="" />
        <router-link
          :to="`/documents/${document.id}`"
          class="bg-blue-500 text-white rounded-md py-2 px-4 mt-4 inline-block hover:bg-blue-600 transition-colors"
          >View detail Image</router-link
        >
      </div>
    </div>
  </div>
</template>
<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const documents = ref([]);
onMounted(async () => {
  const response = await axios.get("http://localhost:8000/api/documents", {
    headers: {
      Authorization: `Bearer ${authStore.accessToken}`,
    },
  });
  documents.value = response.data.data;
});
</script>
