import { createRouter, createWebHistory } from "vue-router";
import CustomerList from "../components/CustomerList.vue";
import CustomerCreate from "../components/CustomerCreate.vue";
import CustomerDetails from "../components/CustomerDetails.vue";
import CustomerEdit from "../components/CustomerEdit.vue";
import ServiceList from "../components/ServiceList.vue";
import ServiceCreate from "../components/ServiceCreate.vue";
import ServiceDetails from "../components/ServiceDetails.vue";
import ServiceEdit from "../components/ServiceEdit.vue";
import Login from "../components/Login.vue";
import DocumentList from "../components/DocumentList.vue";
import DocumentCreate from "../components/DocumentCreate.vue";
import DocumentDetails from "../components/DocumentDetails.vue";
import DocumentEdit from "../components/DocumentEdit.vue";
import TransaksiList from "../components/TransaksiList.vue";
import TransaksiCreate from "../components/TransaksiCreate.vue";
import TransaksiDetails from "../components/TransaksiDetails.vue";
import TransaksiEdit from "../components/TransaksiEdit.vue";
import UserCreate from "../components/UserCreate.vue";
import UserList from "../components/UserList.vue";
import UserEdit from "../components/UserEdit.vue";
import UserDetails from "../components/UserDetails.vue";

import { useAuthStore } from "../stores/auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: CustomerList,
    },
    {
      path: "/users/create",
      name: "usercreate",
      component: UserCreate,
    },
    {
      path: "/users",
      name: "userlist",
      component: UserList,
    },
    {
      path: "/users/:id/edit",
      name: "useredit",
      component: UserEdit,
    },
    {
      path: "/users/:id",
      name: "userdetails",
      component: UserDetails,
    },
    {
      path: "/create",
      name: "customercreate",
      component: CustomerCreate,
    },
    {
      path: "/customers/:id",
      name: "customerdetail",
      component: CustomerDetails,
    },
    {
      path: "/customers/:id/edit",
      name: "customeredit",
      component: CustomerEdit,
    },
    {
      path: "/services",
      name: "servicelist",
      component: ServiceList,
    },
    {
      path: "/services/create",
      name: "serviceCreate",
      component: ServiceCreate,
    },
    {
      path: "/services/:id",
      name: "servicedetail",
      component: ServiceDetails,
    },
    {
      path: "/services/:id/edit",
      name: "serviceedit",
      component: ServiceEdit,
    },
    {
      path: "/documents",
      name: "documentlist",
      component: DocumentList,
    },
    {
      path: "/documents/create",
      name: "documentcreate",
      component: DocumentCreate,
    },
    {
      path: "/documents/:id",
      name: "documentdetail",
      component: DocumentDetails,
    },
    {
      path: "/documents/:id/edit",
      name: "documentedit",
      component: DocumentEdit,
    },
    {
      path: "/transaksi",
      name: "transaksilist",
      component: TransaksiList,
    },
    {
      path: "/transaksi/create",
      name: "transaksicreate",
      component: TransaksiCreate,
    },
    {
      path: "/transaksi/:id",
      name: "transaksidetail",
      component: TransaksiDetails,
    },
    {
      path: "/transaksi/:id/edit",
      name: "transaksiedit",
      component: TransaksiEdit,
    },
    {
      path: "/login",
      name: "login",
      component: Login,
    },
  ],
});

// Add global navigation guards to the router
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  if (to.name !== "login" && !authStore.isLoggedIn) {
    next({ name: "login" });
  } else {
    next();
  }
});

export default router;
