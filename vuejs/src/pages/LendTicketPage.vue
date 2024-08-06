<template>
  <section class="dashboard-content w-full">
    <HeaderComponent 
      title="Lend Ticket" 
      searchEndpoint="/lend-ticket" 
      listPageName="lend-ticket-list" 
      formPageName="lend-ticket-form" 
      rollbackPageName="rollback-lend-ticket"
    >
      <template #item="{ item }">
        <strong>{{ item.user.name }}</strong>
        <p class="overflow-hidden text-ellipsis whitespace-nowrap">
          {{ item.start_date }} - {{ item.end_date }} - {{ getStatusLabelById(item.status) }}
        </p>
      </template>
    </HeaderComponent>
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from '../components/Content/HeaderContentComponent.vue';
import { getStatusLabelById } from "../constants/lendTicketStatus";
</script>

<style scoped></style>