export default {
    isAuthenticated() {
      // kiểm tra xác thực, kiểm tra token trong localStorage
      return !!localStorage.getItem('user-token');
    }
};
  