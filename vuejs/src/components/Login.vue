<template>
    <div>
      <h1>Login</h1>
      <form @submit.prevent="login">
        <input type="text" v-model="username" placeholder="Username" />
        <input type="password" v-model="password" placeholder="Password" />
        <button type="submit">Login</button>
      </form>
    </div>
</template>
  
<script>
  export default {
    data() {
      return {
        username: '',
        password: ''
      };
    },
    methods: {
      login() {
        // Giả lập quá trình xác thực, sau đó lưu token vào localStorage
        localStorage.setItem('user-token', 'token');
        const redirect = this.$route.query.redirect || '/';
        this.$router.push(redirect);
      }
    }
  };
</script>
  