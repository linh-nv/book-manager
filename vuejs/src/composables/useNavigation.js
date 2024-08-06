import { ref, watch } from "vue";
import { useRouter, useRoute } from "vue-router";

export function useNavigation(listPageName, formPageName, rollbackPageName) {
  const router = useRouter();
  const route = useRoute();

  const isListPage = ref(route.name === listPageName);

  const navigateToCreate = () => {
    router.push({ name: formPageName });
  };
  const navigateToList = () => {
    if (listPageName === "ticket-detail-list") {
      router.back();
    } else {
      router.push({ name: listPageName });
    }
  };
  const navigateToRollback = () => {
    router.push({ name: rollbackPageName });
  };
  watch(route, (newRoute) => {
    isListPage.value = newRoute.name === listPageName;
  });

  return {
    isListPage,
    navigateToCreate,
    navigateToList,
    navigateToRollback,
  };
}
