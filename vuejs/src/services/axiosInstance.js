import axios from 'axios';
import { API_BASE_URL } from '../config'

const axiosInstance = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Thêm các interceptor nếu cần thiết
axiosInstance.interceptors.request.use(
  config => {
    // Thêm logic xử lý request tại đây
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

axiosInstance.interceptors.response.use(
  response => {
    // Thêm logic xử lý response tại đây
    return response;
  },
  error => {
    return Promise.reject(error);
  }
);

export default axiosInstance;