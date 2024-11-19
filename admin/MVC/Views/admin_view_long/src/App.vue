<script setup>
// No imports needed
</script>

<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link> |
    <router-link to="/dashboard">Dashboard</router-link>
  </nav>
  
  <router-view></router-view>
</template>

<style scoped>
nav {
  padding: 1rem;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

nav a {
  color: #666;
  text-decoration: none;
  padding: 0.5rem 1rem;
}

nav a:hover {
  color: #333;
}
</style>
