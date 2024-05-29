<template>
  <section class="dashboard-content w-full">
    <TrashedItemsComponent
      itemType="Books"
      apiEndpoint="/trashed/book"
      restoreEndpoint="/restore/book"
    >
      <template #item="{ item }">
        <div>
          <strong>{{ item.name }}</strong>
          <p>{{ item.slug }}</p>
          <p>{{ item.description }}</p>
          <p>{{ item.price }}</p>
        </div>
      </template>
    </TrashedItemsComponent>
  </section>
</template>

<script setup>
import TrashedItemsComponent from "../Content/TrashedItemsComponent.vue";
</script>

<style scoped></style>
