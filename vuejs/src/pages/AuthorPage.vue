<template>
  <section class="dashboard-content w-full">
    <HeaderComponent 
      title="Author" 
      searchEndpoint="/author" 
      listPageName="author-list" 
      formPageName="author-form" 
      rollbackPageName="rollback-author"
    />
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from '../components/Content/HeaderContentComponent.vue';
</script>

<style scoped></style>