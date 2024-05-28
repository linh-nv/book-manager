<template>
  <section class="dashboard-content w-full">
    <HeaderComponent 
      title="Book" 
      searchEndpoint="/book" 
      listPageName="book-list" 
      formPageName="book-form" 
    />
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from '../components/Content/HeaderContentComponent.vue';
</script>

<style scoped></style>