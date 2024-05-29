<template>
  <div class="head-content flex justify-between items-center w-full">
    <div class="heading font-semibold">
      <h1>{{ title }}</h1>
    </div>
    <div class="flex justify-between items-center gap-20 ml-20">
      <slot name="actions"></slot>
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
      <button
        v-if="rollbackPageName"
        class="rollback-btn cursor-pointer rounded-[50%] bg-red-500 flex justify-center items-center w-16 h-16 shadow shadow-slate-300"
        style="color: #b197fc"
        @click="navigateToRollback"
      >
        <i class="fa-solid fa-arrow-rotate-left fa-xl" style="color: #fff"></i>
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
        <SearchResults
          v-if="searchResults.length > 0 && searchKeyword !== ''"
          :results="limitedSearchResults"
          @itemClicked="showItem"
        >
          <template #item="{ item }">
            <slot name="item" :item="item">
              <strong>{{ item.name }}</strong>
              <p class="overflow-hidden text-ellipsis whitespace-nowrap">
                {{ item.description }}
              </p>
            </slot>
          </template>
        </SearchResults>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useNavigation } from "../../composables/useNavigation";
import { useSearch } from "../../composables/useSearch";
import SearchResults from "./SearchResults.vue";

const props = defineProps({
  title: String,
  searchEndpoint: String,
  listPageName: String,
  formPageName: String,
  rollbackPageName: String,
});

const { navigateToCreate, navigateToList, isListPage, navigateToRollback } =
  useNavigation(props.listPageName, props.formPageName, props.rollbackPageName);
const {
  searchKeyword,
  searchResults,
  debouncedSearch,
  limitedSearchResults,
  showItem,
} = useSearch(props.searchEndpoint);
</script>

<style scoped></style>
