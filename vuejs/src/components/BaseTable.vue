<template>
  <div class="list w-full">
    <table id="table w-full">
      <thead>
        <tr class="table-title w-full bg-slate-200">
          <slot name="header"></slot>
        </tr>
      </thead>
      <tbody>
        <slot name="body" class=" w-full"></slot>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
  items: Array,
  actions: Boolean,
});

const emit = defineEmits(["edit", "delete"]);
</script>

<style scoped></style>
