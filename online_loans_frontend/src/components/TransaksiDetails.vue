<template>
  <!-- Render a section containing Transaksi details if there is an Transaksi object -->
  <div class="p-4" v-if="transaksis">
    <!-- Button to navigate back to previous page -->
    <button
      class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4 mb-6"
      @click="goBack"
    >
      &larr; Back
    </button>
    <!-- Title displaying the user's name and the Transaksi details -->
    <h1 class="text-3xl font-bold mb-4">
      {{ transaksis.customer.nama_peminjam }} Transaksi Details
    </h1>
    <!-- Render the product name for the Transaksi -->
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2">Jumlah Pinjaman:</label>
      <p class="text-gray-700 font-semibold">
        {{ transaksis.service.jml_pinjaman }}
      </p>
    </div>
    <!-- Render the quantity for the Transaksi -->
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2">Tanggal Pinjam:</label>
      <p class="text-gray-700 font-semibold">{{ transaksis.tgl_pinjam }}</p>
    </div>
    <!-- Render the total price for the Transaksi -->
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2"
        >Tanggal Pengembalian:</label
      >
      <p class="text-gray-700 font-semibold">
        {{ transaksis.tgl_pengembalian }}
      </p>
    </div>
    <!-- Render the status of the Transaksi -->
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2">Status:</label>
      <p class="text-gray-700 font-semibold">{{ transaksis.status }}</p>
    </div>
    <!-- Render edit and delete buttons for the Transaksi -->
    <div class="flex items-center justify-between">
      <router-link
        :to="{ name: 'transaksiedit', params: { id: transaksis.id } }"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >Edit</router-link
      >
      <button
        type="button"
        @click="deleteTransaksi"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        Delete
      </button>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter, useRoute } from "vue-router";
// Initialize variables for authentication, routing and Transaksi data
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const transaksis = ref(null);
// Fetch the Transaksi data when the component is mounted
onMounted(async () => {
  const response = await axios.get(
    `http://localhost:8000/api/transaksis/${route.params.id}`,
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  // Set the transaksi data to the fetched data
  transaksis.value = response.data.data;
});
// Define function to delete the current Transaksi
const deleteTransaksi = async () => {
  if (confirm("Are you sure you want to delete this Transaksi?")) {
    try {
      await axios.delete(
        `http://localhost:8000/api/transaksis/${route.params.id}`,
        {
          headers: {
            Authorization: `Bearer ${authStore.accessToken}`,
          },
        }
      );
      // Redirect to the Transaksis page after deleting the Transaksi
      router.push({ name: "transaksilist" });
    } catch (error) {
      console.log(error);
    }
  }
};

// Define function to navigate back to the previous page
const goBack = () => {
  router.go(-1);
};
</script>
