<template>
  <div class="app-wrapper">
    <Sidebar class="sidebar-container" />
    <div class="main-container">
      <Navbar />
      <AppMain />
    </div>
  </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue'
import Sidebar from './components/Sidebar.vue'
import AppMain from './components/AppMain.vue'

defineOptions({
  name: 'Layout'
})
</script>

<style lang="scss" scoped>
@use "@/styles/index" as *;
.app-wrapper {
  position: relative;
  height: 100vh;
  width: 100%;
  display: flex;
}

.main-container {
  flex: 1;
  min-height: 100%;
  position: relative;
  overflow: auto;
  margin-left: 210px;
}

.sidebar-container {
  width: 210px;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  background-color: #304156;
  transition: width 0.28s;
  z-index: 1001;
}

.fixed-header {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 9;
  width: calc(100% - 210px);
  transition: width 0.28s;
  background-color: #fff;
}
</style>
