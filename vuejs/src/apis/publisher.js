import { apiService } from './base';

const endpoint = '/publisher';
const trashedEndpoint = "/trashed/publisher";
const restoreEndpoint = "/restore/publisher";

export const publisherService = {
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

  getTrashed() {
    return apiService.get(trashedEndpoint);
  },

  restore(id) {
    return apiService.post(`${restoreEndpoint}/${id}`);
  },

};
