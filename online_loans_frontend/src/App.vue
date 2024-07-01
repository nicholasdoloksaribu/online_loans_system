<template>
  <!-- Navigation bar -->
  <nav v-if="authStore.isLoggedIn" class="bg-gray-800 p-4 px-8 flex">
    <!-- Home link -->
    <RouterLink to="/" class="text-white hover:text-gray-200 transition-colors"
      >Customers</RouterLink
    >

    <RouterLink to="/users" class="ml-10 text-white hover:text-gray-200 transition-colors"
      >Users</RouterLink
    >
    <!-- Users link -->
    <RouterLink
      to="/services"
      class="ml-10 text-white hover:text-gray-200 transition-colors"
      >Services</RouterLink
    >

    <RouterLink
      to="/documents"
      class="ml-10 text-white hover:text-gray-200 transition-colors"
      >Documents</RouterLink
    >
    <!-- Orders link -->
    <RouterLink
      to="/transaksi"
      class="ml-10 text-white hover:text-gray-200 transition-colors"
      >Transaksi</RouterLink
    >
    <!-- Logout button -->
    <button
      @click="logout"
      class="ml-auto text-white hover:text-gray-200 transition-colors bg-red-500 p-1 px-3 rounded-md"
    >
      Logout
    </button>
  </nav>
  <!-- Main content area -->
  <div class="p-4">
    <!-- Render the current route -->
    <RouterView />
  </div>
</template>
<script setup>
// Import hooks from Vuex and Vue Router
import { useAuthStore } from "@/stores/auth";
import { useRouter, useRoute } from "vue-router";
// Initialize objects
const authStore = useAuthStore();
const router = useRouter();
// Define logout method
const logout = () => {
  authStore.logout(); // Clear authentication state
  router.push({ name: "login" }); // Redirect to login route
};
</script>
<style></style>
