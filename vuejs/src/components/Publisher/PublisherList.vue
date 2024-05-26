<template>
  <div class="list">
    <table id="table">
      <tr class="table-title bg-slate-200">
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
      <tr v-for="publisher in publishers" :key="publisher.id" class="publisher-item">
        <td
          class="p-10 text-nowrap max-w-[20vw] w-[20vw] overflow-hidden text-ellipsis whitespace-nowrap"
        >
          {{ publisher.name }}
        </td>
        <td
          class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
        >
          {{ publisher.description }}
        </td>
        <td class="flex justify-center items-center p-10">
          <div class="action">
            <button class="edit" @click="editItem(publisher.id)">
              <img src="../../assets/icon/pencil-write.svg" alt="icon-edit" />
            </button>
            <button class="delete" @click="confirmDelete(publisher.id)">
              <img src="../../assets/icon/bin.svg" alt="icon-delete" />
            </button>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div class="pagination flex gap-10 mt-10">
    <button
      :class="!pagination.prev_page_url ? 'opacity-50' : ''"
      class="flex justify-center items-center rounded-xl shadow shadow-slate-300 bg-white p-5"
      @click="prevPage"
      :disabled="!pagination.prev_page_url"
    >
      <i class="fa-solid fa-circle-chevron-left" style="color: #74c0fc"></i>
    </button>
    <button
      :class="!pagination.next_page_url ? 'opacity-50' : ''"
      class="flex justify-center items-center rounded-xl shadow shadow-slate-300 bg-white p-5"
      @click="nextPage"
      :disabled="!pagination.next_page_url"
    >
      <i class="fa-solid fa-circle-chevron-right" style="color: #74c0fc"></i>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { publisherService } from "../../apis/publisher";
import { useRouter } from "vue-router";

const publishers = ref([]);
const pagination = ref({});

// getAll
const fetchItems = async (page = 1) => {
  try {
    const response = await publisherService.getAll(page);
    publishers.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    };
  } catch (error) {
    console.error("Failed to fetch publishers:", error);
  }
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    fetchItems(pagination.value.current_page + 1);
  }
};

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    fetchItems(pagination.value.current_page - 1);
  }
};

// delete
const confirmDelete = (id) => {
  if (window.confirm("Are you sure you want to delete this publisher?")) {
    deleteItem(id);
  }
};

const deleteItem = async (id) => {
  try {
    await publisherService.delete(id);
    fetchItems(pagination.value.current_page);
  } catch (error) {
    console.error("Failed to delete publisher:", error);
  }
};

// update
const router = useRouter();

const editItem = (id) => {
  router.push({ name: "publisher-form-edit", params: { id } });
};

onMounted(() => {
  fetchItems();
});
</script>

<style scoped></style>
