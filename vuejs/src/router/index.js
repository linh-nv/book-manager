import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Home from "../pages/HomePage.vue";
import Category from "../pages/CategoryPage.vue";
import CategoryForm from "../components/Category/CategoryForm.vue";
import CategoryList from "../components/Category/CategoryList.vue";
import CategoryRollBack from "../components/Category/CategoryRollBack.vue";

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
    path: "/category",
    name: "category",
    component: Category,
    redirect: "/category/list",
    children: [
      {
        path: "list",
        name: "category-list",
        component: CategoryList,
      },
      {
        path: "form",
        name: "category-form",
        component: CategoryForm,
      },
      {
        path: "form/:id",
        name: "category-form-edit",
        component: CategoryForm,
      },
      {
        path: "rollback",
        name: "rollback-category",
        component: CategoryRollBack,
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
