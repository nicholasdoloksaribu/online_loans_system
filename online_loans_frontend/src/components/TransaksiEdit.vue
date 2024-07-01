<template>
  <div class="p-4">
    <!-- Back button to go back to the previous page -->
    <button
      class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4 mb-6"
      @click="goBack"
    >
      &larr; Back
    </button>
    <!-- Title of the page -->
    <h1 class="text-3xl font-bold mb-4">Edit Transaksi</h1>
    <!-- Form for editing the transaksi -->
    <form @submit.prevent="updateTransaksi" v-if="transaksis">
      <!-- Select input for choosing the user associated with the transaksi -->
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="customer_id"
          >User:</label
        >
        <div class="relative">
          <select
            v-model="form.customer_id"
            id="customer_id"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
          >
            <option value="" disabled>Select a Customer</option>
            <!-- Loop through the list of users and display them as options -->
            <option
              v-for="customer in customers"
              :key="customer.id"
              :value="customer.id"
            >
              {{ customer.nama_peminjam }}
            </option>
          </select>
          <!-- Arrow icon for the select input -->
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M14.707 6.293a1 1 0 00-1.414 0L10 9.586 6.707 6.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 000-1.414z"
              />
            </svg>
          </div>
        </div>
        <!-- Display errors related to the user select input -->
        <p v-if="formErrors.customer_id" class="text-red-500 text-sm mt-1">
          {{ formErrors.customer_id[0] }}
        </p>
      </div>
      <!-- Select input for choosing the product associated with the transaksi -->
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service_id"
          >Jumlah Pinjaman:</label
        >
        <div class="relative">
          <select
            v-model="form.service_id"
            id="service_id"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
          >
            <option value="" disabled>Select a jumlah pinjaman</option>
            <!-- Loop through the list of products and display them as options -->
            <option
              v-for="service in services"
              :key="service.id"
              :value="service.id"
            >
              {{ service.jml_pinjaman }}
            </option>
          </select>
          <!-- Arrow icon for the select input -->
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M14.707 6.293a1 1 0 00-1.414 0L10 9.586 6.707 6.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 000-1.414z"
              />
            </svg>
          </div>
        </div>
        <!-- Display errors related to the product select input -->
        <p v-if="formErrors.service_id" class="text-red-500 text-sm mt-1">
          {{ formErrors.service_id[0] }}
        </p>
      </div>
      <!-- Input field for entering the quantity of the product -->
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="quantity"
          >Tanggal Pinjam:</label
        >
        <input
          v-model="form.tgl_pinjam"
          type="date"
          id="tgl_pinjam"
          name="tgl_pinjam"
          class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
        />
        <!-- Display errors related to the quantity input field -->
        <p v-if="formErrors.tgl_pinjam" class="text-red-500 text-sm mt-1">
          {{ formErrors.tgl_pinjam[0] }}
        </p>
      </div>
      <!-- Input field for entering the total price of the transaksi -->
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="total_price"
          >Tanggal Pengembalian:</label
        >
        <input
          v-model="form.tgl_pengembalian"
          type="date"
          id="tgl_pengembalian"
          name="tgl_pengembalian"
          class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
        />
        <!-- Display errors related to the total price input field -->
        <p v-if="formErrors.tgl_pengembalian" class="text-red-500 text-sm mt-1">
          {{ formErrors.tgl_pengembalian[0] }}
        </p>
      </div>
      <!-- Select input for choosing the status of the transaksi -->
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="status"
          >Status:</label
        >
        <div class="relative">
          <select
            v-model="form.status"
            id="status"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
          >
            <option value="" disabled>Select a status</option>
            <!-- Display different status options as select options -->
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="pompleted">Completed</option>
            <option value="canceled">Canceled</option>
          </select>
          <!-- Show error message related to the status select input -->
          <p v-if="formErrors.status" class="text-red-500 text-sm mt-1">
            {{ formErrors.status[0] }}
          </p>
        </div>
      </div>
      <!-- Buttons for submitting and canceling the changes -->
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Save Changes
        </button>
        <!-- Button for canceling the changes and returning to transaksi details -->
        <router-link
          :to="{ name: 'transaksidetail', params: { id: transaksis.id } }"
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          >Cancel</router-link
        >
      </div>
    </form>
  </div>
</template>

<script setup>
// Import required modules and functions
import axios from "axios";
import { ref, computed, onMounted, watch } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter, useRoute } from "vue-router";
// Get the authentication store, router and current route
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
// Define reactive variables and computed properties
const transaksis = ref(null); // Reference for the transaksi being edited
const form = ref({
  // Reference for the form data
  customer_id: "",
  service_id: "",
  tgl_pinjam: "",
  tgl_pengembalian: "",
  status: "",
});
const formErrors = ref({}); // Reference for form validation errors
// Fetch the transaksi data on component mount
onMounted(async () => {
  // Get the ID of the transaksi to be edited from the route parameter
  const transaksiId = route.params.id;
  try {
    // Fetch the transaksi data from the API
    const response = await axios.get(
      `http://localhost:8000/api/transaksis/${transaksiId}`,
      {
        headers: {
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }
    );
    // Update the transaksi reference with the fetched data
    transaksis.value = response.data.data;
  } catch (error) {
    console.error(error);
  }
});
// Define a computed property to map the  data to the form object
const mappedForm = computed(() => {
  if (!transaksis.value) {
    return form.value;
  }
  return {
    customer_id: transaksis.value.customer.id,
    service_id: transaksis.value.service.id,
    tgl_pinjam: transaksis.value.tgl_pinjam,
    tgl_pengembalian: transaksis.value.tgl_pengembalian,
    status: transaksis.value.status,
  };
});

// Update the form variable whenever the transaksi  variable changes
watch(
  () => transaksis.value,
  () => {
    form.value = { ...mappedForm.value };
  },
  { immediate: true }
);
// Define methods for updating the transaksi and handling form errors
async function updateTransaksi() {
  try {
    // Send a PUT request to update the transaksi with the new data
    const response = await axios.put(
      `http://localhost:8000/api/transaksis/${transaksis.value.id}`,
      form.value,
      {
        headers: {
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }
    );
    // Update the transaksi reference with the updated data
    transaksis.value = response.data.data;
    // Redirect to the transaksi list page
    router.push({ name: "transaksilist" });
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle form validation errors
      formErrors.value = error.response.data.errors;
    } else {
      console.error(error);
    }
  }
}
// Fetch the list of users and products to display in the select inputs
const customers = ref([]);
const services = ref([]);
onMounted(async () => {
  try {
    // Send a GET request to the API endpoint for users and attach an authorization token to the header
    const response = await axios.get("http://localhost:8000/api/customers", {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    });
    // Set the reactive variable `users` to the response data from the API
    customers.value = response.data.data;
  } catch (error) {
    // Log an error message to the console if the request fails
    console.error(error);
  }
  try {
    // Send a GET request to the API endpoint for products and attach an authorization token to the header
    const response = await axios.get("http://localhost:8000/api/services", {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    });
    // Set the reactive variable `products` to the response data from the API
    services.value = response.data.data;
  } catch (error) {
    // Log an error message to the console if the request fails
    console.error(error);
  }
});
// Define a method to navigate back to the previous page in the browser history
const goBack = () => {
  router.go(-1);
};
</script>
