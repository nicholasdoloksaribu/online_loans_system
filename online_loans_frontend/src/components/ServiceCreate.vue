<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/services"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
      >
        &larr; Back
      </router-link>
    </div>
    <h1 class="text-3xl font-bold mb-4">Create Services</h1>
    <form @submit.prevent="createServices" class="flex flex-col space-y-4">
      <label class="text-lg font-semibold" for="jml_pinjaman"
        >Jumlah Pinjaman:</label
      >
      <input
        v-model="jml_pinjaman"
        type="text"
        class="border rounded-md p-2"
        id="jml_pinjaman"
      />
      <br />
      <label class="text-lg font-semibold" for="jml_bunga">Jumlah Bunga:</label>
      <input
        v-model="jml_bunga"
        type="text"
        class="border rounded-md p-2"
        id="jml_bunga"
      />
      <br />
      <button
        type="submit"
        class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors"
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
const jml_pinjaman = ref("");
const jml_bunga = ref("");
const createServices = async () => {
  await axios.post(
    "http://localhost:8000/api/services",
    {
      jml_pinjaman: jml_pinjaman.value,
      jml_bunga: jml_bunga.value,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push("/services");
};
</script>
