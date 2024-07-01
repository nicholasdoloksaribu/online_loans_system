<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Create Document</h1>
    <form class="flex flex-col space-y-4" @submit.prevent="createDocument">
      <label class="text-lg font-semibold" for="foto_ktp">Foto KTP:</label>
      <input
        class="border rounded-md p-2"
        v-model="foto_ktp"
        type="text"
        id="foto_ktp"
      />
      <label class="text-lg font-semibold" for="bukti_lainnya"
        >Bukti Lainnya:</label
      >
      <input
        class="border rounded-md p-2"
        v-model="bukti_lainnya"
        type="text"
        id="bukti_lainnya"
      />
      <button
        class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors"
        type="submit"
      >
        Create
      </button>
    </form>
  </div>
</template>
<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const router = useRouter();
const foto_ktp = ref("");
const bukti_lainnya = ref("");
const createDocument = async () => {
  await axios.post(
    "http://localhost:8000/api/documents",
    {
      foto_ktp: foto_ktp.value,
      bukti_lainnya: bukti_lainnya.value,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push("/documents");
};
</script>
