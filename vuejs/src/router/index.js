import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Login from '../components/Login.vue';
import auth from '../auth';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Global guard để kiểm tra xác thực
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!auth.isAuthenticated()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath } // Lưu route hiện tại để chuyển hướng sau khi đăng nhập
      });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
