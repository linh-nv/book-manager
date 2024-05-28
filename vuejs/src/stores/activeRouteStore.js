import { defineStore } from 'pinia';

export const useActiveRouteStore = defineStore('activeRoute', {
  state: () => ({
    activeRoute: '/home',
  }),
  actions: {
    setActiveRoute(route) {
      this.activeRoute = route;
    },
  },
});