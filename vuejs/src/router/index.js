import { createRouter, createWebHistory } from "vue-router";
import admin from "./admin";
import Login from "../pages/LoginPage.vue";
import Register from "../pages/register.vue";
import Home from "../pages/Home.vue";
import { useUserStore } from '../stores/userStore';

const routes = [
    ...admin,
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
  {
    path: "/home",
    name: "home",
    component: Home,
    meta: { requiresAuth: true }, // Thêm meta để xác định route yêu cầu đăng nhập
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  if (
    to.matched.some((record) => record.meta.requiresAuth) &&
    !userStore.accessToken
  ) {
    next({ name: "login" });
  } else {
    next();
  }
});

export default router;
