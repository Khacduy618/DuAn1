<template>
  <div class="app-container">
    <el-row :gutter="20">
      <el-col :span="24">
        <div class="grid-content">
          <h1>Nested Routes Example</h1>
          <p>This is the nested routes demo page.</p>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script setup>
// No additional logic needed for this simple component
</script>

<style scoped>
.grid-content {
  padding: 20px;
  background: #fff;
  border-radius: 4px;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

p {
  font-size: 16px;
  color: #666;
}
</style> 