<template>
  <div class="login-container">
    <el-form class="login-form">
      <h3>Login</h3>
      <el-input v-model="username" placeholder="Username" />
      <el-input v-model="password" type="password" placeholder="Password" />
      <el-button type="primary" @click="handleLogin">Login</el-button>
    </el-form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const username = ref('')
const password = ref('')

const handleLogin = () => {
  // Add any login logic here if needed
  router.push('/dashboard')  // This will redirect to dashboard after login
}
</script>

<style scoped>
.login-container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #2d3a4b;
}

.login-form {
  width: 300px;
  padding: 20px;
  background: white;
  border-radius: 4px;
}

.el-input {
  margin-bottom: 20px;
}

.el-button {
  width: 100%;
}

h3 {
  text-align: center;
  margin-bottom: 30px;
}
</style>

