import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Home from "../pages/HomePage.vue";
import Publisher from "../pages/PublisherPage.vue";
import PublisherForm from "../components/Publisher/PublisherForm.vue";
import PublisherList from "../components/Publisher/PublisherList.vue";
import PublisherRollBack from "../components/Publisher/PublisherRollBack.vue";

import { useUserStore } from "../stores/userStore";
import { useActiveRouteStore } from "../stores/activeRouteStore";

const routes = [
  {
    path: "/",
    component: Login,
    alias: "/login",
    meta: { publicPath: true },
  },
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: { publicPath: true },
  },
  {
    path: "/home",
    name: "home",
    component: Home,
  },
  {
    path: "/publisher",
    name: "publisher",
    component: Publisher,
    redirect: "/publisher/list",
    children: [
      {
        path: "list",
        name: "publisher-list",
        component: PublisherList,
      },
      {
        path: "form",
        name: "publisher-form",
        component: PublisherForm,
      },
      {
        path: "form/:id",
        name: "publisher-form-edit",
        component: PublisherForm,
      },
      {
        path: "rollback",
        name: "rollback-publisher",
        component: PublisherRollBack,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  const activeRouteStore = useActiveRouteStore();

  if (
    !to.matched.some((record) => record.meta.publicPath) &&
    !userStore.accessToken
  ) {
    next({ name: "login" });
  } else {
    activeRouteStore.setActiveRoute(to.path);
    next();
  }
});

export default router;
