<template>
  <div>
    <HeaderComponent />
    <NavbarComponent />
    <transition name="fade" mode="out-in">
      <div class="content-page">
        <router-view v-slot="{ Component }">
          <component :is="Component" />
        </router-view>
      </div>
    </transition>
    <FooterComponent />
    <div v-if="isLoading" class="loading-box">
      <div class="loader"></div>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useLoadingStore } from "../stores/loadingStore";
import HeaderComponent from "../components/HeaderComponent.vue";
import NavbarComponent from "../components/NavbarComponent.vue";
import FooterComponent from "../components/FooterComponent.vue";

const loadingStore = useLoadingStore();
const isLoading = computed(() => loadingStore.isLoading);
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
