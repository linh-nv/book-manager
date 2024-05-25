<template>
  <div class="list">
    <table id="table">
      <tr class="table-title bg-slate-200">
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
      <tr v-for="author in authors" :key="author.id" class="author-item">
        <td
          class="p-10 text-nowrap max-w-[20vw] w-[20vw] overflow-hidden text-ellipsis whitespace-nowrap"
        >
          {{ author.name }}
        </td>
        <td
          class="p-10 text-nowrap max-w-[50vw] w-[50vw] overflow-hidden text-ellipsis whitespace-nowrap"
        >
          {{ author.description }}
        </td>
        <td class="flex justify-center items-center p-10">
          <div class="action">
            <button class="edit" @click="editAuthor(author.id)">
              <img src="../../assets/icon/pencil-write.svg" alt="icon-edit" />
            </button>
            <button class="delete" @click="confirmDelete(author.id)">
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
import { authorService } from "../../apis/author";
import { useRouter } from "vue-router";

const authors = ref([]);
const pagination = ref({});

// getAll
const fetchAuthors = async (page = 1) => {
  try {
    const response = await authorService.getAll(page);
    authors.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    };
  } catch (error) {
    console.error("Failed to fetch authors:", error);
  }
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    fetchAuthors(pagination.value.current_page + 1);
  }
};

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    fetchAuthors(pagination.value.current_page - 1);
  }
};

// delete
const confirmDelete = (id) => {
  if (window.confirm("Are you sure you want to delete this author?")) {
    deleteAuthor(id);
  }
};

const deleteAuthor = async (id) => {
  try {
    await authorService.delete(id);
    fetchAuthors(pagination.value.current_page);
  } catch (error) {
    console.error("Failed to delete author:", error);
  }
};

// update
const router = useRouter();

const editAuthor = (id) => {
  router.push({ name: "author-form-edit", params: { id } });
};

onMounted(() => {
  fetchAuthors();
});
</script>

<style scoped></style>
