<template>
  <header class="flex fixed z-50">
    <nav class="navigation">
      <div class="sidebar-menu">
        <router-view>
          <div class="logo cursor-pointer">
            <img src="../assets/images/Logo.png" alt="logo" />
          </div>
        </router-view>
        <ul class="sidebar-top">
          <li class="sidebar-item">
            <router-link to="/dashboard" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-house"></i>
              </div>
              <div class="iteam-text">
                <span>Dashboard</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <router-link to="/author" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-user-graduate"></i>
              </div>
              <div class="iteam-text">
                <span>Author</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <router-link to="/publisher" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-newspaper"></i>
              </div>
              <div class="iteam-text">
                <span>Publisher</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <router-link to="/category" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-list"></i>
              </div>
              <div class="iteam-text">
                <span>Category</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <router-link to="/book" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-book-open"></i>
              </div>
              <div class="iteam-text">
                <span>Book</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
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
          <li class="sidebar-item">
            <router-link to="/setting" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-gear"></i>
              </div>
              <div class="iteam-text">
                <span>Setting</span>
              </div>
            </router-link>
          </li>
          <li class="sidebar-item">
            <router-link to="/logout" class="product">
              <div class="product-icon">
                <i class="fa-solid fa-power-off"></i>
              </div>
              <div class="iteam-text">
                <span>Logout</span>
              </div>
            </router-link>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { useUserStore } from "../stores/userStore";

const userStore = useUserStore();
const user = userStore.user

const logout = () => {
  userStore.logout();
  router.push({ name: "login" });
};
</script>

<style></style>
