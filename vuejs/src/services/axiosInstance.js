import axios from 'axios';
import { API_BASE_URL } from '../config';
import { useUserStore } from '../stores/userStore';
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
    const token = userStore.accessToken;
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

axiosInstance.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.response) {
      const userStore = useUserStore();
      userStore.setAccessToken(null);  // Clear the access token
      router.push({ name: 'login' });  // Redirect to login page
    }
    return Promise.reject(error);
  }
);

export default axiosInstance;
