import { apiService } from "./base";
import axiosInstance from "../services/axiosInstance";

const endpoint = "/lend-ticket";

export const lendTicketService = {
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
