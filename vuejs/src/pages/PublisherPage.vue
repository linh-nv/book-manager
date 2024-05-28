<template>
  <section class="dashboard-content w-full">
    <HeaderComponent 
      title="Publisher" 
      searchEndpoint="/publisher" 
      listPageName="publisher-list" 
      formPageName="publisher-form" 
    />
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from '../components/Content/HeaderContentComponent.vue';
</script>

<style scoped></style>