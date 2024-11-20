<template>
  <div v-if="icon" class="menu-icon-wrapper">
    <i v-if="icon.includes('el-icon')" :class="[icon, 'sub-el-icon']" />
    <el-icon v-else>
      <component :is="icon" />
    </el-icon>
    <span v-if="title">{{ title }}</span>
  </div>
</template>

<script setup>
defineProps({
  icon: {
    type: String,
    default: ''
  },
  title: {
    type: String,
    default: ''
  }
})
</script>

<style scoped>
.menu-icon-wrapper {
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.sub-el-icon {
  color: currentColor;
  width: 1em;
  height: 1em;
  margin-right: 5px;
}

.el-icon {
  margin-right: 5px;
  width: 1em;
  height: 1em;
}
</style>
