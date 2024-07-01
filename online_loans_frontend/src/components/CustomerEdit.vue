<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Edit Users</h1>
    <form
      v-if="customers"
      @submit.prevent="updateCustomers"
      class="flex flex-col space-y-4"
    >
      <label class="text-lg font-semibold" for="nama_peminjam"
        >Nama Peminjam:</label
      >
      <input
        v-model="customers.nama_peminjam"
        type="text"
        class="border rounded-md p-2"
        id="nama_peminjam"
      />
      <br />
      <label class="text-lg font-semibold" for="umur">Umur :</label>
      <input
        v-model="customers.umur"
        type="text"
        class="border rounded-md p-2"
        id="umur"
      />
      <br />
      <label class="text-lg font-semibold">Nomor Rekening:</label>
      <input
        v-model="customers.nomor_rekening"
        type="text"
        class="border rounded-md p-2"
      />
      <br />
      <button
        type="submit"
        class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors"
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
const customers = ref(null);
onMounted(async () => {
  const response = await axios.get(
    `http://localhost:8000/api/customers/${route.params.id}`,
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  customers.value = response.data.data;
});
const updateCustomers = async () => {
  await axios.put(
    `http://localhost:8000/api/customers/${customers.value.id}`,
    {
      nama_peminjam: customers.value.nama_peminjam,
      umur: customers.value.umur,
      nomor_rekening: customers.value.nomor_rekening,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push(`/customers/${customers.value.id}`);
};
</script>
