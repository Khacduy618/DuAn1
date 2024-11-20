<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="filterText"
        placeholder="Filter keyword"
        class="filter-input"
      />
      <el-button type="primary" @click="handleAddNode">
        Add Node
      </el-button>
    </div>

    <el-tree
      ref="treeRef"
      :data="data"
      :props="defaultProps"
      :filter-node-method="filterNode"
      show-checkbox
      node-key="id"
      class="filter-tree"
      default-expand-all
      @node-click="handleNodeClick"
      @check="handleCheck"
    >
      <template #default="{ node, data }">
        <span class="custom-tree-node">
          <span>{{ node.label }}</span>
          <span>
            <el-button
              type="text"
              size="small"
              @click.stop="() => handleAppend(data)"
            >
              Append
            </el-button>
            <el-button
              type="text"
              size="small"
              @click.stop="() => handleDelete(node, data)"
            >
              Delete
            </el-button>
          </span>
        </span>
      </template>
    </el-tree>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { ElMessageBox, ElMessage } from 'element-plus'

const filterText = ref('')
const treeRef = ref(null)

const data = ref([
  {
    id: 1,
    label: 'Level one 1',
    children: [
      {
        id: 4,
        label: 'Level two 1-1',
        children: [
          {
            id: 9,
            label: 'Level three 1-1-1'
          },
          {
            id: 10,
            label: 'Level three 1-1-2'
          }
        ]
      }
    ]
  },
  {
    id: 2,
    label: 'Level one 2',
    children: [
      {
        id: 5,
        label: 'Level two 2-1'
      },
      {
        id: 6,
        label: 'Level two 2-2'
      }
    ]
  },
  {
    id: 3,
    label: 'Level one 3',
    children: [
      {
        id: 7,
        label: 'Level two 3-1'
      },
      {
        id: 8,
        label: 'Level two 3-2'
      }
    ]
  }
])

const defaultProps = {
  children: 'children',
  label: 'label'
}

const filterNode = (value, data) => {
  if (!value) return true
  return data.label.toLowerCase().includes(value.toLowerCase())
}

// Watch filterText changes
watch(filterText, (val) => {
  treeRef.value?.filter(val)
})

let id = 100

const handleNodeClick = (data) => {
  console.log(data)
}

const handleCheck = (data, checked) => {
  console.log(data, checked)
}

const handleAppend = (data) => {
  const newChild = { id: id++, label: 'New Node', children: [] }
  if (!data.children) {
    data.children = []
  }
  data.children.push(newChild)
}

const handleDelete = (node, data) => {
  ElMessageBox.confirm('Are you sure to delete this node?', 'Warning', {
    confirmButtonText: 'OK',
    cancelButtonText: 'Cancel',
    type: 'warning'
  })
    .then(() => {
      const parent = node.parent
      const children = parent.data.children || parent.data
      const index = children.findIndex(d => d.id === data.id)
      children.splice(index, 1)
      ElMessage({
        type: 'success',
        message: 'Delete completed'
      })
    })
    .catch(() => {
      ElMessage({
        type: 'info',
        message: 'Delete canceled'
      })
    })
}

const handleAddNode = () => {
  data.value.push({
    id: id++,
    label: 'New Root Node',
    children: []
  })
}
</script>

<style lang="scss" scoped>
.app-container {
  padding: 20px;

  .filter-container {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;

    .filter-input {
      width: 300px;
    }
  }

  .filter-tree {
    background: #fff;
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
  }

  .custom-tree-node {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-right: 8px;
  }
}
</style>

