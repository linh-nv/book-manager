<template>
    <footer class="bg-primary pb-5 text-white">
      <div class="footer-container spacing flex justify-between py-40">
        <div class="footer-section flex flex-col gap-6 font-light">
          <h3 class="text-4xl font-semibold pb-5">Exclusive</h3>
          <p class="font-medium text-2xl">Subscribe</p>
          <div class="send-mail-input relative">
            <input type="text" placeholder="Enter your email" class="bg-transparent p-5 border-[2.3px] border-white rounded-lg placeholder:opacity-40 placeholder-white"/>
            <img src="../assets/icon/Vector.svg" alt="paper-planer" class="absolute top-1/3 right-5">
          </div>
        </div>
        <div class="footer-section flex flex-col gap-6 font-light">
          <h3 class="text-3xl font-medium pb-5">Support</h3>
          <p>111 Bijoy sarani, Dhaka, DH 1515, Bangladesh.</p>
          <p>exclusive@gmail.com</p>
          <p>+88015-88888-9999</p>
        </div>
        <div class="footer-section flex flex-col gap-6 font-light">
          <h3 class="text-3xl font-medium pb-5">Account</h3>
          <ul class="flex flex-col gap-6">
            <li><a href="#">My Account</a></li>
            <li><a href="#">Login / Register</a></li>
            <li><a href="#">Cart</a></li>
            <li><a href="#">Wishlist</a></li>
            <li><a href="#">Shop</a></li>
          </ul>
        </div>
        <div class="footer-section flex flex-col gap-6 font-light">
          <h3 class="text-3xl font-medium pb-5">Quick Link</h3>
          <ul class="flex flex-col gap-6">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms Of Use</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-section flex flex-col gap-6 font-light">
          <h3 class="text-3xl font-medium pb-5">Download App</h3>
          <span class="text-lg opacity-70">Save $3 with App New User Only</span>
          <div class="flex gap-3">
            <div class="qr-code flex items-center">
              <a href="#"><img src="../assets/images/Qr Code.png" alt="QR code" /></a>
            </div>
            <div class="store-app flex flex-col gap-1">
              <a href="#"><img src="../assets/images/GooglePlay.png" alt="Google Play" /></a>
              <a href="#"><img src="../assets/images/AppStore.png" alt="App Store" /></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom flex justify-center text-white opacity-20">
        <p>© Copyright Rimel 2022. All rights reserved</p>
      </div>
    </footer>
  </template>
  
  <script setup>
  </script>
  
  <style>
  
  </style>