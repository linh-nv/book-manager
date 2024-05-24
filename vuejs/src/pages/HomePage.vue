<template>
  <div>
    <HeaderComponent />
    <NavbarComponent />
    <div
      class="content-page"
    >
      <div class="heading font-semibold">
        <h1>Dashboard</h1>
      </div>
      <div class="content">
        <div class="card-element">
          <div class="card-description">
            <div class="title">Total Books</div>
            <div class="total"><strong>123.32</strong></div>
          </div>
          <div class="card-icon">
            <img src="../assets/images/book-icon.png" alt="" />
          </div>
        </div>
        <div class="card-element">
          <div class="card-description">
            <div class="title">Total Category</div>
            <div class="total"><strong>123.32</strong></div>
          </div>
          <div class="card-icon">
            <img src="../assets/images/category-icon.png" alt="" />
          </div>
        </div>
        <div class="card-element">
          <div class="card-description">
            <div class="title">Total Price</div>
            <div class="total"><strong>123.32</strong></div>
          </div>
          <div class="card-icon">
            <img src="../assets/images/price-icon.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    <FooterComponent />
  </div>
</template>

<script setup>
import { useUserStore } from "../stores/userStore";
import { useRouter } from "vue-router";
import HeaderComponent from "../components/HeaderComponent.vue";
import NavbarComponent from "../components/NavbarComponent.vue";
import FooterComponent from "../components/FooterComponent.vue";

const userStore = useUserStore();
const user = userStore.user;
const router = useRouter();

const logout = () => {
  userStore.logout();
  router.push({ name: "login" });
};
</script>

<style>
.home-container {
  padding: 2rem;
}
</style>
