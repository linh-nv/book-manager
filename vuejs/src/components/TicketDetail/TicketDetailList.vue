<template v-if="ticketDetails.length">
  <div class="list">
    <table id="table" class="table-fixed w-full">
      <tr class="table-title bg-slate-200 w-full">
        <th class="w-1/5">Book</th>
        <th class="w-1/5">Return Date</th>
        <th class="w-1/5">Quantity</th>
        <th class="w-1/5">Status</th>
        <th class="w-1/5">Action</th>
      </tr>
      <tr v-for="ticket in ticketDetails" :key="ticket.id" class="ticket-item">
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/5"
        >
          {{ ticket.book.name }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/5"
        >
          {{ ticket.return_date ? ticket.return_date : "Unpaid" }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/5"
        >
          {{ ticket.quantity }}
        </td>
        <td
          class="p-10 text-nowrap overflow-hidden text-ellipsis whitespace-nowrap w-1/5"
        >
          {{ getStatusLabelById(ticket.status) }}
        </td>
        <td class="flex justify-center items-center p-10">
          <div class="action">
            <button class="edit" @click="editItem(ticket.id)">
              <img src="../../assets/icon/pencil-write.svg" alt="icon-edit" />
            </button>
            <button class="delete" @click="confirmDelete(ticket.id)">
              <img src="../../assets/icon/bin.svg" alt="icon-delete" />
            </button>
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { ticketService } from "../../apis/ticketDetail";
import { getStatusLabelById } from "../../constants/ticketDetailStatus";

const ticketDetails = ref([]);
const route = useRoute();

const fetchItems = async (lendTicketId = route.params.id) => {
  try {
    const response = await ticketService.getLendTicket(lendTicketId);
    ticketDetails.value = response.data;
  } catch (error) {
    console.error("Failed to fetch ticket details:", error);
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
    await ticketService.delete(id);
    fetchItems();
  } catch (error) {
    console.error("Failed to delete lend ticket:", error);
  }
};

// update
const router = useRouter();

const editItem = (id) => {
  router.push({ name: "ticket-detail-form-edit", params: { id } });
};

watch(
  () => route.params.id,
  (id) => {
    if (id) {
      fetchItems();
    }
  },
  { immediate: true }
);
</script>

<style scoped></style>
