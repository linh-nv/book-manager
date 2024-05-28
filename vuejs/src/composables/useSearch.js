import { ref, computed } from "vue";
import { debounce } from "lodash-es";
import { useRouter } from "vue-router";
import { apiService } from "../apis/base";

export function useSearch(searchEndpoint) {
  const searchKeyword = ref("");
  const searchResults = ref([]);
  const router = useRouter();

  const searchItems = async () => {
    if (searchKeyword.value !== "") {
      try {
        const data = await apiService.search(
          searchEndpoint,
          searchKeyword.value
        );
        searchResults.value = data.data;
      } catch (error) {
        console.error("Error searching items:", error);
      }
    }
  };

  const debouncedSearch = debounce(searchItems, 1000);

  const limitedSearchResults = computed(() => {
    return searchResults.value.slice(0, 8);
  });

  const showItem = (id) => {
    searchKeyword.value = "";
    router.push({
      name: `${searchEndpoint.slice(1)}-form-edit`,
      params: { id },
    });
  };

  return {
    searchKeyword,
    searchResults,
    debouncedSearch,
    limitedSearchResults,
    showItem,
  };
}
