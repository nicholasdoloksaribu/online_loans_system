<template>
  <!-- A div container with padding of 4 -->
  <div class="p-4">
    <!-- A heading with font size 3xl, bold and margin bottom of 4 -->
    <h1 class="text-3xl font-bold mb-4">Create Transaksi</h1>
    <!-- A form that will call createTransaksi function on submit -->
    <form @submit.prevent="createTransaksi">
      <!-- A div container with margin bottom of 4 -->
      <div class="mb-4">
        <!-- A label for User dropdown with font color gray, font weight bold and margin bottom of 2 -->
        <label for="customer_id" class="block text-gray-700 font-bold mb-2"
          >Nama Peminjam:</label
        >
        <!-- A dropdown for selecting user with shadow, border, rounded corners, full width, padding top and bottom of 2, font color gray, focus shadow outline and required field -->
        <select
          id="customer_id"
          v-model="form.customer_id"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        >
          <!-- A loop to display the list of customer with their names -->
          <option
            v-for="customer in customers"
            :key="customer.id"
            :value="customer.id"
          >
            {{ customer.nama_peminjam }}
          </option>
        </select>
      </div>
      <!-- A div container with margin bottom of 4 -->
      <div class="mb-4">
        <!-- A label for services dropdown with font color gray, font weight bold and margin bottom of 2 -->
        <label for="service_id" class="block text-gray-700 font-bold mb-2"
          >Jumlah Pinjaman:</label
        >
        <!-- A dropdown for selecting services with shadow, border, rounded corners, full width, padding top and bottom of 2, font color gray, focus shadow outline, required field and call updateTotalPrice function on change -->
        <select
          id="service_id"
          v-model="form.service_id"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        >
          <!-- A loop to display the list of services -->
          <option
            v-for="service in services"
            :key="service.id"
            :value="service.id"
          >
            {{ service.jml_pinjaman }}
          </option>
        </select>
      </div>
      <!-- A div container with margin bottom of 4 -->
      <div class="mb-4">
        <label for="tgl_pinjam" class="block text-gray-700 font-bold mb-2"
          >Tanggal Pinjam:</label
        >
        <!-- An input field for entering quantity with type date -->
        <input
          type="date"
          id="tgl_pinjam"
          v-model="form.tgl_pinjam"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>
      <!-- A div container with margin bottom of 4 -->
      <div class="mb-4">
        <!-- A label for tanggal Pengembalian -->
        <label for="tgl_pengembalian" class="block text-gray-700 font-bold mb-2"
          >Tanggal Pengembalian:</label
        >
        <!-- An input field for tanggal pengembalian with type date  -->
        <input
          type="date"
          id="tgl_pengembalian"
          v-model="form.tgl_pengembalian"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>
      <!-- A div container with margin bottom of 4 -->
      <div class="mb-4">
        <!-- A label for Status dropdown with font color gray, font weight bold and margin bottom of 2 -->
        <label for="status" class="block text-gray-700 font-bold mb-2"
          >Status:</label
        >
        <!-- A dropdown for selecting transaksi status with shadow, border, rounded corners, full width, padding top and bottom of 2, font color gray, focus shadow outline, and required field -->
        <select
          id="status"
          v-model="form.status"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        >
          <!-- Options for transaksi status -->
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="completed">Completed</option>
          <option value="canceled">Canceled</option>
        </select>
      </div>
      <!-- A div container with flexbox layout, items centered and justified space between -->
      <div class="flex items-center justify-between">
        <!-- A button to submit the form with background color blue, font color white, font weight bold, padding top and bottom of 2, padding left and right of 4, rounded corners, focus shadow outline -->
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Create
        </button>
        <!-- A router link to cancel the form with background color gray, font color white, font weight bold, padding top and bottom of 2, padding left and right of 4, rounded corners, focus shadow outline -->
        <router-link
          to="/transaksi"
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          >Cancel</router-link
        >
      </div>
    </form>
  </div>
</template>

<script setup>
import axios from "axios"; // import axios library for HTTP requests
import { ref, onMounted } from "vue"; // import ref and onMounted functions from Vue
import { useRouter } from "vue-router"; // import useRouter function from Vue Router
import { useAuthStore } from "@/stores/auth"; // import useAuthStore function from the auth store
const router = useRouter(); // create router variable using useRouter function
const authStore = useAuthStore(); // create authStore variable using useAuthStore function from the auth store
const form = ref({
  // create form variable with initial values
  customer_id: null,
  service_id: null,
  tgl_pinjam: null,
  tgl_pengembalian: null,
  status: "pending",
});
const customers = ref([]); // create customers variable as an empty array
const services = ref([]); // create services variable as an empty array
onMounted(async () => {
  // run this code when the component is mounted
  try {
    const [customersResponse, servicesResponse] = await Promise.all([
      // make two API requests to get customers and services data
      axios.get("http://localhost:8000/api/customers", {
        // get customer data
        headers: {
          // set headers for authentication
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }),
      axios.get("http://localhost:8000/api/services", {
        // get services data
        headers: {
          // set headers for authentication
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }),
    ]);
    customers.value = customersResponse.data.data; // set serv variable with response data
    services.value = servicesResponse.data.data; // set products variable with response data
  } catch (error) {
    // handle any errors
    console.log(error);
  }
});
const createTransaksi = async () => {
  // function to create a new transaksi
  try {
    const response = await axios.post(
      // make an API request to create a new transaksi
      "http://localhost:8000/api/transaksis", // endpoint for creating transaksi
      form.value, // data for creating transaksi
      {
        headers: {
          // set headers for authentication
          Authorization: `Bearer ${authStore.accessToken}`,
        },
      }
    );
    router.push({ name: "transaksilist" }); // navigate to transaksi list page after transaksi creation
  } catch (error) {
    // handle any errors
    console.log(error);
  }
};
</script>
