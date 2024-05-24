import { createRouter, createWebHistory } from "vue-router";
import adminRoutes from "./admin";
import Login from "../pages/LoginPage.vue";
import Register from "../pages/RegisterPage.vue";
import Home from "../pages/HomePage.vue";
import Dashboard from "../pages/DashboardPage.vue";
import Author from "../pages/AuthorPage.vue";
import Publisher from "../pages/PublisherPage.vue";
import Category from "../pages/CategoryPage.vue";
import Book from "../pages/BookPage.vue";
import LendTicket from "../pages/LendTicketPage.vue";
import Setting from "../pages/SettingPage.vue";
import Logout from "../pages/LogoutPage.vue";
import { useUserStore } from '../stores/userStore';

const routes = [
  ...adminRoutes,
  { 
    path: '/', 
    component: Login, 
    alias: '/login',
    meta: { publicPath: true },
  },
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: { publicPath: true },
  },
  {
    path: "/register",
    name: "register",
    component: Register,
    meta: { publicPath: true },
  },
  {
    path: "/home",
    name: "home",
    component: Home,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
  },
  {
    path: "/author",
    name: "author",
    component: Author,
  },
  {
    path: "/publisher",
    name: "publisher",
    component: Publisher,
  },
  {
    path: "/category",
    name: "category",
    component: Category,
  },
  {
    path: "/book",
    name: "book",
    component: Book,
  },
  {
    path: "/lend-ticket",
    name: "lend-ticket",
    component: LendTicket,
  },
  {
    path: "/setting",
    name: "setting",
    component: Setting,
  },
  {
    path: "/logout",
    name: "logout",
    component: Logout,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  if (to.matched.some(record => !record.meta.publicPath) && !userStore.accessToken) {
    next({ name: "login" });
  } else {
    next();
  }
});

export default router;