<template>
  <div class="auth">
    <form @submit.prevent="loginAccount" class="form-login" id="form-login">
      <header class="form-top">
        <h1>Login to Account</h1>
        <span class="note">Please enter your email and password to continue</span>
      </header>
      <div class="form-mid">
        <div class="form-group">
          <label for="email">Email address:</label>
          <Field
            v-model="email"
            name="email"
            id="email"
            type="text"
            placeholder="esteban_schiller@gmail.com"
            class="focus:outline-none"
          />
          <ErrorMessage name="email" class="form-message text-red-500" />
        </div>
        <div class="form-group">
          <div class="password-note">
            <label for="password">Password:</label>
          </div>
          <Field
            v-model="password"
            name="password"
            id="password"
            type="password"
            class="focus:outline-none"
          />
          <ErrorMessage name="password" class="form-message text-red-500" />
        </div>
      </div>
      <div class="form-bottom">
        <button class="login-btn" type="submit">Sign In</button>
        <div class="create-account">
          <span>Don’t have an account?</span>
          <a href="#register">Create Account</a>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from "../stores/userStore";
import { login } from "../apis/auth";
import { useForm, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";

const router = useRouter();
const userStore = useUserStore();
const email = ref("");
const password = ref("");
const loginAccount = async () => {
  try {
    const response = await login({
      email: email.value,
      password: password.value,
    });
    router.push({ name: "home" });
  } catch (error) {
    alert("An unexpected error occurred. Please try again.");
  }
};

const validationSchema = yup.object({
  email: yup.string().email().required("Email is required"),
  password: yup.string().min(6, "Password must be at least 6 characters").required("Password is required"),
});

const { handleSubmit } = useForm({
  validationSchema,
});
</script>


<style scoped>
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
