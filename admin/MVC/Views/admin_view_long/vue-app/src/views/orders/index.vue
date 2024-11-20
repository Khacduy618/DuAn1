<template>
  <div class="app-container">
    <!-- Order Management Header -->
    <div class="header-actions">
      <h2>Order Management</h2>
      <el-button-group>
        <el-button type="primary" @click="exportOrders">
          <el-icon><Download /></el-icon>
          Export
        </el-button>
        <el-button type="success" @click="dialogVisible = true">
          <el-icon><Plus /></el-icon>
          New Order
        </el-button>
      </el-button-group>
    </div>

    <!-- Order Filter Section -->
    <el-card class="filter-section">
      <el-form :inline="true" :model="filterForm">
        <el-form-item label="Order ID">
          <el-input v-model="filterForm.orderId" placeholder="Search by ID" />
        </el-form-item>
        <el-form-item label="Customer">
          <el-input v-model="filterForm.customer" placeholder="Search by customer" />
        </el-form-item>
        <el-form-item label="Status">
          <el-select v-model="filterForm.status" placeholder="Select status">
            <el-option label="All" value="" />
            <el-option label="Pending" value="pending" />
            <el-option label="Processing" value="processing" />
            <el-option label="Completed" value="completed" />
            <el-option label="Cancelled" value="cancelled" />
          </el-select>
        </el-form-item>
        <el-form-item label="Date Range">
          <el-date-picker
            v-model="filterForm.dateRange"
            type="daterange"
            range-separator="to"
            start-placeholder="Start date"
            end-placeholder="End date"
          />
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="handleFilter">Search</el-button>
          <el-button @click="resetFilter">Reset</el-button>
        </el-form-item>
      </el-form>
    </el-card>

    <!-- Add Order Dialog -->
    <el-dialog
      v-model="dialogVisible"
      title="Create New Order"
      width="50%"
    >
      <el-form :model="orderForm" label-width="120px">
        <el-form-item label="Customer Name">
          <el-input v-model="orderForm.customer" placeholder="Enter customer name" />
        </el-form-item>
        
        <el-form-item label="Products">
          <el-select
            v-model="orderForm.products"
            multiple
            placeholder="Select products"
          >
            <el-option
              v-for="product in availableProducts"
              :key="product.id"
              :label="product.name"
              :value="product.id"
            />
          </el-select>
        </el-form-item>

        <el-form-item label="Status">
          <el-select v-model="orderForm.status" placeholder="Select status">
            <el-option label="Pending" value="pending" />
            <el-option label="Processing" value="processing" />
          </el-select>
        </el-form-item>

        <el-form-item label="Notes">
          <el-input
            v-model="orderForm.notes"
            type="textarea"
            rows="4"
            placeholder="Enter order notes"
          />
        </el-form-item>
      </el-form>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="handleSaveOrder">Create Order</el-button>
        </span>
      </template>
    </el-dialog>

    <!-- Orders Table -->
    <el-card>
      <el-table
        v-loading="loading"
        :data="orders"
        border
        style="width: 100%"
      >
        <template v-for="column in tableColumns" :key="column.prop">
          <el-table-column v-bind="column">
            <template #default="{ row }" v-if="column.prop === 'total'">
              ${{ row.total.toFixed(2) }}
            </template>
            <template #default="{ row }" v-else-if="column.prop === 'status'">
              <el-tag :type="getStatusType(row.status)">
                {{ row.status }}
              </el-tag>
            </template>
            <template #default="{ row }" v-else-if="column.prop === 'actions'">
              <el-button-group>
                <el-button type="primary" size="small" @click="handleView(row)">
                  <el-icon><View /></el-icon>
                </el-button>
                <el-button 
                  type="success" 
                  size="small" 
                  @click="handleUpdateStatus(row)"
                  :disabled="row.status === 'completed' || row.status === 'cancelled'"
                >
                  <el-icon><Check /></el-icon>
                </el-button>
                <el-button 
                  type="danger" 
                  size="small" 
                  @click="handleCancel(row)"
                  :disabled="row.status === 'completed' || row.status === 'cancelled'"
                >
                  <el-icon><Close /></el-icon>
                </el-button>
              </el-button-group>
            </template>
          </el-table-column>
        </template>
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
  </div>
</template> 

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessageBox, ElMessage } from 'element-plus'
import { Download, Plus, View, Check, Close } from '@element-plus/icons-vue'

const router = useRouter()
const loading = ref(false)
const currentPage = ref(1)
const pageSize = ref(10)
const total = ref(0)
const dialogVisible = ref(false)

const filterForm = reactive({
  orderId: '',
  customer: '',
  status: '',
  dateRange: []
})

const orderForm = reactive({
  customer: '',
  products: [],
  status: 'pending',
  notes: ''
})

// Mock available products - replace with actual data
const availableProducts = ref([
  { id: 1, name: 'Product 1' },
  { id: 2, name: 'Product 2' },
  { id: 3, name: 'Product 3' }
])

// Table columns configuration
const tableColumns = [
  { prop: 'id', label: 'Order ID', width: '120' },
  { prop: 'customer', label: 'Customer', minWidth: '180' },
  { prop: 'date', label: 'Order Date', width: '180' },
  { prop: 'total', label: 'Total', width: '120', align: 'right' },
  { prop: 'status', label: 'Status', width: '120', align: 'center' },
  { prop: 'actions', label: 'Actions', width: '200', align: 'center' }
]

// Mock data - replace with actual API calls
const orders = ref([
  {
    id: 'ORD-001',
    customer: 'John Doe',
    date: '2024-03-15',
    total: 299.99,
    status: 'pending'
  }
])

const getStatusType = (status) => {
  const statusMap = {
    pending: 'warning',
    processing: 'primary',
    completed: 'success',
    cancelled: 'danger'
  }
  return statusMap[status]
}

const handleSaveOrder = () => {
  // Add API call to save order
  ElMessage({
    type: 'success',
    message: 'Order created successfully'
  })
  dialogVisible.value = false
  // Reset form
  Object.keys(orderForm).forEach(key => {
    orderForm[key] = key === 'status' ? 'pending' : (key === 'products' ? [] : '')
  })
  fetchOrders()
}

const handleView = (row) => {
  router.push(`/orders/view/${row.id}`)
}

const handleUpdateStatus = (row) => {
  ElMessageBox.confirm(
    'Are you sure you want to update this order status?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'warning'
    }
  ).then(() => {
    // Add API call to update order status
    ElMessage({
      type: 'success',
      message: 'Order status updated successfully'
    })
  }).catch(() => {
    ElMessage({
      type: 'info',
      message: 'Update canceled'
    })
  })
}

const handleCancel = (row) => {
  ElMessageBox.confirm(
    'Are you sure you want to cancel this order?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'warning'
    }
  ).then(() => {
    // Add API call to cancel order
    ElMessage({
      type: 'success',
      message: 'Order cancelled successfully'
    })
  }).catch(() => {
    ElMessage({
      type: 'info',
      message: 'Cancellation canceled'
    })
  })
}

const exportOrders = () => {
  // Add export functionality
  ElMessage({
    type: 'success',
    message: 'Orders exported successfully'
  })
}

const handleFilter = () => {
  currentPage.value = 1
  fetchOrders()
}

const resetFilter = () => {
  Object.keys(filterForm).forEach(key => {
    filterForm[key] = key === 'dateRange' ? [] : ''
  })
  fetchOrders()
}

const handleSizeChange = (val) => {
  pageSize.value = val
  fetchOrders()
}

const handleCurrentChange = (val) => {
  currentPage.value = val
  fetchOrders()
}

const fetchOrders = async () => {
  loading.value = true
  try {
    // Add API call here
    await new Promise(resolve => setTimeout(resolve, 500))
    total.value = 100 // Mock total
  } catch (error) {
    console.error('Error fetching orders:', error)
    ElMessage.error('Failed to fetch orders')
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchOrders()
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