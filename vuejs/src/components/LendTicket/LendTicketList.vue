<template>
  <div class="list">
    <table id="table" class="table-fixed w-full">
      <tr class="table-title bg-slate-200 w-full">
        <th class="w-1/6">User Name</th>
        <th class="w-1/6">Start Date</th>
        <th class="w-1/6">End Date</th>
        <th class="w-1/6">Note</th>
        <th class="w-1/6">Status</th>
        <th class="w-1/6">Detail</th>
        <th class="w-1/6">Action</th>
      </tr>
      <tr
        v-for="lendTicket in lendTickets"
        :key="lendTicket.id"
        class="lend-ticket-item"
      >
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          {{ lendTicket.user.name }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          {{ lendTicket.start_date }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          {{ lendTicket.end_date }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          {{ lendTicket.note }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          {{ getStatusLabelById(lendTicket.status) }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/6"
        >
          <button @click="showTicketDetail(lendTicket.id)"
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
        <td class="flex justify-center items-center p-10">
          <div class="action">
            <button class="edit" @click="editItem(lendTicket.id)">
              <img src="../../assets/icon/pencil-write.svg" alt="icon-edit" />
            </button>
            <button class="delete" @click="confirmDelete(lendTicket.id)">
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
import { lendTicketService } from "../../apis/lendTicket";
import { useRouter } from "vue-router";
import { getStatusLabelById } from "../../constants/lendTicketStatus";
const lendTickets = ref([]);
const pagination = ref({});

// getAll
const fetchItems = async (page = 1) => {
  try {
    const response = await lendTicketService.getAll(page);
    lendTickets.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    };
  } catch (error) {
    console.error("Failed to fetch lend tickets:", error);
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
  if (window.confirm("Are you sure you want to delete this lend ticket?")) {
    deleteItem(id);
  }
};

const deleteItem = async (id) => {
  try {
    await lendTicketService.delete(id);
    fetchItems(pagination.value.current_page);
  } catch (error) {
    console.error("Failed to delete lend ticket:", error);
  }
};

// update
const router = useRouter();

const editItem = (id) => {
  router.push({ name: "lend-ticket-form-edit", params: { id } });
};

const showTicketDetail = (id) => {
  router.push({ name: "ticket-detail-list", params: { id } });
};
onMounted(() => {
  fetchItems();
});
</script>

<style scoped></style>
