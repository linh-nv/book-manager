<template>
  <div>
    <Header />
    <div class="signup-container flex mb-40">
      <div class="sigup-left">
        <img src="../assets/images/side-image.png" alt="side-image" />
      </div>
      <div class="sigup-right flex flex-col gap-12 w-2/5 p-[12rem]">
        <h2 class="text-5xl font-medium">Create an account</h2>
        <h3 class="text-2xl font-medium">Enter your details below</h3>
        <form @submit.prevent="createAccount" class="flex flex-col gap-10">
          <input
            v-model="name"
            type="text"
            placeholder="Name"
            class="w-full border-b-2 border-gray-400 py-2 mt focus:outline-none"
          />
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
          <button type="submit" class="bg-primary text-white py-5 rounded-lg">
            Create Account
          </button>
          <div
            class="signup-google flex justify-center gap-5 py-5 border-2 border-gray-400 rounded-lg"
          >
            <img src="../assets/images/Icon-Google.png" alt="" />
            <button type="button" @click="signUpWithGoogle">
              Sign up with Google
            </button>
          </div>
        </form>
        <span class="w-full flex justify-center">
          <p class="opacity-70">Already have an account?</p>
          <router-link to="/login" class="border-b-2 border-gray-500 mx-5 font-semibold opacity-80">
            Log in</router-link
          >
        </span>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from "vue";
import Header from "../components/HeaderComponent.vue";
import Footer from "../components/FooterComponent.vue";

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
