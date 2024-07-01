<template>
  <!-- Main wrapper div to create a full height layout with flexbox for centering the content -->
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <!-- Form container with a fixed width and spaced children -->
    <div class="max-w-md w-full space-y-8 text-gray-700">
      <!-- Logo and title -->
      <div class="flex items-center justify-center">
        <!-- SVG icon for the logo -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="30"
          height="30"
          fill="currentColor"
          class="bi bi-coin"
          viewBox="0 0 16 16"
        >
          <path
            d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"
          />
          <path
            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
          />
          <path
            d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"
          />
        </svg>
        <!-- Title text -->
        <h2 class="text-2xl font-bold ml-1">Online Loans</h2>
      </div>
      <!-- Error message container -->
      <div v-if="errorMessage">
        <p class="bg-red-100 text-red-700 rounded-lg p-4">{{ errorMessage }}</p>
      </div>
      <!-- Login form with onSubmit event handler -->
      <form class="mt-8 space-y-6" @submit.prevent="onSubmit">
        <!-- Hidden input for remember -->
        <input type="hidden" name="remember" value="true" />
        <!-- Input fields container -->
        <div class="rounded-md shadow-sm -space-y-px">
          <!-- Email input field -->
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input
              id="email-address"
              name="email"
              type="email"
              v-model="email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Email address"
            />
          </div>
          <!-- Password input field -->
          <div>
            <label for="password" class="sr-only">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              v-model="password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-500 focus:z-10 sm:text-sm"
              placeholder="Password"
            />
          </div>
        </div>
        <!-- Login button container -->
        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
// Import required dependencies and hooks
import { ref } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
// Initialize required variables and hooks
const router = useRouter();
const route = useRoute();
const authStore = useAuthStore();
// Reactive data to store user input and error messages
const email = ref("");
const password = ref("");
const errorMessage = ref(null);
// Function to handle form submission
async function onSubmit() {
  try {
    // Fetch CSRF token
    await axios.get("http://localhost:8000/sanctum/csrf-cookie");
    // Send login request
    const response = await axios.post("http://localhost:8000/api/login", {
      email: email.value,
      password: password.value,
    });
    // Save access token and navigate to the home page
    authStore.setAccessToken(response.data.access_token);
    console.log("Login successful");
    router.push({ name: "home" });
  } catch (error) {
    // Check if the error is due to validation
    if (
      error.response &&
      error.response.status === 422 &&
      error.response.data.errors &&
      error.response.data.errors.email
    ) {
      // Set the error message from the server response
      errorMessage.value = error.response.data.errors.email[0];
    } else {
      // Set a generic error message
      errorMessage.value = "An error occurred: " + error.message;
    }
    console.error(errorMessage.value);
  }
}
</script>
<style>
/* styles here */
</style>
