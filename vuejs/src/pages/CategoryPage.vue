<template>
  <section class="dashboard-content w-full">
    <HeaderComponent 
      title="Category" 
      searchEndpoint="/category" 
      listPageName="category-list" 
      formPageName="category-form" 
      rollbackPageName="rollback-category"
    />
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from '../components/Content/HeaderContentComponent.vue';
</script>

<style scoped></style>