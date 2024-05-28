<template>
  <ListPage
    :fetch-items="fetchItems"
    :headers="['Name', 'Slug', 'Description', 'Category', 'book', 'Publisher', 'Price']"
    :actions="true"
    :delete-item="deleteItem"
    :edit-item="editItem"
    :pagination.sync="pagination"
  >
    <template #row="{ item }">
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.name }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.slug }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.description }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.category.name }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.author.name }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.publisher.name }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap max-w-56"
      >
        {{ item.price }}
      </td>
    </template>
  </ListPage>
</template>

<script setup>
import ListPage from "../ListPage.vue";
import { bookService } from "../../apis/book";
import { useRouter } from "vue-router";
import { ref } from "vue";

const pagination = ref({});

const fetchItems = async (page = 1) => {
  const response = await bookService.getAll(page);
  return {
    items: response.data.data,
    pagination: {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    },
  };
};

const router = useRouter();

const editItem = (id) => {
  router.push({ name: "book-form-edit", params: { id } });
};

const deleteItem = async (id) => {
  await bookService.delete(id);
  fetchItems(pagination.value.current_page);
};
</script>

<style scoped></style>

