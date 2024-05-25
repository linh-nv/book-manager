<template>
  <div>
    <router-view></router-view>
    <div v-if="isLoading" class="loading-box">
      <div class="loader"></div>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useLoadingStore } from "../stores/loadingStore";

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
