import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Register from "../pages/RegisterPage.vue";
import Home from "../pages/HomePage.vue";
import Author from "../pages/AuthorPage.vue";
import AuthorForm from "../components/Author/AuthorForm.vue";
import AuthorList from "../components/Author/AuthorList.vue";
import Publisher from "../pages/PublisherPage.vue";
import PublisherForm from "../components/Publisher/PublisherForm.vue";
import PublisherList from "../components/Publisher/PublisherList.vue";
import Category from "../pages/CategoryPage.vue";
import CategoryForm from "../components/Category/CategoryForm.vue";
import CategoryList from "../components/Category/CategoryList.vue";
import Book from "../pages/BookPage.vue";
import BookForm from "../components/Book/BookForm.vue";
import BookList from "../components/Book/BookList.vue";
import LendTicket from "../pages/LendTicketPage.vue";
import LendTicketForm from "../components/LendTicket/LendTicketForm.vue";
import LendTicketList from "../components/LendTicket/LendTicketList.vue";
import UserProfile from "../pages/UserProfile.vue";
import TicketDetail from "../pages/TicketDetailPage.vue";
import TicketDetailForm from "../components/TicketDetail/TicketDetailForm.vue";
import TicketDetailList from "../components/TicketDetail/TicketDetailList.vue";
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
    ],
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
    ],
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
    ],
  },
  {
    path: "/lend-ticket",
    name: "lend-ticket",
    component: LendTicket,
    redirect: "/lend-ticket/list",
    children: [
      {
        path: "list",
        name: "lend-ticket-list",
        component: LendTicketList,
      },
      {
        path: "form",
        name: "lend-ticket-form",
        component: LendTicketForm,
      },
      {
        path: "form/:id",
        name: "lend-ticket-form-edit",
        component: LendTicketForm,
      },
    ],
  },
  {
    path: "/profile",
    name: "profile",
    component: UserProfile,
  },
  {
    path: "/ticket-detail/lend-ticket",
    name: "ticket-detail",
    component: TicketDetail,
    redirect: "/ticket-detail/lend-ticket/:id",
    children: [
      {
        path: ":id",
        name: "ticket-detail-list",
        component: TicketDetailList,
      },
      {
        path: "form/:id",
        name: "ticket-detail-form",
        component: TicketDetailForm,
      },
      {
        path: "form-edit/:id",
        name: "ticket-detail-form-edit",
        component: TicketDetailForm,
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
