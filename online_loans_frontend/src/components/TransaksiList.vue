<template>
  <div class="p-4">
    <!-- Header section with title and "Create a new transaksi" button that links to the create transaksi page -->
    <header class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold">Transaksi List</h1>
      <router-link
        to="/transaksi/create"
        class="bg-blue-500 text-white rounded-md py-2 px-4 inline-block hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50"
      >
        Create a new Transaksi
      </router-link>
    </header>

    <!-- Transaksi grid section that loops through transaksi and displays each transaksi details -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div
        v-for="transaksi in transaksis"
        :key="transaksi.id"
        class="bg-white rounded-lg p-4 shadow-md"
      >
        <!-- Transaksi Service name -->
        <h3 class="text-xl font-bold mb-2">
          {{ transaksi.id }}
        </h3>
        <div class="text-sm mb-2">
          <p class="text-gray-500 flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 mr-1.5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>

           <h1 class="font-bold"> Nama Peminjam: {{ transaksi.customer.nama_peminjam }}</h1>
          </p>
          <p class="text-gray-700 font-semibold text-lg">
            Jumlah Pinjaman: {{ transaksi.service.jml_pinjaman }}
          </p>
          <p class="text-gray-500 mb-1 flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 mr-1.5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
              />
            </svg>
            Tanggal Pinjam: {{ transaksi.tgl_pinjam }}
          </p>
          <p class="text-gray-500 mb-1 flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 mr-1.5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
              />
            </svg>
            Tanggal Pengembalian: {{ transaksi.tgl_pengembalian }}
          </p>
          <!-- Transaksi status -->
          <p class="text-gray-500 mb-1 flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 mr-1.5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12"
              />
            </svg>
            Status: {{ transaksi.status }}
          </p>
          <!-- Transaksi user name -->
        </div>

        <!-- View transaksi details button that links to the transaksi details page -->
        <router-link
          :to="`/transaksi/${transaksi.id}`"
          class="bg-blue-500 text-white rounded-md py-2 px-4 mt-4 inline-block hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50"
        >
          View Details
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
// Get the auth store and create a reactive reference to the transaksi
const authStore = useAuthStore();
const transaksis = ref([]);
// Load the transaksi when the component is mounted
onMounted(async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/transaksis", {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    });
    transaksis.value = response.data.data;
  } catch (error) {
    console.error(error);
  }
});
</script>

<style></style>
