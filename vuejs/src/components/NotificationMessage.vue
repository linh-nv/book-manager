<template>
  <div
    id="toast-danger"
    class="absolute bottom-20 right-10 flex justify-between items-center w-full max-w-xs p-4 mb-4 bg-white rounded-xl"
    role="alert"
  >
    <div class="flex justify-between gap-5 items-center">
      <i class="fa-solid fa-triangle-exclamation" style="color: #dd2222"></i>
      <div
        v-if="message"
        :class="['notification', typeClass]"
        class="ms-3 text-lg font-normal"
      >
        {{ message }}
      </div>
    </div>

    <button class="">
      <i class="fa-solid fa-circle-xmark"></i>
    </button>
  </div>
</template>

<script setup>
import { computed, ref } from "vue";

const props = defineProps({
  message: {
    type: String,
    default: "",
  },
  type: {
    type: String,
    default: "success",
  },
});

const typeClass = computed(() => {
  return props.type === "success"
    ? "notification-success"
    : "notification-error";
});
</script>

<style scoped></style>
