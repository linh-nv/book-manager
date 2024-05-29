import { apiService } from "./base";
import axiosInstance from "./axiosInstance";

const endpoint = "/user";
const profile = "/me";

export const userService = {
  async profile() {
    try {
      const response = await axiosInstance.get(`${profile}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },
  async changePassword(current_password, new_password, new_password_confirmation) {
    try {
      const response = await axiosInstance.post(`${profile}`, current_password, new_password, new_password_confirmation);
      return response.data;
    } catch (error) {
      throw error;
    }
  },
  getAll(page) {
    return apiService.getAll(endpoint, page);
  },

  create(data) {
    return apiService.create(endpoint, data);
  },

  update(id, data) {
    return apiService.update(endpoint, id, data);
  },

  find(id) {
    return apiService.find(endpoint, id);
  },

  delete(id) {
    return apiService.delete(endpoint, id);
  },
};
