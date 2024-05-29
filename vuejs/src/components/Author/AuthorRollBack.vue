<template>
  <section class="dashboard-content w-full">
    <TrashedItemsComponent
      itemType="Authors"
      apiEndpoint="/trashed/author"
      restoreEndpoint="/restore/author"
    >
      <template #item="{ item }">
        <div>
          <strong>{{ item.name }}</strong>
          <p>{{ item.description }}</p>
        </div>
      </template>
    </TrashedItemsComponent>
  </section>
</template>

<script setup>
import TrashedItemsComponent from "../Content/TrashedItemsComponent.vue";
</script>

<style scoped></style>
