<template>
  <section class="dashboard-content w-full">
    <TrashedItemsComponent
      itemType="Lend Tickets"
      apiEndpoint="/trashed/lend-ticket"
      restoreEndpoint="/restore/lend-ticket"
    >
      <template #item="{ item }">
        <div>
          <strong>{{ item.user_id }}</strong>
          <p>{{ item.start_date }}</p>
          <p>{{ item.end_date }}</p>
          <p>{{ item.status }}</p>
        </div>
      </template>
    </TrashedItemsComponent>
  </section>
</template>

<script setup>
import TrashedItemsComponent from "../Content/TrashedItemsComponent.vue";
</script>

<style scoped></style>
