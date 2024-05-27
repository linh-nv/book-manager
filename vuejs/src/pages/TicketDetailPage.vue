<template>
  <section class="dashboard-content w-full">
    <div class="head-content flex justify-between items-center w-full">
      <div class="heading font-semibold">
        <h1>Ticket Details</h1>
      </div>
      <div class="flex justify-between items-center gap-20 ml-20">
        <button
          class="create-btn rounded-xl bg-[#FFD43B] flex cursor-pointer justify-center items-center gap-5 px-10 font-semibold h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="backLendTicketPage"
        >
          <i class="fa-solid fa-arrow-left fa-xl" style="color: #fff"></i>
          <span style="color: #fff">To LendTicket</span>
        </button>
        <button
          v-if="isListPage"
          class="create-btn rounded-[50%] bg-[#74C0FC] flex cursor-pointer justify-center items-center w-16 h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="navigateToCreate"
        >
          <i class="fa-solid fa-plus fa-xl" style="color: #fff"></i>
        </button>
        <button
          v-else
          class="list-btn cursor-pointer rounded-[50%] bg-[#63E6BE] flex justify-center items-center w-16 h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="navigateToList(route.params.id)"
        >
          <i class="fa-solid fa-list-ul fa-xl" style="color: #fff"></i>
        </button>
        <div class="relative">
          <input
            v-model="searchKeyword"
            type="text"
            placeholder="Search ..."
            class="py-3 pl-5 pr-16 shadow shadow-slate-300 rounded-2xl focus:outline-none"
            @input="debouncedSearch"
          />
          <i
            class="fa-solid fa-magnifying-glass absolute top-1/3 right-5 cursor-pointer"
            style="color: #74c0fc"
          ></i>
          <div
            v-if="searchResults.length > 0 && searchKeyword !== ''"
            class="absolute flex flex-col gap-5 rounded-2xl bottom-0 top-16 right-0 w-[20vw] h-fit p-5 cursor-pointer bg-white shadow-sm shadow-slate-300"
          >
            <div
              v-for="ticketDetail in limitedSearchResults"
              :key="ticketDetail.id"
              @click="showItem(ticketDetail.id)"
              class="hover:bg-slate-100 rounded-xl p-5"
            >
              <strong>
                {{ ticketDetail.book.name }}
              </strong>
              <p class="overflow-hidden text-ellipsis whitespace-nowrap">
                {{ ticketDetail.return_date ?? 'Unpaid' }} - {{ getStatusLabelById(ticketDetail.status) }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <router-view />
  </section>
</template>

<script setup>
import { ref, watch, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { debounce } from "lodash-es";
import { apiService } from "../apis/base";
import { getStatusLabelById } from "../constants/ticketDetailStatus";

const router = useRouter();
const route = useRoute();

const isListPage = ref(route.name === "ticket-detail-list");

const backLendTicketPage = () => {
  router.push({ name: "lend-ticket-list" });
};

const navigateToCreate = () => {
  router.push({ name: "ticket-detail-form" });
};

const navigateToList = (id) => {
  router.back();
};

watch(route, (newRoute) => {
  isListPage.value = newRoute.name === "ticket-detail-list";
});

// search
const searchKeyword = ref("");
const searchResults = ref([]);

const searchItems = async () => {
  try {
    const data = await apiService.search("/ticket-detail", searchKeyword.value);
    searchResults.value = data.data;
  } catch (error) {
    console.error("Error searching ticket-details:", error);
  }
};

const debouncedSearch = debounce(searchItems, 1000);

const limitedSearchResults = computed(() => {
  return searchResults.value.slice(0, 8);
});

const showItem = (id) => {
  searchKeyword.value = "";
  router.push({ name: "ticket-detail-form-edit", params: { id } });
};
</script>

<style scoped></style>
