<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/documents"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Edit Document</h1>
    <form
      class="flex flex-col space-y-4"
      v-if="documents"
      @submit.prevent="updateDocument"
    >
      <label class="text-lg font-semibold" for="foto_ktp">Foto KTP:</label>
      <input
        class="border rounded-md p-2"
        v-model="documents.foto_ktp"
        type="text"
        id="foto_ktp"
      />
      <label class="text-lg font-semibold" for="bukti_lainnya"
        >Bukti Lainnya:</label
      >
      <input
        class="border rounded-md p-2"
        v-model="documents.bukti_lainnya"
        type="text"
        id="bukti_lainnya"
      />
      <button
        class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors"
        type="submit"
      >
        Save Changes
      </button>
    </form>
  </div>
</template>
<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const documents = ref(null);
onMounted(async () => {
  const response = await axios.get(
    `http://localhost:8000/api/documents/${route.params.id}`,
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  documents.value = response.data.data;
});
const updateDocument = async () => {
  await axios.put(
    `http://localhost:8000/api/documents/${documents.value.id}`,
    {
      foto_ktp: documents.value.foto_ktp,
      bukti_lainnya: documents.value.bukti_lainnya,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push(`/documents/${documents.value.id}`);
};
</script>
