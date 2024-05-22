<template>
  <div @submit.prevent="loginAccount" class="auth">
    <form class="form-login" id="form-login">
      <header class="form-top">
        <h1>Login to Account</h1>
        <span class="note">Please enter your email and password to continue</span>
      </header>
      <div class="form-mid">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input
            v-model="email"
            id="email"
            type="text"
            placeholder="esteban_schiller@gmail.com"
            class="focus:outline-none"
            name="email"
          />
          <span class="form-message"></span>
        </div>
        <div class="form-group">
          <div class="password-note">
            <label for="password">Password:</label>
            <a href="" class="hover:text-blue-600">Forget Password?</a>
          </div>
          <input
            v-model="password"
            id="password"
            type="password"
            class="focus:outline-none"
            name="password"
          />
          <span class="form-message"></span>
          <div class="remember-password">
            <input type="checkbox" name="" id="remember" />
            <label for="remember">Remember Password</label>
          </div>
        </div>
      </div>
      <div class="form-bottom">
        <button class="login-btn">Sign In</button>
        <div class="create-account">
          <span>Don’t have an account?</span>
          <a href="">Create Account</a>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import { API_BASE_URL } from "../config";
import { useUserStore } from "../stores/userStore";

// Import validate.js
import Validator from "../assets/js/validator";

const email = ref("");
const password = ref("");

const router = useRouter();
const userStore = useUserStore();

const loginAccount = async () => {
  // Perform validation before submitting
  const isValid = validator.validate();
  if (!isValid) {
    console.error("Validation failed");
    return;
  }

  try {
    const response = await axios.post(`${API_BASE_URL}/login`, {
      email: email.value,
      password: password.value,
    });
    const { access_token, expires_in, user } = response.data;
    localStorage.setItem("access_token", access_token);

    // Set token expiration time
    const expirationTime = new Date().getTime() + expires_in * 1000;
    localStorage.setItem("token_expiration", expirationTime);

    // Set Axios default header with the token
    axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;

    // Save user info and token to Pinia store
    userStore.setUser(user);
    userStore.setAccessToken(access_token);
    userStore.setTokenExpiration(expirationTime);

    // Navigate to home route
    router.push({ name: "home" });

    // Set up token refresh before it expires
    setTimeout(refreshToken, (expires_in - 60) * 1000); // refresh 1 minute before expiration
  } catch (error) {
    console.error("Login failed:", error);
  }
};

const refreshToken = async () => {
  try {
    const response = await axios.post(`${API_BASE_URL}/refresh`);
    const { access_token, expires_in } = response.data;
    localStorage.setItem("access_token", access_token);

    // Update token expiration time
    const expirationTime = new Date().getTime() + expires_in * 1000;
    localStorage.setItem("token_expiration", expirationTime);

    // Update Axios default header with the new token
    axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;

    // Update Pinia store with new token and expiration
    userStore.setAccessToken(access_token);
    userStore.setTokenExpiration(expirationTime);

    // Set up token refresh before it expires
    setTimeout(refreshToken, (expires_in - 60) * 1000); // refresh 1 minute before expiration
  } catch (error) {
    console.error("Token refresh failed:", error);
  }
};

let validator;
onMounted(() => {
  validator = new Validator({
    form: "#form-login",
    formGroupSelector: ".form-group",
    errorSelector: ".form-message",
    rules: [
      Validator.isRequired("#email", "Email is required"),
      Validator.isEmail("#email", "Please enter a valid email"),
      Validator.isRequired("#password", "Password is required"),
      Validator.minLength("#password", 8, "Password must be at least 8 characters"),
    ],
    onSubmit: function () {
      console.log("Form is valid");
    },
  });
});
</script>

<style>
.auth {
  width: 100vw;
  height: 100vh;
  font-size: 1.45rem;
  line-height: 21.82px;
  color: var(--text-color);
  background-color: var(--background-color);
  background-image: url("../assets/images/background-login.png");
  display: flex;
  justify-content: center;
  align-items: center;
  overflow-x: hidden;
}
.form-login {
  display: flex;
  flex-direction: column;
  border-radius: 20px;
  background-color: var(--primary-color);
  padding: 90px 57px;
  width: 630px;
  gap: 40px;
}
.form-top {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 15px;
}

.form-mid {
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.form-mid .form-group input {
  border: 1px solid var(--border-color);
  background-color: var(--input-color);
  border-radius: 10px;
  padding: 15px;
  width: 100%;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.form-group label {
  font-size: 14px;
}
.password-note {
  display: flex;
  font-size: 14px;
  justify-content: space-between;
}
.remember-password {
  display: flex;
  justify-content: start;
  align-items: center;
  gap: 10px;
}
.remember-password label {
  cursor: pointer;
}
.remember-password input {
  cursor: pointer;
}
#password {
  margin-bottom: 24px;
}
#remember {
  width: 2rem;
  border-radius: 10px;
}

.form-bottom {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 18px;
}
.form-bottom button {
  font-size: 18px;
  color: var(--primary-color);
  background-color: var(--background-color);
  border: none;
  border-radius: 10px;
  width: 100%;
  padding: 2rem;
  cursor: pointer;
}
.create-account {
  display: flex;
  gap: 0.6rem;
}
.create-account a {
  text-decoration: underline;
  color: var(--background-color);
}
.invalid .form-message {
  color: red;
  font-size: 12px;
}
.invalid input {
  border-color: red;
}
</style>
