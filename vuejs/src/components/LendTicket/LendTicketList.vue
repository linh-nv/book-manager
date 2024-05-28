<template>
  <ListPage
    :fetch-items="fetchItems"
    :headers="[
      'User Name',
      'Start Date',
      'Start Date',
      'Note',
      'Status',
      'Detail',
    ]"
    :actions="true"
    :delete-item="deleteItem"
    :edit-item="editItem"
    :pagination.sync="pagination"
  >
    <template #row="{ item }">
      <td
        class="p-10 text-nowrap max-w-[20vw] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.user.name }}
      </td>
      <td
        class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.start_date }}
      </td>
      <td
        class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.end_date }}
      </td>
      <td
        class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ item.note }}
      </td>
      <td
        class="p-10 text-nowrap max-w-[30rem] overflow-hidden text-ellipsis whitespace-nowrap"
      >
        {{ getStatusLabelById(item.status) }}
      </td>
      <td
        class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
      >
        <button
          @click="showTicketDetail(item.id)"
          class="flex justify-center items-center w-full"
        >
          <button class="detail flex justify-center items-center">
            <i
              class="fa-solid fa-circle-info fa-2xl"
              style="color: #16a34a"
            ></i>
          </button>
        </button>
      </td>
    </template>
  </ListPage>
</template>

<script setup>
import ListPage from "../ListPage.vue";
import { lendTicketService } from "../../apis/lendTicket";
import { useRouter } from "vue-router";
import { ref } from "vue";
import { getStatusLabelById } from "../../constants/lendTicketStatus";

const pagination = ref({});

const fetchItems = async (page = 1) => {
  const response = await lendTicketService.getAll(page);
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
  router.push({ name: "lend-ticket-form-edit", params: { id } });
};

const deleteItem = async (id) => {
  await lendTicketService.delete(id);
  fetchItems(pagination.value.current_page);
};

const showTicketDetail = (id) => {
  router.push({ name: "ticket-detail-list", params: { id } });
};
</script>

<style scoped></style>
