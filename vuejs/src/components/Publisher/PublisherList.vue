<template>
  <ListPage
    :fetch-items="fetchItems"
    :headers="['Name', 'Description']"
    :actions="true"
    :delete-item="deleteItem"
    :edit-item="editItem"
    :pagination.sync="pagination"
  >
    <template #row="{ item }">
      <td
        class="p-10 text-nowrap max-w-[20vw] w-[20vw] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.name }}
      </td>
      <td
        class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.description }}
      </td>
    </template>
  </ListPage>
</template>

<script setup>
import ListPage from "../ListPage.vue";
import { publisherService } from "../../apis/publisher";
import { useRouter } from "vue-router";
import { ref } from "vue";

const pagination = ref({});

const fetchItems = async (page = 1) => {
  const response = await publisherService.getAll(page);
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
  router.push({ name: "publisher-form-edit", params: { id } });
};

const deleteItem = async (id) => {
  await publisherService.delete(id);
  fetchItems(pagination.value.current_page);
};
</script>

<style scoped></style>
