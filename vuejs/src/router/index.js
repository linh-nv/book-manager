import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/LoginPage.vue";
import Home from "../pages/HomePage.vue";
import LendTicket from "../pages/LendTicketPage.vue";
import LendTicketForm from "../components/LendTicket/LendTicketForm.vue";
import LendTicketList from "../components/LendTicket/LendTicketList.vue";
import LendTicketRollBack from "../components/LendTicket/LendTicketRollBack.vue";

import { useUserStore } from "../stores/userStore";
import { useActiveRouteStore } from "../stores/activeRouteStore";
import TicketDetail from "../pages/TicketDetailPage.vue";
import TicketDetailForm from "../components/TicketDetail/TicketDetailForm.vue";
import TicketDetailList from "../components/TicketDetail/TicketDetailList.vue";

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
      {
        path: "rollback",
        name: "rollback-lend-ticket",
        component: LendTicketRollBack,
      },
    ],
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
