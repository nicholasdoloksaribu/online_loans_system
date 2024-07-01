<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
      >
        &larr; Back
      </router-link>
    </div>
    <h1 class="text-3xl font-bold mb-4">Create Users</h1>
    <form @submit.prevent="createCustomers" class="flex flex-col space-y-4">
      <label class="text-lg font-semibold" for="nama_peminjam"
        >Nama Peminjam:</label
      >
      <input
        v-model="nama_peminjam"
        type="text"
        class="border rounded-md p-2"
        id="nama_peminjam"
      />
      <br />
      <label class="text-lg font-semibold" for="umur">Umur:</label>
      <input
        v-model="umur"
        type="text"
        class="border rounded-md p-2"
        id="umur"
      />
      <br />
      <label class="text-lg font-semibold" for="nomor_rekening"
        >Nomor Rekening:</label
      >
      <input
        v-model="nomor_rekening"
        type="text"
        class="border rounded-md p-2"
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
const nama_peminjam = ref("");
const umur = ref("");
const nomor_rekening = ref("");
const createCustomers = async () => {
  await axios.post(
    "http://localhost:8000/api/customers",
    {
      nama_peminjam: nama_peminjam.value,
      umur: umur.value,
      nomor_rekening: nomor_rekening.value,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push("/");
};
</script>
