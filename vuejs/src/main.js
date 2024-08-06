import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router/index.js';
import './assets/css/style.css';
import { initializeAuth } from './apis/auth';

const app = createApp(App);
const pinia = createPinia();
app.use(router);
app.use(pinia);

initializeAuth();

app.mount('#app');