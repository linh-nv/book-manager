<template>
  <div class="trashed-items flex flex-col gap-10">
    <h2 class="text-3xl font-semibold">Trashed {{ itemType }} List</h2>
    <ul v-if="trashedItems.length" class="flex flex-col gap-10">
      <li
        v-for="item in trashedItems"
        :key="item.id"
        class="trashed-item flex justify-between items-center gap-20 bg-white p-10 rounded-xl shadow shadow-slate-300"
      >
        <slot name="item" :item="item">
          <div>
            <strong>{{ item.name }}</strong>
            <p>{{ item.description }}</p>
          </div>
        </slot>
        <div>
          <button
            @click="restoreItem(item.id)"
            class="restore-btn bg-green-500 hover:bg-green-600 text-white rounded-xl px-10 py-5"
          >
            Restore
          </button>
        </div>
      </li>
    </ul>
    <p v-else>No trashed items found.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axiosInstance from "../../apis/axiosInstance";

const props = defineProps({
  itemType: String,
  apiEndpoint: String,
  restoreEndpoint: String,
});

const trashedItems = ref([]);

const fetchTrashedItems = async () => {
  try {
    const response = await axiosInstance.get(props.apiEndpoint);
    trashedItems.value = response.data.data;
  } catch (error) {
    console.error("Failed to fetch trashed items:", error);
  }
};

const restoreItem = async (id) => {
  try {
    await axiosInstance.post(`${props.restoreEndpoint}/${id}`);
    fetchTrashedItems();
  } catch (error) {
    console.error("Failed to restore item:", error);
  }
};

onMounted(fetchTrashedItems);
</script>

<style scoped></style>
