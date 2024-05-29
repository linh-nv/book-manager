<template>
  <section class="dashboard-content w-full">
    <TrashedItemsComponent
      itemType="Publishers"
      apiEndpoint="/trashed/publisher"
      restoreEndpoint="/restore/publisher"
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
