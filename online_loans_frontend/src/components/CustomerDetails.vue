<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Customers Details</h1>
    <div v-if="customers" class="bg-white rounded-lg p-4 shadow-md">
      <h3 class="text-xl font-bold mb-2">Nama Peminjam : {{ customers.nama_peminjam }}</h3>
      <p class="text-gray-500 text-sm mb-2"> <h3> Umur : {{ customers.umur }} </h3></p>
      <p class="text-gray-700 font-semibold text-lg mb-4"> <h3>Nomor Rekening : {{ customers.nomor_rekening }} </h3></p>
      <br />
      <div class="flex justify-between">
      <router-link :to="`/customers/${customers.id}/edit`" class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600 transition-colors">Edit</router-link>
      <button @click="deleteCustomers" class="bg-red-500 text-white rounded-md py-2 px-4 hover:bg-red-600 transition-colors">Delete</button>
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
const customers = ref(null);
onMounted(async () => {
  const response = await axios.get(
      `http://localhost:8000/api/customers/${route.params.id}`, {
          headers: {
            Authorization : `Bearer ${authStore.accessToken}`,
        },
    }
  );
  customers.value = response.data.data;
});
const deleteCustomers = async () => {
  if (confirm("Are you sure you want to delete this users?")) {
      await axios.delete(`http://localhost:8000/api/customers/${customers.value.id}`, {
          headers: {
            Authorization : `Bearer ${authStore.accessToken}`,
        },
    });
    router.push("/");
  }
};
</script>