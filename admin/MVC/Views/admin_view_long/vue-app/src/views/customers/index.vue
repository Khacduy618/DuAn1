<template>
  <div class="app-container">
    <!-- Customer Management Header -->
    <div class="header-actions">
      <h2>Customer Management</h2>
      <el-button type="primary" @click="dialogVisible = true">
        <el-icon><Plus /></el-icon>
        Add Customer
      </el-button>
    </div>

    <!-- Customer Filter Section -->
    <el-card class="filter-section">
      <el-form :inline="true" :model="filterForm">
        <el-form-item v-for="field in filterFields" :key="field.name" :label="field.label">
          <template v-if="field.type === 'select'">
            <el-select v-model="filterForm[field.name]" :placeholder="field.placeholder">
              <el-option 
                v-for="option in field.options" 
                :key="option.value"
                :label="option.label"
                :value="option.value"
              />
            </el-select>
          </template>
          <template v-else>
            <el-input 
              v-model="filterForm[field.name]" 
              :placeholder="field.placeholder" 
            />
          </template>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="handleFilter">Search</el-button>
          <el-button @click="resetFilter">Reset</el-button>
        </el-form-item>
      </el-form>
    </el-card>

    <!-- Customers Table -->
    <el-card>
      <el-table
        v-loading="loading"
        :data="customers"
        border
        style="width: 100%"
      >
        <el-table-column 
          v-for="column in tableColumns" 
          :key="column.prop"
          v-bind="column"
        >
          <template #default="{ row }" v-if="column.prop === 'status'">
            <el-tag :type="getStatusType(row.status)">
              {{ row.status }}
            </el-tag>
          </template>
          <template #default="{ row }" v-else-if="column.prop === 'actions'">
            <el-button-group>
              <el-button 
                v-for="action in actions"
                :key="action.type"
                :type="action.type"
                size="small"
                @click="action.handler(row)"
                :disabled="action.disabled ? action.disabled(row) : false"
              >
                <el-icon><component :is="action.icon" /></el-icon>
              </el-button>
            </el-button-group>
          </template>
        </el-table-column>
      </el-table>

      <!-- Pagination -->
      <div class="pagination-container">
        <el-pagination
          v-model:current-page="currentPage"
          v-model:page-size="pageSize"
          :total="total"
          :page-sizes="[10, 20, 50, 100]"
          layout="total, sizes, prev, pager, next"
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
        />
      </div>
    </el-card>

    <!-- Add Customer Dialog -->
    <el-dialog
      v-model="dialogVisible"
      title="Add New Customer"
      width="50%"
    >
      <el-form :model="customerForm" label-width="120px">
        <el-form-item label="Customer Name">
          <el-input v-model="customerForm.name" placeholder="Enter customer name" />
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="customerForm.email" placeholder="Enter email" />
        </el-form-item>
        <el-form-item label="Phone">
          <el-input v-model="customerForm.phone" placeholder="Enter phone number" />
        </el-form-item>
        <el-form-item label="Status">
          <el-select v-model="customerForm.status" placeholder="Select status">
            <el-option label="Active" value="active" />
            <el-option label="Inactive" value="inactive" />
          </el-select>
        </el-form-item>
      </el-form>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="handleSubmit">Submit</el-button>
        </div>
      </template>
    </el-dialog>
  </div>
</template> 

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessageBox, ElMessage } from 'element-plus'
import { Plus, View, Edit, Delete } from '@element-plus/icons-vue'

const router = useRouter()
const loading = ref(false)
const currentPage = ref(1)
const pageSize = ref(10)
const total = ref(0)
const dialogVisible = ref(false)

const customerForm = reactive({
  name: '',
  email: '',
  phone: '',
  status: 'active'
})

const filterForm = reactive({
  name: '',
  email: '',
  status: ''
})

const filterFields = [
  {
    name: 'name',
    label: 'Customer Name',
    placeholder: 'Search by name',
    type: 'input'
  },
  {
    name: 'email', 
    label: 'Email',
    placeholder: 'Search by email',
    type: 'input'
  },
  {
    name: 'status',
    label: 'Status',
    placeholder: 'Select status',
    type: 'select',
    options: [
      { label: 'All', value: '' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' }
    ]
  }
]

const tableColumns = [
  { prop: 'id', label: 'ID', width: '80', align: 'center' },
  { prop: 'name', label: 'Customer Name', minWidth: '180' },
  { prop: 'email', label: 'Email', minWidth: '200' },
  { prop: 'phone', label: 'Phone', width: '150' },
  { prop: 'orders', label: 'Total Orders', width: '120', align: 'center' },
  { prop: 'status', label: 'Status', width: '100', align: 'center' },
  { prop: 'actions', label: 'Actions', width: '200', align: 'center', fixed: 'right' }
]

const actions = [
  {
    type: 'primary',
    icon: 'View',
    handler: (row) => handleView(row)
  },
  {
    type: 'warning',
    icon: 'Edit', 
    handler: (row) => handleEdit(row)
  },
  {
    type: 'danger',
    icon: 'Delete',
    handler: (row) => handleDelete(row),
    disabled: (row) => row.orders > 0
  }
]

// Mock customer data - replace with actual API calls
const customers = ref([
  {
    id: 1,
    name: 'John Doe',
    email: 'john@example.com',
    phone: '+1 234-567-8900',
    orders: 5,
    status: 'active'
  }
])

const getStatusType = (status) => {
  const statusMap = {
    active: 'success',
    inactive: 'danger'
  }
  return statusMap[status]
}

const handleSubmit = () => {
  // Add API call to create customer
  ElMessage({
    type: 'success',
    message: 'Customer added successfully'
  })
  dialogVisible.value = false
  // Reset form
  Object.keys(customerForm).forEach(key => {
    customerForm[key] = key === 'status' ? 'active' : ''
  })
  fetchCustomers()
}

const handleView = (row) => {
  router.push(`/customers/view/${row.id}`)
}

const handleEdit = (row) => {
  router.push(`/customers/edit/${row.id}`)
}

const handleDelete = (row) => {
  if (row.orders > 0) {
    ElMessage.warning('Cannot delete customer with existing orders')
    return
  }

  ElMessageBox.confirm(
    'Are you sure you want to delete this customer?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'warning'
    }
  ).then(() => {
    // Add API call to delete customer
    ElMessage({
      type: 'success',
      message: 'Customer deleted successfully'
    })
  }).catch(() => {
    ElMessage({
      type: 'info',
      message: 'Delete canceled'
    })
  })
}

const handleFilter = () => {
  currentPage.value = 1
  fetchCustomers()
}

const resetFilter = () => {
  Object.keys(filterForm).forEach(key => {
    filterForm[key] = ''
  })
  fetchCustomers()
}

const handleSizeChange = (val) => {
  pageSize.value = val
  fetchCustomers()
}

const handleCurrentChange = (val) => {
  currentPage.value = val
  fetchCustomers()
}

const fetchCustomers = async () => {
  loading.value = true
  try {
    // Add API call here
    await new Promise(resolve => setTimeout(resolve, 500))
    total.value = 100 // Mock total
  } catch (error) {
    console.error('Error fetching customers:', error)
    ElMessage.error('Failed to fetch customers')
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchCustomers()
})
</script>

<style lang="scss" scoped>
.app-container {
  padding: 20px;

  .header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .filter-section {
    margin-bottom: 20px;
  }

  .pagination-container {
    margin-top: 20px;
    display: flex;
    justify-content: center;
  }
}

.dialog-footer {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
</style>