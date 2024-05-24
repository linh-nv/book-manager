import { createRouter, createWebHistory } from "vue-router";
import adminRoutes from "./admin";
import Login from "../pages/LoginPage.vue";
import Register from "../pages/RegisterPage.vue";
import Home from "../pages/HomePage.vue";
import Author from "../pages/AuthorPage.vue";
import Publisher from "../pages/PublisherPage.vue";
import Category from "../pages/CategoryPage.vue";
import Book from "../pages/BookPage.vue";
import LendTicket from "../pages/LendTicketPage.vue";
import UserProfile from "../pages/UserProfile.vue";
import Logout from "../pages/LogoutPage.vue";
import { useUserStore } from '../stores/userStore';
import { useActiveRouteStore } from '../stores/activeRouteStore';

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
    path: "/profile",
    name: "profile",
    component: UserProfile,
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
  const activeRouteStore = useActiveRouteStore();
  
  if (to.matched.some(record => record.meta.requiresAuth) && !userStore.accessToken) {
    next({ name: "login" });
  } else {
    activeRouteStore.setActiveRoute(to.path);
    next();
  }
});

export default router;