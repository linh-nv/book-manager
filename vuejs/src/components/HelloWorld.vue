<template>
  <div class="container">
    <p class="text">Hello, Scoped CSS!</p>
  </div>
</template>

<script>
export default {
  name: 'MyComponent'
};
</script>

<style scoped>
.container {
  background-color: lightblue;
}

.text {
  color: red;
}
</style>
