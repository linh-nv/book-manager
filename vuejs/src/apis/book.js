import { apiService } from "./base";
import axiosInstance from "../services/axiosInstance";

const endpoint = "/book";

export const bookService = {
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

  async getAllCategoriesAuthorsPublishers() {
    try {
      const response = await axiosInstance.get(`${endpoint}/all`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },
  async updateBook(endpoint, id, data) {
    try {
      const response = await axiosInstance.post(`${endpoint}/${id}?method=PUT`, data, {
        headers: { "Content-Type": "multipart/form-data" },
      });
      return response.data;
    } catch (error) {
      handleError(error);
      throw error;
    }
  },
};
