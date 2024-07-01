<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/documents"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Document Details</h1>
    <div class="bg-white rounded-lg p-4 shadow-md" v-if="documents">
      <h1 class="mb-4 font-bold text-center text-2xl">Foto KTP</h1>
      <img
        class="mx-auto mb-4 border-8"
        width="400"
        :src="documents.foto_ktp"
        alt=""
      />
      <h1 class="mb-4 font-bold text-center mt-10 text-2xl">
        Foto Bukti Lainnya
      </h1>
      <img
        class="mx-auto mb-4"
        width="500"
        :src="documents.bukti_lainnya"
        alt=""
      />
      <div class="flex justify-between">
        <router-link
          :to="`/documents/${documents.id}/edit`"
          class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors"
          >Edit</router-link
        >
        <button
          @click="deleteDocument"
          class="bg-red-500 text-white rounded-md py-2 px-4 hover:bg-red-600 transition-colors"
        >
          Delete
        </button>
      </div>
    </div>
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
const deleteDocument = async () => {
  if (confirm("Are you sure you want to delete this Document?")) {
    await axios.delete(
      `http://localhost:8000/api/documents/${documents.value.id}`,
      {
        headers: {
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }
    );
    router.push("/documents");
  }
};
</script>
