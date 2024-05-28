import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Home from "../pages/HomePage.vue";
import Author from "../pages/AuthorPage.vue";
import AuthorForm from "../components/Author/AuthorForm.vue";
import AuthorList from "../components/Author/AuthorList.vue";

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
    path: "/author",
    name: "author",
    component: Author,
    redirect: "/author/list",
    children: [
      {
        path: "list",
        name: "author-list",
        component: AuthorList,
      },
      {
        path: "form",
        name: "author-form",
        component: AuthorForm,
      },
      {
        path: "form/:id",
        name: "author-form-edit",
        component: AuthorForm,
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
