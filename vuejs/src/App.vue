<template>
  <div id="app">
    <component :is="layout">
      <router-view></router-view>
    </component>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import DefaultLayout from "./layouts/DefaultLayout.vue";
import PublicLayout from "./layouts/PublicLayout.vue";

const route = useRoute();

const layout = computed(() => {
  return route.meta.publicPath ? PublicLayout : DefaultLayout;
});
</script>

<style>
</style>
