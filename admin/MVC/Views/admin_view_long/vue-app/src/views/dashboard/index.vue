<template>
  <div class="dashboard-container">
    <!-- Side Navigation -->
    <el-row :gutter="20" class="dashboard-layout">
      <el-col :span="4">
        <el-menu
          class="dashboard-menu"
          :default-active="activeMenu"
          @select="handleMenuSelect"
          :collapse="isCollapsed"
        >
          <div class="menu-toggle" @click="toggleMenu">
            <el-icon><Fold v-if="!isCollapsed"/><Expand v-else/></el-icon>
          </div>

          <el-menu-item index="dashboard">
            <el-icon><DataLine /></el-icon>
            <span>Dashboard</span>
          </el-menu-item>
          
          <el-sub-menu index="products">
            <template #title>
              <el-icon><Goods /></el-icon>
              <span>Products</span>
            </template>
            <el-menu-item index="product-list">
              <el-icon><Document /></el-icon>
              Product List
            </el-menu-item>
            <el-menu-item index="product-add">
              <el-icon><CirclePlus /></el-icon>
              Add Product
            </el-menu-item>
          </el-sub-menu>

          <el-sub-menu index="orders">
            <template #title>
              <el-icon><ShoppingCart /></el-icon>
              <span>Orders</span>
            </template>
            <el-menu-item index="order-list">
              <el-icon><Document /></el-icon>
              Order List
            </el-menu-item>
            <el-menu-item index="order-stats">
              <el-icon><PieChart /></el-icon>
              Order Statistics
            </el-menu-item>
          </el-sub-menu>

          <el-sub-menu index="charts">
            <template #title>
              <el-icon><PieChart /></el-icon>
              <span>Charts</span>
            </template>
            <el-menu-item index="revenue-charts">
              <el-icon><Money /></el-icon>
              Revenue Analytics
            </el-menu-item>
            <el-menu-item index="product-charts">
              <el-icon><Goods /></el-icon>
              Product Analytics
            </el-menu-item>
          </el-sub-menu>

          <el-sub-menu index="customers">
            <template #title>
              <el-icon><User /></el-icon>
              <span>Customers</span>
            </template>
            <el-menu-item index="customer-list">
              <el-icon><UserFilled /></el-icon>
              Customer List
            </el-menu-item>
            <el-menu-item index="customer-add">
              <el-icon><CirclePlus /></el-icon>
              Add Customer
            </el-menu-item>
          </el-sub-menu>
        </el-menu>
      </el-col>

      <el-col :span="19">
        <!-- Main Content Area -->
        <component :is="currentView" v-if="currentView" />
        
        <!-- Default Dashboard Content -->
        <template v-else>
          <!-- Welcome Section -->
          <div class="welcome-section">
            <h1>Welcome back, {{ username }}</h1>
            <p>{{ getCurrentDateTime() }}</p>
          </div>

          <!-- Statistics Cards -->
          <el-row :gutter="20" class="stats-cards">
            <el-col :span="5" v-for="stat in statistics" :key="stat.title">
              <el-card shadow="hover" :class="['stat-card', stat.trend]" @click="showStatDetails(stat)">
                <div class="stat-item">
                  <div class="stat-icon">
                    <el-icon><component :is="stat.icon" /></el-icon>
                  </div>
                  <div class="stat-info">
                    <div class="stat-title">{{ stat.title }}</div>
                    <div class="stat-value">{{ stat.value }}</div>
                    <div class="stat-trend">
                      <el-icon :class="stat.trend">
                        <CaretTop v-if="stat.trend === 'up'" />
                        <CaretBottom v-else />
                      </el-icon>
                      {{ stat.percentage }}%
                    </div>
                  </div>
                </div>
              </el-card>
            </el-col>
          </el-row>

          <!-- Charts Section -->
          <el-row :gutter="20" class="chart-container">
            <el-col :span="11">
              <el-card class="chart-card">
                <template #header>
                  <div class="chart-header">
                    <div class="chart-title">
                      <h3>Revenue Trend</h3>
                      <p class="subtitle">Daily revenue overview</p>
                    </div>
                    <div class="chart-actions">
                      <el-select 
                        v-model="timeRange" 
                        size="small"
                        @change="handleTimeRangeChange"
                      >
                        <el-option label="Last 7 Days" value="7" />
                        <el-option label="Last 30 Days" value="30" />
                        <el-option label="Last 90 Days" value="90" />
                      </el-select>
                      <el-button size="small" @click="refreshChart">
                        <el-icon><Refresh /></el-icon>
                      </el-button>
                    </div>
                  </div>
                </template>
                <v-chart 
                  class="chart" 
                  :option="revenueChartOption" 
                  autoresize 
                  @click="handleChartClick"
                />
              </el-card>
            </el-col>

            <el-col :span="11">
              <el-card class="chart-card">
                <template #header>
                  <div class="chart-header">
                    <div class="chart-title">
                      <h3>Top Products</h3>
                      <p class="subtitle">Best selling products</p>
                    </div>
                    <el-dropdown @command="handleProductFilter">
                      <el-button size="small">
                        Filter <el-icon><ArrowDown /></el-icon>
                      </el-button>
                      <template #dropdown>
                        <el-dropdown-menu>
                          <el-dropdown-item command="sales">By Sales</el-dropdown-item>
                          <el-dropdown-item command="revenue">By Revenue</el-dropdown-item>
                          <el-dropdown-item command="growth">By Growth</el-dropdown-item>
                        </el-dropdown-menu>
                      </template>
                    </el-dropdown>
                  </div>
                </template>
                <v-chart 
                  class="chart" 
                  :option="productsChartOption" 
                  autoresize
                  @click="handleProductClick" 
                />
              </el-card>
            </el-col>
          </el-row>
        </template>
      </el-col>
    </el-row>
  </div>

  <!-- Stat Details Dialog -->
  <el-dialog
      v-model="statDialogVisible"
      :title="selectedStat?.title"
      width="50%"
    >
      <div class="stat-details">
        <v-chart :option="statDetailsChart" autoresize class="detail-chart" />
      </div>
    </el-dialog>
  


</template>

<script setup>
import { ref, computed, onMounted, defineAsyncComponent } from 'vue'
import { useRouter } from 'vue-router'
import VChart from 'vue-echarts'
import { use } from 'echarts/core'
import { CanvasRenderer } from 'echarts/renderers'
import { LineChart, BarChart } from 'echarts/charts'

import {
  GridComponent,
  TooltipComponent,
  LegendComponent,
  DataZoomComponent,
  ToolboxComponent
} from 'echarts/components'
import {
  DataLine,
  Goods,
  ShoppingCart,
  User,
  Money,
  Fold,
  Expand,
  List,
  Plus,
  Document,
  PieChart,
  UserFilled,
  CirclePlus,
  CaretTop,
  CaretBottom,
  Refresh,
  ArrowDown
} from '@element-plus/icons-vue'

// Register ECharts components
use([
  CanvasRenderer,
  LineChart,
  BarChart,
  GridComponent,
  TooltipComponent,
  LegendComponent,
  DataZoomComponent,
  ToolboxComponent
])

const router = useRouter()
const activeMenu = ref('dashboard')
const timeRange = ref('7')
const isCollapsed = ref(false)
const username = ref('Admin')
const currentView = ref(null)
const statDialogVisible = ref(false)
const selectedStat = ref(null)

// Enhanced statistics data with trends
const statistics = ref([
  { title: 'Total Sales', value: '$54,230', icon: 'Money', trend: 'up', percentage: 12.5 },
  { title: 'Total Orders', value: '845', icon: 'ShoppingCart', trend: 'up', percentage: 8.2 },
  { title: 'Total Products', value: '450', icon: 'Goods', trend: 'down', percentage: 3.1 },
  { title: 'Total Customers', value: '1,290', icon: 'User', trend: 'up', percentage: 15.7 }
])

// Enhanced chart options
const revenueChartOption = ref({
  tooltip: {
    trigger: 'axis',
    formatter: '{b}: ${c}'
  },
  toolbox: {
    feature: {
      dataZoom: {},
      saveAsImage: {}
    }
  },
  xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    axisLine: { lineStyle: { color: '#666' } }
  },
  yAxis: {
    type: 'value',
    axisLabel: {
      formatter: '${value}'
    }
  },
  series: [{
    data: [820, 932, 901, 934, 1290, 1330, 1320],
    type: 'line',
    smooth: true,
    areaStyle: {
      opacity: 0.3
    },
    itemStyle: {
      color: '#409EFF'
    }
  }]
})

const productsChartOption = ref({
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    }
  },
  xAxis: {
    type: 'value',
    axisLabel: {
      formatter: '${value}'
    }
  },
  yAxis: {
    type: 'category',
    data: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
    axisLine: { lineStyle: { color: '#666' } }
  },
  series: [{
    type: 'bar',
    data: [320, 302, 301, 334, 390],
    itemStyle: {
      color: function(params) {
        const colors = ['#409EFF', '#67C23A', '#E6A23C', '#F56C6C', '#909399']
        return colors[params.dataIndex]
      }
    }
  }]
})

// Handler functions
const toggleMenu = () => {
  isCollapsed.value = !isCollapsed.value
}

const getCurrentDateTime = () => {
  return new Date().toLocaleString('en-US', { 
    weekday: 'long', 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const handleTimeRangeChange = (value) => {
  // Update chart data based on selected time range
  // This would typically involve an API call
  console.log('Time range changed to:', value)
}

const refreshChart = () => {
  // Refresh chart data
  // This would typically involve an API call
  ElMessage.success('Chart data refreshed')
}

const handleChartClick = (params) => {
  console.log('Chart clicked:', params)
  // Handle chart interaction
}

const handleProductClick = (params) => {
  if (params.data) {
    // Show loading indicator
    ElLoading.service({ 
      text: 'Loading product details...',
      background: 'rgba(255, 255, 255, 0.7)'
    })

    // Add hover effect feedback
    const chart = params.event.target
    chart.style.cursor = 'pointer'
    
    // Animate the clicked bar
    const seriesIndex = params.seriesIndex
    const dataIndex = params.dataIndex
    productsChartOption.value.series[seriesIndex].itemStyle.emphasis = {
      color: '#1890ff',
      shadowBlur: 10,
      shadowColor: 'rgba(0,0,0,0.3)'
    }

    // Navigate after brief delay for visual feedback
    setTimeout(() => {
      ElLoading.service().close()
      router.push(`/products/${params.dataIndex}`)
    }, 500)
  }
}

const handleProductFilter = (command) => {
  // Update products chart based on filter
  console.log('Filter products by:', command)
}

const showStatDetails = (stat) => {
  selectedStat.value = stat
  statDialogVisible.value = true
}

const handleMenuSelect = async (index) => {
  activeMenu.value = index
  
  switch (index) {
    case 'product-list':
      currentView.value = defineAsyncComponent(() => 
        import('../products/index.vue')
      )
      break
    case 'product-add':
      router.push('/products/add')
      break
    case 'order-list':
      currentView.value = defineAsyncComponent(() =>
        import('../orders/index.vue')
      )
      break
    case 'customer-list':
      currentView.value = defineAsyncComponent(() =>
        import('../customers/index.vue')
      )
      break
    case 'customer-add':
      router.push('/customers/add')
      break
    case 'dashboard':
      currentView.value = null
      break
    case 'revenue-charts':
    case 'product-charts':
      currentView.value = defineAsyncComponent(() =>
        import('../charts/index.vue')
      )
      break
    default:
      currentView.value = null
      router.push('/dashboard')
  }
}

onMounted(() => {
  // Initialize any necessary data or state
})
</script>

<style lang="scss" scoped>
.dashboard-container {
  padding: 20px;
  background-color: #f5f7fa;
  min-height: 100vh;

  .dashboard-layout {
    position: relative;
  }

  .dashboard-menu {
    height: calc(100vh - 40px);
    border-right: solid 1px #e6e6e6;
    background: white;
    border-radius: 8px;
    padding: 10px 0;
    transition: all 0.3s;

    .menu-toggle {
      padding: 10px;
      text-align: center;
      cursor: pointer;
      margin-bottom: 20px;
      
      &:hover {
        background-color: #f5f7fa;
      }
    }
  }

  .welcome-section {
    margin-bottom: 30px;
    
    h1 {
      margin: 0;
      font-size: 24px;
      color: #303133;
    }
    
    p {
      margin: 5px 0 0;
      color: #909399;
    }
  }

  .stats-cards {
    margin-bottom: 30px;

    .stat-card {
      transition: transform 0.3s;
      cursor: pointer;

      &:hover {
        transform: translateY(-5px);
      }

      &.up .stat-trend {
        color: #67C23A;
      }

      &.down .stat-trend {
        color: #F56C6C;
      }
    }

    .stat-item {
      display: flex;
      align-items: center;
      gap: 15px;

      .stat-icon {
        font-size: 24px;
        color: #409EFF;
        padding: 15px;
        background: rgba(64, 158, 255, 0.1);
        border-radius: 8px;
      }

      .stat-info {
        flex-grow: 1;

        .stat-title {
          font-size: 14px;
          color: #909399;
        }

        .stat-value {
          font-size: 24px;
          font-weight: bold;
          margin: 5px 0;
        }

        .stat-trend {
          font-size: 12px;
          display: flex;
          align-items: center;
          gap: 4px;
        }
      }
    }
  }

  .chart-container {
    .chart-card {
      background: white;
      border-radius: 8px;
      
      .chart {
        height: 350px;
      }

      .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;

        .chart-title {
          h3 {
            margin: 0;
            font-size: 16px;
            color: #303133;
          }

          .subtitle {
            margin: 5px 0 0;
            font-size: 12px;
            color: #909399;
          }
        }

        .chart-actions {
          display: flex;
          gap: 10px;
        }
      }
    }
  }
}

.stat-details {
  .detail-chart {
    height: 400px;
  }
}
</style>
