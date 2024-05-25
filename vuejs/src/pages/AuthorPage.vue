<template>
  <section class="dashboard-content w-full">
    <div class="head-content flex justify-between items-center w-full">
      <div class="heading font-semibold">
        <h1>Author</h1>
      </div>
      <div class="flex justify-between items-center gap-20 ml-20">
        <button
          v-if="isListPage"
          class="create-btn rounded-[50%] bg-[#74C0FC] flex cursor-pointer justify-center items-center w-16 h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="navigateToCreateAuthor"
        >
          <i class="fa-solid fa-plus fa-xl" style="color: #fff"></i>
        </button>
        <button
          v-else
          class="list-btn cursor-pointer rounded-[50%] bg-[#63E6BE] flex justify-center items-center w-16 h-16 shadow shadow-slate-300"
          style="color: #74c0fc"
          @click="navigateToListAuthor"
        >
          <i class="fa-solid fa-list-ul fa-xl" style="color: #fff"></i>
        </button>
        <div class="relative">
          <input
            v-model="searchKeyword"
            type="text"
            placeholder="Search ..."
            class="py-3 pl-5 pr-16 shadow shadow-slate-300 rounded-2xl focus:outline-none"
            @input="handleInput"
          />
          <i
            class="fa-solid fa-magnifying-glass absolute top-1/3 right-5 cursor-pointer"
            style="color: #74c0fc"
          ></i>
          <div
            v-if="searchResults.length > 0"
            class="absolute flex flex-col gap-5 rounded-2xl bottom-0 top-16 right-0 w-[20vw] h-fit p-5 cursor-pointer bg-white shadow-sm shadow-slate-300"
          >
            <div
              v-for="author in limitedSearchResults"
              :key="author.id"
              class="hover:bg-slate-100 rounded-xl p-5"
            >
              <strong>
                {{ author.name }}
              </strong>
              <p class="overflow-hidden text-ellipsis whitespace-nowrap">
                {{ author.description }}
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
import { apiService } from "../apis/base";

const router = useRouter();
const route = useRoute();

const isListPage = ref(route.name === "author-list");

const navigateToCreateAuthor = () => {
  router.push({ name: "author-form" });
};

const navigateToListAuthor = () => {
  router.push({ name: "author-list" });
};

const searchKeyword = ref("");
const searchResults = ref([]);
let timeout;

const handleInput = () => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    searchAuthors();
  }, 1000);
};

const searchAuthors = async () => {
  try {
    const data = await apiService.search("/author", searchKeyword.value);
    searchResults.value = data.data;
  } catch (error) {
    console.error("Error searching authors:", error);
  }
};

const limitedSearchResults = computed(() => {
  return searchResults.value.slice(0, 8);
});

watch(route, (newRoute) => {
  isListPage.value = newRoute.name === "author-list";
});
</script>

<style scoped></style>
