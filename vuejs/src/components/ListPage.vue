<template>
  <div>
    <BaseTable :items="items" @edit="editItem" @delete="confirmDelete">
      <template #header>
        <th class="flex-1 p-10" v-for="header in headers" :key="header">{{ header }}</th>
        <th class="flex-1 p-10" v-if="actions">Action</th>
      </template>
      <template #body>
        <tr v-for="item in items" :key="item.id">
          <slot name="row" :item="item"></slot>
          <td v-if="actions" class="flex flex-1 justify-center items-center p-10">
            <div class="action">
              <button class="edit" @click="editItem(item.id)">
                <img src="../assets/icon/pencil-write.svg" alt="icon-edit" />
              </button>
              <button class="delete" @click="confirmDelete(item.id)">
                <img src="../assets/icon/bin.svg" alt="icon-delete" />
              </button>
            </div>
          </td>
        </tr>
      </template>
    </BaseTable>
    <BasePagination
      :pagination="pagination"
      @prev-page="prevPage"
      @next-page="nextPage"
    />
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import BaseTable from "./BaseTable.vue";
import BasePagination from "./BasePagination.vue";

const props = defineProps({
  fetchItems: Function,
  headers: Array,
  actions: Boolean,
  deleteItem: Function,
  editItem: Function,
});

const emit = defineEmits(["update:pagination"]);

const items = ref([]);
const pagination = ref({});

const loadItems = async (page = 1) => {
  const data = await props.fetchItems(page);
  items.value = data.items;
  pagination.value = data.pagination;
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    loadItems(pagination.value.current_page + 1);
  }
};

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    loadItems(pagination.value.current_page - 1);
  }
};

const confirmDelete = (id) => {
  if (window.confirm("Are you sure you want to delete this item?")) {
    props.deleteItem(id).then(() => loadItems(pagination.value.current_page));
  }
};

onMounted(() => {
  loadItems();
});

watch(pagination, (newPagination) => {
  emit("update:pagination", newPagination);
});
</script>

<style scoped></style>
