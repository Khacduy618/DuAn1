<template>
  <div class="app-container">
    <!-- Statistics Cards -->
    <el-row :gutter="20" class="stats-cards">
      <el-col :span="5" v-for="stat in statistics" :key="stat.title">
        <el-card shadow="hover">
          <div class="stat-item">
            <div class="stat-icon">
              <el-icon><component :is="stat.icon" /></el-icon>
            </div>
            <div class="stat-info">
              <div class="stat-title">{{ stat.title }}</div>
              <div class="stat-value">{{ stat.value }}</div>
            </div>
          </div>
        </el-card>
      </el-col>
    </el-row>

    <!-- Charts Section -->
    <el-row :gutter="20" class="chart-container">
      <!-- Revenue Chart -->
      <el-col :span="11">
        <el-card>
          <template #header>
            <div class="chart-header">
              <span>Monthly Revenue</span>
              <el-select v-model="revenueTimeRange" size="small">
                <el-option label="Last 6 Months" value="6" />
                <el-option label="Last 12 Months" value="12" />
              </el-select>
            </div>
          </template>
          <v-chart class="chart" :option="revenueChartOption" autoresize />
        </el-card>
      </el-col>

      <!-- Products Chart -->
      <el-col :span="11">
        <el-card>
          <template #header>
            <div class="chart-header">
              <span>Top Products</span>
              <el-select v-model="productTimeRange" size="small">
                <el-option label="This Week" value="week" />
                <el-option label="This Month" value="month" />
              </el-select>
            </div>
          </template>
          <v-chart class="chart" :option="productChartOption" autoresize />
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import VChart from 'vue-echarts'
import { use } from 'echarts/core'
import { CanvasRenderer } from 'echarts/renderers'
import { LineChart, BarChart, PieChart } from 'echarts/charts'
import {
  GridComponent,
  TooltipComponent,
  LegendComponent,
  TitleComponent,
  ToolboxComponent,
  DataZoomComponent
} from 'echarts/components'
import {
  ShoppingCart,
  User,
  Goods,
  Money,
  Refresh
} from '@element-plus/icons-vue'

// Register ECharts components
use([
  CanvasRenderer,
  LineChart,
  BarChart,
  PieChart,
  GridComponent,
  TooltipComponent,
  LegendComponent,
  TitleComponent,
  ToolboxComponent,
  DataZoomComponent
])

const revenueTimeRange = ref('6')
const productTimeRange = ref('week')

// Enhanced statistics with trends
const statistics = ref([
  { title: 'Total Sales', value: '$54,230', icon: 'Money', trend: 'up', percentage: 12.5 },
  { title: 'Active Users', value: '3,230', icon: 'User', trend: 'up', percentage: 8.2 },
  { title: 'Total Products', value: '450', icon: 'Goods', trend: 'down', percentage: 3.1 },
  { title: 'Daily Revenue', value: '$2,340', icon: 'ShoppingCart', trend: 'up', percentage: 15.7 }
])

// Enhanced chart options with more interactivity
const revenueChartOption = computed(() => ({
  tooltip: {
    trigger: 'axis',
    formatter: '${c}'
  },
  toolbox: {
    feature: {
      dataZoom: {},
      saveAsImage: {},
      restore: {}
    }
  },
  xAxis: {
    type: 'category',
    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    axisLine: { lineStyle: { color: '#666' } }
  },
  yAxis: {
    type: 'value',
    axisLabel: {
      formatter: '${value}'
    }
  },
  series: [{
    data: [12000, 15000, 14000, 18000, 16000, 20000],
    type: 'line',
    smooth: true,
    areaStyle: {
      opacity: 0.3
    },
    itemStyle: {
      color: '#409EFF'
    }
  }]
}))

const productChartOption = computed(() => ({
  tooltip: {
    trigger: 'item',
    formatter: '{b}: ${c} ({d}%)'
  },
  legend: {
    orient: 'vertical',
    right: 10,
    top: 'center'
  },
  toolbox: {
    feature: {
      saveAsImage: {},
      restore: {}
    }
  },
  series: [{
    name: 'Top Products',
    type: 'pie',
    radius: ['50%', '70%'],
    avoidLabelOverlap: false,
    itemStyle: {
      borderRadius: 10,
      borderColor: '#fff',
      borderWidth: 2
    },
    label: {
      show: true,
      formatter: '{b}: ${c}'
    },
    emphasis: {
      label: {
        show: true,
        fontSize: '14',
        fontWeight: 'bold'
      }
    },
    data: [
      { value: 12350, name: 'iPhone 13' },
      { value: 8420, name: 'MacBook Pro' },
      { value: 6890, name: 'AirPods Pro' },
      { value: 5230, name: 'iPad Air' },
      { value: 4120, name: 'Apple Watch' }
    ]
  }]
}))

// Watch for time range changes
watch([revenueTimeRange, productTimeRange], ([newRevenue, newProduct]) => {
  if (newRevenue) fetchChartData(newRevenue)
  if (newProduct) fetchProductData(newProduct)
})

const fetchChartData = async (revenueRange) => {
  // Add API call to fetch new data
  console.log('Fetching new data for:', revenueRange)
}

const fetchProductData = async (timeRange) => {
  try {
    // Mock API call - replace with actual API endpoint
    const response = await new Promise(resolve => 
      setTimeout(() => resolve({
        data: [
          { value: 12350, name: 'iPhone 13' },
          { value: 8420, name: 'MacBook Pro' },
          { value: 6890, name: 'AirPods Pro' },
          { value: 5230, name: 'iPad Air' },
          { value: 4120, name: 'Apple Watch' }
        ]
      }), 500)
    )
    
    // Update chart data
    productChartOption.value.series[0].data = response.data
  } catch (error) {
    console.error('Error fetching product data:', error)
    ElMessage.error('Failed to load product data')
  }
}
</script>

<style lang="scss" scoped>
.app-container {
  padding: 20px;

  .stats-cards {
    margin-bottom: 20px;

    .stat-item {
      display: flex;
      align-items: center;
      gap: 15px;

      .stat-icon {
        font-size: 24px;
        color: #409EFF;
      }

      .stat-info {
        .stat-title {
          font-size: 14px;
          color: #909399;
        }

        .stat-value {
          font-size: 20px;
          font-weight: bold;
          margin-top: 5px;
        }
      }
    }
  }

  .chart-container {
    .chart {
      height: 350px;
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  }
}
</style> 