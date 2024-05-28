<template>
  <div class="list">
    <table id="table" class="w-full">
      <thead>
        <tr class="table-title bg-slate-200">
          <slot name="header"></slot>
        </tr>
      </thead>
      <tbody>
        <slot name="body"></slot>
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
