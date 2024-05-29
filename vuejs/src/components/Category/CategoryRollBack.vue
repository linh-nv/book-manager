<template>
  <section class="dashboard-content w-full">
    <TrashedItemsComponent
      itemType="Categories"
      apiEndpoint="/trashed/category"
      restoreEndpoint="/restore/category"
      rollbackPageName="rollback-category"
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
