<!-- src/components/Content/SearchResults.vue -->
<template>
    <div
      class="absolute flex flex-col gap-5 rounded-2xl bottom-0 top-16 right-0 w-[20vw] h-fit p-5 cursor-pointer bg-white shadow-sm shadow-slate-300"
    >
      <div
        v-for="item in results"
        :key="item.id"
        @click="handleClick(item.id)"
        class="hover:bg-slate-100 rounded-xl p-5"
      >
        <slot name="item" :item="item">
          <strong>{{ item.name }}</strong>
          <p class="overflow-hidden text-ellipsis whitespace-nowrap">{{ item.description }}</p>
        </slot>
      </div>
    </div>
  </template>
  
  <script setup>
  const props = defineProps({
    results: Array,
  });
  
  const emit = defineEmits(["itemClicked"]);
  
  const handleClick = (id) => {
    emit("itemClicked", id);
  };
  </script>
  
  <style scoped></style>