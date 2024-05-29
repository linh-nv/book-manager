import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Home from "../pages/HomePage.vue";
import Book from "../pages/BookPage.vue";
import BookForm from "../components/Book/BookForm.vue";
import BookList from "../components/Book/BookList.vue";
import BookRollBack from "../components/Book/BookRollBack.vue";
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
    path: "/book",
    name: "book",
    component: Book,
    redirect: "/book/list",
    children: [
      {
        path: "list",
        name: "book-list",
        component: BookList,
      },
      {
        path: "form",
        name: "book-form",
        component: BookForm,
      },
      {
        path: "form/:id",
        name: "book-form-edit",
        component: BookForm,
      },
      {
        path: "rollback",
        name: "rollback-book",
        component: BookRollBack,
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
