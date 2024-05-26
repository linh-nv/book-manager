<template>
  <header class="flex fixed z-50">
    <nav class="navigation">
      <div class="sidebar-menu">
        <router-link to="/home">
          <div class="logo cursor-pointer">
            <img src="../assets/images/Logo.png" alt="logo" />
          </div>
        </router-link>
        <ul class="sidebar-top">
          <li :class="{ active: isActiveRoute('/home') }" class="sidebar-item">
            <router-link to="/home" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-house"></i>
              </div>
              <div class="iteam-text">
                <span>Dashboard</span>
              </div>
            </router-link>
          </li>
          <li
            :class="{ active: isActiveRoute('/author') }"
            class="sidebar-item"
          >
            <router-link to="/author" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-user-graduate"></i>
              </div>
              <div class="iteam-text">
                <span>Author</span>
              </div>
            </router-link>
          </li>
          <li
            :class="{ active: isActiveRoute('/publisher') }"
            class="sidebar-item"
          >
            <router-link to="/publisher" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-newspaper"></i>
              </div>
              <div class="iteam-text">
                <span>Publisher</span>
              </div>
            </router-link>
          </li>
          <li
            :class="{ active: isActiveRoute('/category') }"
            class="sidebar-item"
          >
            <router-link to="/category" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-list"></i>
              </div>
              <div class="iteam-text">
                <span>Category</span>
              </div>
            </router-link>
          </li>
          <li :class="{ active: isActiveRoute('/book') }" class="sidebar-item">
            <router-link to="/book" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-book-open"></i>
              </div>
              <div class="iteam-text">
                <span>Book</span>
              </div>
            </router-link>
          </li>
          <li
            :class="{ active: isActiveRoute('/lend-ticket') }"
            class="sidebar-item"
          >
            <router-link to="/lend-ticket" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-cash-register"></i>
              </div>
              <div class="iteam-text">
                <span>Lend Ticket</span>
              </div>
            </router-link>
          </li>
        </ul>
        <ul class="sidebar-bottom">
          <li
            :class="{ active: isActiveRoute('/profile') }"
            class="sidebar-item"
          >
            <router-link to="/profile" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-gear"></i>
              </div>
              <div class="iteam-text">
                <span>Setting</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <button @click="logout" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-power-off"></i>
              </div>
              <div class="iteam-text">
                <span>Logout</span>
              </div>
            </button>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { useUserStore } from "../stores/userStore";
import { useActiveRouteStore } from "../stores/activeRouteStore";
import { useRouter, useRoute } from "vue-router";
import { computed, watch } from "vue";

const userStore = useUserStore();
const router = useRouter();
const route = useRoute();
const activeRouteStore = useActiveRouteStore();

const logout = () => {
  userStore.logout();
  router.push({ name: "login" });
};

const activeRoute = computed(() => activeRouteStore.activeRoute);

const isActiveRoute = (pathPrefix) => {
  return activeRoute.value.startsWith(pathPrefix);
};

watch(
  () => route.fullPath,
  (newRoute) => {
    activeRouteStore.setActiveRoute(newRoute);
  }
);
</script>

<style scoped>
.sidebar-item.active .product {
  background-color: #4880ff;
  color: white;
  border-radius: 1rem;
}
</style>
