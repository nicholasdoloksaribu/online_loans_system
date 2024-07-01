<template>
  <div class="p-4">
    <div class="mb-4">
      <router-link
        to="/services"
        class="bg-gray-300 hover:bg-gray-400 transition-colors rounded-md py-2 px-4"
        >&larr; Back</router-link
      >
    </div>
    <h1 class="text-3xl font-bold mb-4">Edit Services</h1>
    <form
      v-if="services"
      @submit.prevent="updateServices"
      class="flex flex-col space-y-4"
    >
      <label class="text-lg font-semibold" for="nama_peminjam"
        >Jumlah Pinjaman:</label
      >
      <input
        v-model="services.jml_pinjaman"
        type="text"
        class="border rounded-md p-2"
        id="jml_pinjaman"
      />
      <br />
      <label class="text-lg font-semibold" for="jml_bunga"
        >Jumlah Bunga :</label
      >
      <input
        v-model="services.jml_bunga"
        type="text"
        class="border rounded-md p-2"
        id="jml_bunga"
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
const services = ref(null);
onMounted(async () => {
  const response = await axios.get(
    `http://localhost:8000/api/services/${route.params.id}`,
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  services.value = response.data.data;
});
const updateServices = async () => {
  await axios.put(
    `http://localhost:8000/api/services/${services.value.id}`,
    {
      jml_pinjaman: services.value.jml_pinjaman,
      jml_bunga: services.value.jml_bunga,
    },
    {
      headers: {
        Authorization: `Bearer ${authStore.accessToken}`,
      },
    }
  );
  router.push(`/services/${services.value.id}`);
};
</script>
