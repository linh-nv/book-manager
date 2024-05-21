<template>
  <div>
    <Header />
    <div class="signup-container flex mb-40">
      <div class="sigup-left">
        <img src="../assets/images/side-image.png" alt="side-image" />
      </div>
      <div class="sigup-right flex flex-col gap-12 w-2/5 p-[12rem]">
        <h2 class="text-5xl font-medium">Log in to Exclusive</h2>
        <h3 class="text-2xl font-medium">Enter your details below</h3>
        <form @submit.prevent="createAccount" class="flex flex-col gap-10">
          <input
            v-model="email"
            type="email"
            placeholder="Email or Phone Number"
            class="w-full border-b-2 border-gray-400 py-2 mt focus:outline-none"
          />
          <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="w-full border-b-2 border-gray-400 py-2 mt focus:outline-none"
          />
          <div class="login-box w-full flex justify-between items-center">
            <button type="submit" class="bg-[#DB4444] text-white py-5 px-16 rounded-lg">
              Log In
            </button>
            <router-link class="text-[#DB4444]">Forget Password?</router-link>
          </div>
        </form>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from "vue";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

const name = ref("");
const email = ref("");
const password = ref("");

const createAccount = () => {
  console.log({
    name: name.value,
    email: email.value,
    password: password.value,
  });
};

const signUpWithGoogle = () => {
  console.log("Sign up with Google");
};
</script>

<style></style>
