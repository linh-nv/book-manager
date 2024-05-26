<template>
    <section class="dashboard-content w-full">
      <div class="head-content flex justify-between items-center w-full">
        <div class="heading font-semibold">
          <h1>Book</h1>
        </div>
        <div class="flex justify-between items-center gap-20 ml-20">
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
            @click="navigateToList"
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
                v-for="book in limitedSearchResults"
                :key="book.id"
                @click="showItem(book.id)"
                class="hover:bg-slate-100 rounded-xl p-5"
              >
                <strong>
                  {{ book.name }}
                </strong>
                <p class="overflow-hidden text-ellipsis whitespace-nowrap">
                  {{ book.description }}
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
  
  const router = useRouter();
  const route = useRoute();
  
  const isListPage = ref(route.name === "book-list");
  
  const navigateToCreate = () => {
    router.push({ name: "book-form" });
  };
  
  const navigateToList = () => {
    router.push({ name: "book-list" });
  };
  
  watch(route, (newRoute) => {
    isListPage.value = newRoute.name === "book-list";
  });
  
  // search
  const searchKeyword = ref("");
  const searchResults = ref([]);
  
  const searchItems = async () => {
    try {
      const data = await apiService.search("/book", searchKeyword.value);
      searchResults.value = data.data;
    } catch (error) {
      console.error("Error searching books:", error);
    }
  };
  
  const debouncedSearch = debounce(searchItems, 1000);
  
  const limitedSearchResults = computed(() => {
    return searchResults.value.slice(0, 8);
  });
  
  const showItem = (id) => {
    searchKeyword.value = "";
    router.push({ name: "book-form-edit", params: { id } });
  };
  </script>
  
  <style scoped></style>
  