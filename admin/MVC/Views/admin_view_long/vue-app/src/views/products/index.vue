<template>
  <div class="app-container">
    <!-- Product Management Header -->
    <div class="header-actions">
      <h2>Product Management</h2>
      <el-button type="primary" @click="openDialog()">
        <el-icon><Plus /></el-icon>
        Add Product
      </el-button>
    </div>

    <!-- Product Filter Section -->
    <el-card class="filter-section">
      <el-form :inline="true" :model="filterForm">
        <el-form-item label="Product Name">
          <el-input v-model="filterForm.name" placeholder="Search by name" />
        </el-form-item>
        <el-form-item label="Category">
          <el-select v-model="filterForm.category" placeholder="Select category">
            <el-option label="All" value="" />
            <el-option 
              v-for="category in categories" 
              :key="category.value"
              :label="category.label"
              :value="category.value"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Status">
          <el-select v-model="filterForm.status" placeholder="Select status">
            <el-option label="All" value="" />
            <el-option 
              v-for="status in statuses"
              :key="status.value"
              :label="status.label"
              :value="status.value"
            />
          </el-select>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="handleFilter">Search</el-button>
          <el-button @click="resetFilter">Reset</el-button>
        </el-form-item>
      </el-form>
    </el-card>

    <!-- Add/Edit Product Dialog -->
    <el-dialog
      v-model="dialogVisible"
      :title="isEdit ? 'Edit Product' : 'Add New Product'"
      width="50%"
      @close="resetProductForm"
    >
      <el-form 
        ref="productFormRef"
        :model="productForm" 
        :rules="rules"
        label-width="120px"
      >
        <el-form-item label="Product Name" prop="name">
          <el-input v-model="productForm.name" placeholder="Enter product name" />
        </el-form-item>
        
        <el-form-item label="Category" prop="category">
          <el-select v-model="productForm.category" placeholder="Select category">
            <el-option
              v-for="category in categories"
              :key="category.value"
              :label="category.label"
              :value="category.value"
            />
          </el-select>
        </el-form-item>

        <el-form-item label="Price" prop="price">
          <el-input-number 
            v-model="productForm.price"
            :precision="2"
            :step="0.01"
            :min="0"
          />
        </el-form-item>

        <el-form-item label="Stock" prop="stock">
          <el-input-number
            v-model="productForm.stock"
            :min="0"
            :precision="0"
          />
        </el-form-item>

        <el-form-item label="Description" prop="description">
          <el-input
            v-model="productForm.description"
            type="textarea"
            rows="4"
            placeholder="Enter product description"
          />
        </el-form-item>

        <el-form-item label="Product Image" prop="image">
          <el-button type="primary" @click="imageDialogVisible = true">
            Choose Image
          </el-button>
          <div class="image-preview" v-if="productForm.imageUrl">
            <img :src="productForm.imageUrl" class="preview-image">
          </div>
        </el-form-item>

        <el-form-item label="Status" prop="status">
          <el-radio-group v-model="productForm.status">
            <el-radio 
              v-for="status in statuses"
              :key="status.value"
              :label="status.value"
            >
              {{ status.label }}
            </el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="submitForm(productFormRef)">Save</el-button>
        </span>
      </template>
    </el-dialog>

    <!-- Image Upload Dialog -->
    <el-dialog
      v-model="imageDialogVisible"
      title="Upload Product Image"
      width="30%"
    >
      <el-upload
        class="upload-demo"
        action="http://localhost:8080/serverphp/move_upload_files.php"
        :auto-upload="true"
        :on-success="handleUploadSuccess"
        :on-error="handleUploadError"
        :show-file-list="false"
        :before-upload="beforeImageUpload"
      >
        <template #trigger>
          <el-button type="primary">Select Image</el-button>
        </template>
        <div class="image-preview" v-if="productForm.imageUrl">
          <img :src="productForm.imageUrl" class="preview-image">
        </div>
      </el-upload>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="imageDialogVisible = false">Close</el-button>
        </span>
      </template>
    </el-dialog>

    <!-- Products Table -->
    <el-card>
      <el-table
        v-loading="loading"
        :data="filteredProducts"
        border
        style="width: 100%"
      >
        <el-table-column prop="id" label="ID" width="80" align="center" />
        <el-table-column label="Product" min-width="200">
          <template #default="{ row }">
            <div class="product-info">
              <el-image
                :src="getImageUrl(row.image)"
                :preview-src-list="[getImageUrl(row.image)]"
                fit="cover"
                class="product-image"
              />
              <span>{{ row.name }}</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="category" label="Category" width="120">
          <template #default="{ row }">
            {{ getCategoryLabel(row.category) }}
          </template>
        </el-table-column>
        <el-table-column prop="price" label="Price" width="120" align="right">
          <template #default="{ row }">
            ${{ row.price.toFixed(2) }}
          </template>
        </el-table-column>
        <el-table-column prop="stock" label="Stock" width="100" align="center" />
        <el-table-column prop="description" label="Description" min-width="200" show-overflow-tooltip />
        <el-table-column label="Status" width="120" align="center">
          <template #default="{ row }">
            <el-tag :type="getStatusType(row.status)">
              {{ getStatusLabel(row.status) }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Actions" width="150" align="center">
          <template #default="{ row }">
            <el-button-group>
              <el-button type="primary" size="small" @click="handleEdit(row)">
                <el-icon><Edit /></el-icon>
              </el-button>
              <el-button 
                type="danger" 
                size="small" 
                @click="handleDelete(row.id)"
                :disabled="row.stock > 0"
              >
                <el-icon><Delete /></el-icon>
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
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessageBox, ElMessage } from 'element-plus'
import { Plus, Edit, Delete } from '@element-plus/icons-vue'
import axios from 'axios'

const router = useRouter()
const loading = ref(false)
const currentPage = ref(1)
const pageSize = ref(10)
const total = ref(0)
const dialogVisible = ref(false)
const imageDialogVisible = ref(false)
const isEdit = ref(false)
const productFormRef = ref(null)

const categories = [
  { label: 'Electronics', value: 'electronics' },
  { label: 'Clothing', value: 'clothing' },
  { label: 'Books', value: 'books' }
]

const statuses = [
  { label: 'In Stock', value: 'in_stock' },
  { label: 'Out of Stock', value: 'out_of_stock' }
]

const rules = {
  name: [
    { required: true, message: 'Please enter product name', trigger: 'blur' },
    { min: 3, message: 'Length should be at least 3 characters', trigger: 'blur' }
  ],
  category: [
    { required: true, message: 'Please select category', trigger: 'change' }
  ],
  price: [
    { required: true, message: 'Please enter price', trigger: 'blur' }
  ],
  stock: [
    { required: true, message: 'Please enter stock quantity', trigger: 'blur' }
  ],
  description: [
    { required: true, message: 'Please enter description', trigger: 'blur' }
  ],
  status: [
    { required: true, message: 'Please select status', trigger: 'change' }
  ]
}

const productForm = reactive({
  id: null,
  name: '',
  category: '',
  price: 0,
  stock: 0,
  description: '',
  status: 'in_stock',
  image: null,
  imageUrl: ''
})

const filterForm = reactive({
  name: '',
  category: '',
  status: ''
})

// Mock data - replace with actual API calls
const products = ref([
  {
    id: 1,
    name: 'Product 1',
    category: 'electronics',
    price: 299.99,
    stock: 50,
    status: 'in_stock',
    image: 'product1.jpg',
    description: 'High quality electronic product with advanced features'
  },
  {
    id: 2,
    name: 'Product 2', 
    category: 'clothing',
    price: 49.99,
    stock: 100,
    status: 'in_stock',
    image: 'product2.jpg',
    description: 'Comfortable and stylish clothing item'
  },
  {
    id: 3,
    name: 'Product 3',
    category: 'books',
    price: 19.99,
    stock: 0,
    status: 'out_of_stock',
    image: 'product3.jpg',
    description: 'Bestselling book with great reviews'
  }
])

const filteredProducts = computed(() => {
  return products.value.filter(product => {
    const nameMatch = !filterForm.name || product.name.toLowerCase().includes(filterForm.name.toLowerCase())
    const categoryMatch = !filterForm.category || product.category === filterForm.category
    const statusMatch = !filterForm.status || product.status === filterForm.status
    return nameMatch && categoryMatch && statusMatch
  })
})

const getImageUrl = (imageName) => {
  try {
    return new URL(`../../assets/uploads/${imageName}`, import.meta.url).href
  } catch (error) {
    console.error('Error loading image:', error)
    return new URL(`../../assets/uploads/placeholder-image.jpg`, import.meta.url).href
  }
}

const getCategoryLabel = (value) => {
  const category = categories.find(c => c.value === value)
  return category ? category.label : value
}

const getStatusLabel = (value) => {
  const status = statuses.find(s => s.value === value)
  return status ? status.label : value
}

const getStatusType = (status) => {
  return status === 'in_stock' ? 'success' : 'danger'
}

const beforeImageUpload = (file) => {
  const isImage = file.type.startsWith('image/')
  const isLt2M = file.size / 1024 / 1024 < 2

  if (!isImage) {
    ElMessage.error('Upload file must be an image!')
    return false
  }
  if (!isLt2M) {
    ElMessage.error('Image size can not exceed 2MB!')
    return false
  }
  return true
}

const handleUploadSuccess = (response) => {
  if (response.success) {
    productForm.image = response.filename
    productForm.imageUrl = response.url
    ElMessage.success('Image uploaded successfully')
    // imageDialogVisible.value = false
    dialogVisible.value = false
  } else {
    ElMessage.error('Failed to upload image')
  }
}

const handleUploadError = () => {
  ElMessage.error('Failed to upload image')
}

const openDialog = () => {
  isEdit.value = false
  resetProductForm()
  dialogVisible.value = true
}

const resetProductForm = () => {
  if (productFormRef.value) {
    productFormRef.value.resetFields()
  }
  Object.keys(productForm).forEach(key => {
    productForm[key] = key === 'status' ? 'in_stock' : (key === 'price' || key === 'stock' ? 0 : '')
  })
}

const submitForm = async (formEl) => {
  if (!formEl) return
  
  await formEl.validate((valid) => {
    if (valid) {
      handleSaveProduct()
    }
  })
}

const handleSaveProduct = () => {
  // Add API call to save product
  if (isEdit.value) {
    const index = products.value.findIndex(p => p.id === productForm.id)
    if (index > -1) {
      products.value[index] = { ...productForm }
    }
  } else {
    const newId = Math.max(...products.value.map(p => p.id)) + 1
    products.value.push({ ...productForm, id: newId })
  }

  ElMessage({
    type: 'success',
    message: `Product ${isEdit.value ? 'updated' : 'saved'} successfully`
  })
  dialogVisible.value = false
  resetProductForm()
}

const handleEdit = (row) => {
  isEdit.value = true
  Object.keys(productForm).forEach(key => {
    productForm[key] = row[key]
  })
  dialogVisible.value = true
}

const handleDelete = (id) => {
  const product = products.value.find(p => p.id === id)
  if (product.stock > 0) {
    ElMessage.warning('Cannot delete product with stock')
    return
  }

  ElMessageBox.confirm(
    'Are you sure you want to delete this product?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'warning'
    }
  ).then(() => {
    const index = products.value.findIndex(product => product.id === id)
    if (index > -1) {
      products.value.splice(index, 1)
      ElMessage({
        type: 'success',
        message: 'Product deleted successfully'
      })
    }
  }).catch(() => {
    ElMessage({
      type: 'info',
      message: 'Delete canceled'
    })
  })
}

const handleFilter = () => {
  currentPage.value = 1
  fetchProducts()
}

const resetFilter = () => {
  Object.keys(filterForm).forEach(key => {
    filterForm[key] = ''
  })
  fetchProducts()
}

const handleSizeChange = (val) => {
  pageSize.value = val
  fetchProducts()
}

const handleCurrentChange = (val) => {
  currentPage.value = val
  fetchProducts()
}

const fetchProducts = async () => {
  loading.value = true
  try {
    // Add API call here
    await new Promise(resolve => setTimeout(resolve, 500))
    total.value = filteredProducts.value.length
  } catch (error) {
    console.error('Error fetching products:', error)
    ElMessage.error('Failed to fetch products')
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchProducts()
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

  .product-info {
    display: flex;
    align-items: center;
    gap: 10px;

    .product-image {
      width: 50px;
      height: 50px;
      border-radius: 4px;
      object-fit: cover;
    }
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

.image-preview {
  margin-top: 10px;
  
  .preview-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
  }
}
</style>