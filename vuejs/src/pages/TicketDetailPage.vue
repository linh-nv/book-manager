<template>
  <section class="dashboard-content w-full">
    <HeaderComponent
      title="Ticket Details"
      searchEndpoint="/ticket-detail"
      listPageName="ticket-detail-list"
      formPageName="ticket-detail-form"
    >
      <template #actions>
        <button
          class="create-btn rounded-xl bg-[#FFD43B] flex cursor-pointer justify-center items-center gap-5 px-10 font-semibold h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="backLendTicketPage"
        >
          <i class="fa-solid fa-arrow-left fa-xl" style="color: #fff"></i>
          <span style="color: #fff">To LendTicket</span>
        </button>
      </template>

      <template #item="{ item }">
        <strong>{{ item.book.name }}</strong>
        <p class="overflow-hidden text-ellipsis whitespace-nowrap">
          {{ item.return_date ?? "Unpaid" }} -
          {{ getStatusLabelById(item.status) }}
        </p>
      </template>
    </HeaderComponent>
    <router-view />
  </section>
</template>

<script setup>
import HeaderComponent from "../components/Content/HeaderContentComponent.vue";
import { getStatusLabelById } from "../constants/ticketDetailStatus";
import { useRoute, useRouter } from "vue-router";

const router = useRouter();

const backLendTicketPage = () => {
  router.push({ name: "lend-ticket-list" });
};
</script>

<style scoped></style>
