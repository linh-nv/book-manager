import axios from 'axios';
import { API_BASE_URL } from '../config';
import { useUserStore } from '../stores/userStore';
import { useLoadingStore } from '../stores/loadingStore';
import router from '../router'; 

const axiosInstance = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

axiosInstance.interceptors.request.use(
  config => {
    const userStore = useUserStore();
    const loadingStore = useLoadingStore();
    const token = userStore.accessToken;

    loadingStore.setLoading(true);

    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  error => {
    const loadingStore = useLoadingStore();
    loadingStore.setLoading(false); 
    return Promise.reject(error);
  }
);

axiosInstance.interceptors.response.use(
  response => {
    const loadingStore = useLoadingStore();
    loadingStore.setLoading(false);
    return response;
  },
  error => {
    const loadingStore = useLoadingStore();
    loadingStore.setLoading(false);
    if (error.response) {
      const userStore = useUserStore();
      userStore.setAccessToken(null);  // Xóa token
      router.push({ name: 'login' });  // Chuyển hướng đến trang login
    }
    return Promise.reject(error);
  }
);

export default axiosInstance;
