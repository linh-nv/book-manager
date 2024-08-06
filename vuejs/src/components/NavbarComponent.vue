<template>
  <section class="top-bar translate-x-[240px] fixed z-50">
    <div class="top-bar-left">
      <label for="menu-click" class="menu-icon">
        <i class="fa-solid fa-bars"></i>
      </label>
      <input type="checkbox" id="menu-click" />
    </div>
    <div class="top-bar-right">
      <div class="user-box">
        <div class="user-info">
          <div class="user-name">
            <span>{{ user.name }}</span>
          </div>
          <div class="user-code">
            <span>{{ user.user_code }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useUserStore } from "../stores/userStore";

const userStore = useUserStore();
const user = userStore.user;
</script>

<style>
</style>
