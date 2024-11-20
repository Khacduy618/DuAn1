<template>
  <div class="app-container">
    <el-table
      v-loading="loading"
      :data="tableData"
      element-loading-text="Loading..."
      border
      fit
      highlight-current-row
    >
      <el-table-column align="center" label="ID" width="95">
        <template #default="scope">
          {{ scope.$index }}
        </template>
      </el-table-column>
      
      <el-table-column label="Title">
        <template #default="scope">
          {{ scope.row.title }}
        </template>
      </el-table-column>
      
      <el-table-column label="Author" width="110" align="center">
        <template #default="scope">
          <span>{{ scope.row.author }}</span>
        </template>
      </el-table-column>
      
      <el-table-column label="Pageviews" width="110" align="center">
        <template #default="scope">
          {{ scope.row.pageviews }}
        </template>
      </el-table-column>
      
      <el-table-column class-name="status-col" label="Status" width="110" align="center">
        <template #default="scope">
          <el-tag :type="statusFilter(scope.row.status)">
            {{ scope.row.status }}
          </el-tag>
        </template>
      </el-table-column>
      
      <el-table-column align="center" prop="created_at" label="Display_time" width="200">
        <template #default="scope">
          <el-icon><Timer /></el-icon>
          <span>{{ scope.row.display_time }}</span>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { ElLoading } from 'element-plus'
import { Timer } from '@element-plus/icons-vue'
import { getList } from '@/api/table'

const loading = ref(true)
const tableData = ref([])

const statusFilter = (status) => {
  const statusMap = {
    published: 'success',
    draft: 'gray',
    deleted: 'danger'
  }
  return statusMap[status]
}

const fetchData = async () => {
  try {
    loading.value = true
    const { data } = await getList()
    tableData.value = data.items
  } catch (error) {
    console.error('Error fetching table data:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchData()
})
</script>

<style lang="scss" scoped>
.app-container {
  padding: 20px;
}

.el-table {
  .status-col {
    .el-tag {
      margin-right: 0px;
    }
  }
}

.el-icon {
  vertical-align: middle;
  margin-right: 5px;
}
</style>
