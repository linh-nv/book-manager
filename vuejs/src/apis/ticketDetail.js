import { apiService } from "./base";
import axiosInstance from "./axiosInstance";

const endpoint = "/ticket-detail";

export const ticketService = {
  getAll(page) {
    return apiService.getAll(endpoint, page);
  },

  async getLendTicket(id) {
    try {
      const response = await axiosInstance.get(`${endpoint}/lend-ticket/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  create(data) {
    return apiService.create(endpoint, data);
  },

  update(id, data) {
    return apiService.update(endpoint, id, data);
  },

  find(id) {
    return apiService.find(`${endpoint}`, id);
  },

  delete(id) {
    return apiService.delete(endpoint, id);
  },
};
