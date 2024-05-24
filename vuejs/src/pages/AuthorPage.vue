<template>
    <div>
      <HeaderComponent />
      <NavbarComponent />
      <div class="container flex mb-40 pl-[240px] pt-[66px] relative z-20">
        <h1>Welcome, {{ user.name }}</h1>
        <p>Email: {{ user.email }}</p>
        <p>Address: {{ user.address }}</p>
        <p>Phone: {{ user.tel }}</p>
        <p>Birthday: {{ user.birthday }}</p>
        <p>Gender: {{ user.gender === 0 ? "Male" : "Female" }}</p>
        <p>Role: {{ user.role_id }}</p>
        <button @click="logout" class="bg-red-500 text-white py-2 px-4 rounded">
          Logout
        </button>
      </div>
      <FooterComponent />
    </div>
  </template>
  
  <script setup>
  import { useUserStore } from "../stores/userStore";
  import { useRouter } from "vue-router";
  import HeaderComponent from "../components/HeaderComponent.vue";
  import NavbarComponent from '../components/NavbarComponent.vue';
  import FooterComponent from "../components/FooterComponent.vue";
  
  const userStore = useUserStore();
  const user = userStore.user
  const router = useRouter();
  
  const logout = () => {
    userStore.logout();
    router.push({ name: "login" });
  };
  </script>
  
  <style>
  .home-container {
    padding: 2rem;
  }
  </style>
  