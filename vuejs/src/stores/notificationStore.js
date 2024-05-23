import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useNotificationStore = defineStore('notification', () => {
  const message = ref('');
  const type = ref('');

  const showNotification = (msg, msgType) => {
    message.value = msg;
    type.value = msgType;
  };

  const clearNotification = () => {
    message.value = '';
    type.value = '';
  };

  return {
    message,
    type,
    showNotification,
    clearNotification,
  };
});