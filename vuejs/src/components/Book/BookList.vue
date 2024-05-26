<template>
  <div class="list">
    <table id="table" class="table-fixed w-full">
    <thead class="table-title bg-slate-200">
      <tr>
        <th class="w-1/8 p-10">Name</th>
        <th class="w-1/8 p-10">Slug</th>
        <th class="w-1/8 p-10">Description</th>
        <th class="w-1/8 p-10">Category</th>
        <th class="w-1/8 p-10">Author</th>
        <th class="w-1/8 p-10">Publisher</th>
        <th class="w-1/8 p-10">Price</th>
        <th class="w-1/8 p-10">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="book in books" :key="book.id" class="book-item">
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.name }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.slug }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.description }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.category.name }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.author.name }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.publisher.name }}
        </td>
        <td class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/8">
          {{ book.price }}
        </td>
        <td class="flex justify-center items-center p-10">
          <div class="action">
            <button class="edit" @click="editItem(book.id)">
              <img src="../../assets/icon/pencil-write.svg" alt="icon-edit" />
            </button>
            <button class="delete" @click="confirmDelete(book.id)">
              <img src="../../assets/icon/bin.svg" alt="icon-delete" />
            </button>
          </div>
        </td>
      </tr>
    </tbody>
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
import { bookService } from "../../apis/book";
import { useRouter } from "vue-router";

const books = ref([]);
const pagination = ref({});

// getAll
const fetchItems = async (page = 1) => {
  try {
    const response = await bookService.getAll(page);
    books.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    };
  } catch (error) {
    console.error("Failed to fetch books:", error);
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
  if (window.confirm("Are you sure you want to delete this book?")) {
    deleteItem(id);
  }
};

const deleteItem = async (id) => {
  try {
    await bookService.delete(id);
    fetchItems(pagination.value.current_page);
  } catch (error) {
    console.error("Failed to delete book:", error);
  }
};

// update
const router = useRouter();

const editItem = (id) => {
  router.push({ name: "book-form-edit", params: { id } });
};

onMounted(() => {
  fetchItems();
});
</script>

<style scoped></style>
