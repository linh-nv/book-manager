<template>
  <header>
    <div
      class="top-bar bg-primary py-3 spacing flex justify-between text-text_white"
    >
      <span></span>
      <span class="sale-info"
        >Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!
        <a href="#" class="text-white font-bold">Shop Now</a></span
      >
      <span class="language-select">English ▼</span>
    </div>
    <nav class="spacing pt-20 pb-5 flex justify-between gap-20">
      <div class="logo font-bold text-4xl">Exclusive</div>
      <ul class="flex gap-20 font-medium">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/contact">Contact</router-link></li>
        <li><router-link to="/about">About</router-link></li>
        <li>
          <router-link to="/signup" class="header-btn-active"
            >Sign Up</router-link
          >
        </li>
      </ul>
      <div class="search-bar relative">
        <input
          type="text"
          placeholder="What are you looking for?"
          class="bg-secondary border-none py-3 pl-10 pr-32 rounded-lg focus:outline-none"
        />
        <i class="fa-solid fa-magnifying-glass absolute top-1/3 right-5"></i>
      </div>
    </nav>
    <div class="line border-b border-primary opacity-10 mb-16"></div>
  </header>
</template>

<script setup></script>

<style></style>
