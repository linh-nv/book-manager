import { ref, watch } from "vue";
import { useRouter, useRoute } from "vue-router";

export function useNavigation(listPageName, formPageName) {
  const router = useRouter();
  const route = useRoute();

  const isListPage = ref(route.name === listPageName);

  const navigateToCreate = () => {
    router.push({ name: formPageName });
  };

  const navigateToList = () => {
    router.back();
  };

  watch(route, (newRoute) => {
    isListPage.value = newRoute.name === listPageName;
  });

  return {
    isListPage,
    navigateToCreate,
    navigateToList,
  };
}
