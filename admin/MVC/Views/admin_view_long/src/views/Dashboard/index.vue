<template>
  <div class="container-fluid">
    <!-- Header Section -->
    <div class="align-items-center mb-3">
        <h2>Items Management</h2>
    </div>
    <!-- Search and Filter Section -->
    <div class="row mb-3  justify-content-around">
      <div class="col-md-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input 
            type="text" 
            class="form-control" 
            v-model="searchQuery"
            placeholder="Search items..."
          >
        </div>
      </div>
      <div class="col-md-2">
        <select class="form-select" v-model="categoryFilter">
          <option value="">All Categories</option>
          <option v-for="category in uniqueCategories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select" v-model="statusFilter">
          <option value="">All Status</option>
          <option value="true">Available</option>
          <option value="false">Unavailable</option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select" v-model="sortBy">
          <option value="id">Sort by id</option>
          <option value="name">Sort by Name</option>
          <option value="price">Sort by Price</option>
          <option value="category">Sort by Category</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-3 align-items-center">
        <div class="btn-group">
          <button 
            class="btn" 
            :class="{'btn-primary': viewMode === 'list', 'btn-light': viewMode !== 'list'}"
            @click="viewMode = 'list'"
          >
            <i class="bi bi-list"></i>
          </button>
          <button 
            class="btn" 
            :class="{'btn-primary': viewMode === 'grid', 'btn-light': viewMode !== 'grid'}"
            @click="viewMode = 'grid'"
          >
            <i class="bi bi-grid"></i>
          </button>
        </div>
        <button class="btn btn-danger" @click="openAddModal">
          <i class="bi bi-plus-circle me-2"></i>Add new item
        </button>
      </div>
    </div>
    
    <!-- Loading State -->
    <div v-if="loading" class="text-center py-5">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="alert alert-danger" role="alert">
      <i class="bi bi-exclamation-triangle me-2"></i>
      {{ error }}
      <button class="btn btn-sm btn-outline-danger ms-3" @click="retryLoading">
        Retry
      </button>
    </div>

    <!-- Empty State -->
    <div v-else-if="filtereditems.length === 0" class="text-center py-5">
      <i class="bi bi-inbox display-1 text-muted"></i>
      <p class="mt-3 text-muted">No items found</p>
      <button class="btn btn-primary mt-2" @click="openAddModal">
        Add your first item
      </button>
    </div>

    <!-- List View -->
    <div v-else-if="viewMode === 'list'" class="table-responsive">
      <table class="table align-middle">
        <thead class="bg-light">
          <tr>
            <th @click="setSortBy('id')" class="cursor-pointer">
              ID # <i class="bi" :class="getSortIcon('id')"></i>
            </th>
            <th>Images</th>
            <th @click="setSortBy('name')" class="cursor-pointer">
              Name <i class="bi" :class="getSortIcon('name')"></i>
            </th>
            <th>Description</th>
            <th @click="setSortBy('price')" class="cursor-pointer">
              Price <i class="bi" :class="getSortIcon('price')"></i>
            </th>
            <th @click="setSortBy('category')" class="cursor-pointer">
              Category <i class="bi" :class="getSortIcon('category')"></i>
            </th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in paginateditems" :key="item.id">
            <td>{{ item.id }}</td>
            <td>
              <img 
                :src="item.image" 
                :alt="item.name" 
                class="item-img"
                @error="handleImageError"
              />
            </td>
            <td>{{ item.name }}</td>
            <td class="text-truncate" style="max-width: 300px">
              {{ item.description }}
            </td>
            <td>${{ formatPrice(item.price) }}</td>
            <td>
              <span class="category-badge" :class="getCategoryClass(item.category)">
                <i :class="getCategoryIcon(item.category)"></i>
                {{ item.category }}
              </span>
            </td>
            <td>
              <div class="status-switch form-switch">
                <input 
                  class="status-switch-input" 
                  :id="'status' + item.id"
                  type="checkbox" 
                  :checked="item.status"
                  @change="toggleStatus(item)"
                >
                <label class="status-switch-label" :for="'status' + item.id">
                  {{ item.status ? 'Available' : 'Unavailable' }}
                </label>
              </div>
            </td>
            <td class="position-relative">
              <button class="btn btn-link text-secondary" 
                      @click="toggleActionMenu(item.id)"
                      ref="actionButton">
                <i class="bi bi-gear"></i>
              </button>
              
              <!-- Action Menu Popup -->
              <div v-if="activeMenu === item.id" 
                   class="action-menu shadow" 
                   @mouseleave="closeActionMenu">
                <button class="action-item" @click="viewDetails(item)">
                  <i class="bi bi-eye-fill text-primary"></i>
                  View Details
                </button>
                <button class="action-item" @click="openEditModal(item)">
                  <i class="bi bi-pencil-fill text-success"></i>
                  Edit
                </button>
                <button class="action-item" @click="confirmDelete(item)">
                  <i class="bi bi-trash-fill text-danger"></i>
                  Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Grid View -->
    <div v-else class="row g-4">
      <div v-for="item in paginateditems" :key="item.id" class="col-md-4 col-lg-3 p-2">
        <div class="card h-100">
          <img 
            :src="item.image" 
            class="card-img-top" 
            :alt="item.name"
            style="height: 200px; object-fit: cover;"
            @error="handleImageError"
          >
          <div class="card-body">
            <h5 class="card-title">{{ item.name }}</h5>
            <p class="card-text text-truncate">{{ item.description }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="h5 mb-0">${{ formatPrice(item.price) }}</span>
              <span class="category-badge" :class="getCategoryClass(item.category)">
                {{ item.category }}
              </span>
            </div>
          </div>
          <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
              <div class="form-check form-switch">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  :checked="item.status"
                  @change="toggleStatus(item)"
                >
              </div>
              <div class="btn-group">
                <button class="btn btn-light btn-sm" @click="viewDetails(item)">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-light btn-sm" @click="openEditModal(item)">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-light btn-sm" @click="confirmDelete(item)">
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
      <span class="text-secondary">
        Showing {{ startIndex + 1 }} to {{ endIndex }} of {{ filtereditems.length }} items
      </span>
      <div class="d-flex gap-2 align-items-center">
        <nav aria-label="Page navigation">
          <ul class="pagination mb-0">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
              <button class="page-link" @click="currentPage--" :disabled="currentPage === 1">
                <i class="bi bi-chevron-left"></i>
              </button>
            </li>
            <li 
              v-for="page in totalPages" 
              :key="page" 
              class="page-item"
              :class="{ active: currentPage === page }"
            >
              <button class="page-link" @click="currentPage = page">{{ page }}</button>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
              <button class="page-link" @click="currentPage++" :disabled="currentPage === totalPages">
                <i class="bi bi-chevron-right"></i>
              </button>
            </li>
          </ul>
        </nav>
        <select class="form-select" v-model="itemsPerPage">
          <option :value="12">12 / page</option>
          <option :value="24">24 / page</option>
          <option :value="50">50 / page</option>
        </select>
      </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" ref="itemModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditing ? 'Edit item' : 'Add New item' }}</h5>
            <button type="button" class="btn-close" @click="closeitemModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submititem" class="needs-validation" novalidate>
              <!-- Image Preview -->
              <div class="text-center mb-3">
                <img 
                  :src="formData.image || 'https://via.placeholder.com/150'" 
                  class="rounded preview-img"
                  :alt="formData.name || 'item preview'"
                  @error="handleImageError"
                >
              </div>

              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Image URL</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    v-model="formData.image"
                    :class="{ 'is-invalid': formErrors.image }"
                    required
                  >
                  <div class="invalid-feedback">{{ formErrors.image }}</div>
                </div>

                <div class="col-md-12 d-flex justify-content-between">
                  <div class="col-50">
                    <label class="form-label">Name</label>
                    <input 
                      type="text" 
                      class="form-control" 
                      v-model="formData.name"
                      :class="{ 'is-invalid': formErrors.name }"
                      required
                    >
                    <div class="invalid-feedback">{{ formErrors.name }}</div>
                  </div>

                  <div class="col-50">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input 
                        type="number" 
                        class="form-control" 
                        v-model="formData.price"
                        :class="{ 'is-invalid': formErrors.price }"
                        step="0.01"
                        min="0"
                        required
                      >
                      <div class="invalid-feedback">{{ formErrors.price }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="col-50">
                      <label class="form-label">Category</label>
                      <select 
                        class="form-select" 
                        v-model="formData.category"
                        :class="{ 'is-invalid': formErrors.category }"
                        required
                      >
                        <option value="">Select category</option>
                        <option v-for="category in categories" :key="category" :value="category">
                          {{ category }}
                        </option>
                      </select>
                      <div class="invalid-feedback">{{ formErrors.category }}</div>
                    </div>

                    <div class="col-50">
                      <label class="form-label">Status</label>
                      <div class="form-check form-switch">
                        <input 
                          class="form-check-input" 
                          type="checkbox" 
                          v-model="formData.status"
                        >
                        <label class="form-check-label">
                          {{ formData.status ? 'Available' : 'Unavailable' }}
                        </label>
                      </div>
                    </div>
                </div>
                <div class="col-12">
                  <label class="form-label">Description</label>
                  <textarea 
                    class="form-control" 
                    v-model="formData.description"
                    :class="{ 'is-invalid': formErrors.description }"
                    rows="3"
                    required
                  ></textarea>
                  <div class="invalid-feedback">{{ formErrors.description }}</div>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">
                  {{ isEditing ? 'Update item' : 'Add item' }}
                </button>
                <button type="button" class="btn btn-light" @click="closeitemModal">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" ref="viewModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Item Details</h5>
            <button type="button" class="btn-close" @click="closeViewModal"></button>
          </div>
          <div class="modal-body" v-if="selecteditem">
            <div class="row">
              <div class="col-md-3 me-2">
                <img 
                  :src="selecteditem.image" 
                  :alt="selecteditem.name"
                  class="img-fluid rounded"
                  @error="handleImageError"
                />
              </div>
              <div class="col-md-7">
                <h4>{{ selecteditem.name }}</h4>
                <div class="mb-3">
                  <span class="category-badge" :class="getCategoryClass(selecteditem.category)">
                    <i :class="getCategoryIcon(selecteditem.category)"></i>
                    {{ selecteditem.category }}
                  </span>
                  <span 
                    class="status-badge ms-2" 
                    :class="selecteditem.status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'"
                  >
                    {{ selecteditem.status ? 'Available' : 'Unavailable' }}
                  </span>
                </div>
                <p class="text-muted">{{ selecteditem.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">${{ formatPrice(selecteditem.price) }}</h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" ref="deleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Confirm Delete</h5>
            <button type="button" class="btn-close" @click="closeDeleteModal"></button>
          </div>
          <div class="modal-body" v-if="selecteditem">
            <p>Are you sure you want to delete "{{ selecteditem.name }}"?</p>
            <p class="text-muted small">This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" @click="closeDeleteModal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="deleteitem">
              <i class="bi bi-trash me-1"></i> Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { Modal } from 'bootstrap'




// State
const activeMenu = ref(null)
const viewMode = ref('list')
const loading = ref(true)
const error = ref(null)
const items = ref([])
const selecteditem = ref(null)
const searchQuery = ref('')
const categoryFilter = ref('')
const statusFilter = ref('')
const sortBy = ref('id')
const sortDirection = ref('asc')
const currentPage = ref(1)
const itemsPerPage = ref(12)

// Toggle action menu
const toggleActionMenu = (itemId) => {
  activeMenu.value = activeMenu.value === itemId ? null : itemId
}

const closeActionMenu = () => {
  activeMenu.value = null
}

const formData = ref({
  image: '',
  name: '',
  description: '',
  price: 0,
  category: '',
  status: true
})
const formErrors = ref({})
const isEditing = ref(false)

// Modal refs
const itemModal = ref(null)
const viewModal = ref(null)
const deleteModal = ref(null)

// Computed Properties
const categories = computed(() => [
  'Pastas',
  'Cold Drinks',
  'Deserts',
  'Starters',
  'Hot Drinks',
  'Salads'
])

const uniqueCategories = computed(() => {
  return [...new Set(items.value.map(p => p.category))]
})

const filtereditems = computed(() => {
  let filtered = [...items.value]

  // Search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(p => 
      p.name.toLowerCase().includes(query)
    )
  }

  // Category filter
  if (categoryFilter.value) {
    filtered = filtered.filter(p => p.category === categoryFilter.value)
  }

  // Status filter
  if (statusFilter.value !== '') {
    const status = statusFilter.value === 'true'
    filtered = filtered.filter(p => p.status === status)
  }

  // Sorting
  filtered.sort((a, b) => {
    let comparison = 0
    if (sortBy.value === 'price') {
      comparison = a.price - b.price
    }else if(sortBy.value === 'id'){
      comparison = parseInt(a.id) - parseInt(b.id)
    }else {
      comparison = a[sortBy.value].localeCompare(b[sortBy.value])
    }
    return sortDirection.value === 'asc' ? comparison : -comparison
  })

  return filtered
})

const paginateditems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filtereditems.value.slice(start, end)
})

const totalPages = computed(() => {
  return Math.ceil(filtereditems.value.length / itemsPerPage.value)
})

const startIndex = computed(() => {
  return (currentPage.value - 1) * itemsPerPage.value
})

const endIndex = computed(() => {
  const end = startIndex.value + itemsPerPage.value
  return Math.min(end, filtereditems.value.length)
})


import img1 from '../../assets/image/item1.jpg'
import img2 from '../../assets/image/item2.jpg'
import img3 from '../../assets/image/item3.jpg'
import img4 from '../../assets/image/item4.jpg'
// Methods
const loaditems = async () => {
  try {
    loading.value = true
    error.value = null
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    // In real application, this would be an API call
    items.value = [
      {
    id: 1,
    image: img1,
    name: 'Spaghetti Carbonara',
    description: 'Classic Italian pasta with a creamy sauce made from eggs, Pecorino Romano cheese, and guanciale.',
    price: 14.00,
    category: 'Pastas',
    status: true
  },

  {
    id: 2,
    image: img2,
    name: 'Cannelloni',
    description: 'Large pasta tubes filled with meat or cheese, covered in sauce.',
    price: 15.50,
    category: 'Pastas',
    status: false

  },

  {
    id: 3,
    image: img3,
    name: 'Coke',
    description: 'Classic Coca-Cola served chilled.',
    price: 2.00,
    category: 'Cold Drinks',
    status: true
  },

  {
    id: 4,
    image: img4,
    name: 'Apple Pie',
    description: 'Classic apple pie with a flaky crust.',
    price: 6.00,
    category: 'Deserts',
    status: true
  },

  {
    id: 5,
    image: 'https://via.placeholder.com/50',
    name: 'Lasagna',
    description: 'Layers of pasta with meat, cheese, and tomato sauce.',
    price: 12.00,
    category: 'Pastas',
    status: true
  },

  {
    id: 6,
    image: 'https://via.placeholder.com/50',
    name: 'Caesar Salad',
    description: 'Crisp romaine lettuce with Caesar dressing, croutons, and parmesan cheese.',
    price: 8.00,
    category: 'Salads',
    status: true
  },

  {
    id: 7,
    image: 'https://via.placeholder.com/50',
    name: 'Margarita Pizza',
    description: 'Classic pizza topped with fresh mozzarella, tomatoes, and basil.',
    price: 10.00,
    category: 'Starters',
    status: true
  },

  {
    id: 8,
    image: 'https://via.placeholder.com/50',
    name: 'Tiramisu',
    description: 'Italian coffee-flavored dessert made with mascarpone cheese.',
    price: 7.00,
    category: 'Deserts',
    status: true
  },

  {
    id: 9,
    image: 'https://via.placeholder.com/50',
    name: 'Espresso',
    description: 'Strong and bold Italian coffee served in a small cup.',
    price: 3.00,
    category: 'Hot Drinks',
    status: true
  },

  {
    id: 10,
    image: 'https://via.placeholder.com/50',
    name: 'Lemonade',
    description: 'Refreshing lemonade made with fresh lemons and sugar.',
    price: 2.50,
    category: 'Cold Drinks',
    status: true
  }
      // Add more sample items...
    ]
  } catch (err) {
    error.value = 'Failed to load items. Please try again.'
    console.error('Error loading items:', err)
  } finally {
    loading.value = false
  }
}

const handleImageError = (event) => {
  event.target.src = 'https://via.placeholder.com/150'
}

const formatPrice = (price) => {
  return Number(price).toFixed(2)
}

const setSortBy = (field) => {
  if (sortBy.value === field) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortBy.value = field
    sortDirection.value = 'asc'
  }
}

const getSortIcon = (field) => {
  if (sortBy.value !== field) return 'bi-arrow-down-up'
  return sortDirection.value === 'asc' ? 'bi-arrow-up' : 'bi-arrow-down'
}

const validateForm = () => {
  const errors = {}
  
  if (!formData.value.image) errors.image = 'Image URL is required'
  if (!formData.value.name) errors.name = 'Name is required'
  if (!formData.value.description) errors.description = 'Description is required'
  if (!formData.value.price || formData.value.price <= 0) {
    errors.price = 'Price must be greater than 0'
  }
  if (!formData.value.category) errors.category = 'Category is required'

  formErrors.value = errors
  return Object.keys(errors).length === 0
}

const resetForm = () => {
  formData.value = {
    image: '',
    name: '',
    description: '',
    price: 0,
    category: '',
    status: true
  }
  formErrors.value = {}
  isEditing.value = false
}

// Modal handlers
const openAddModal = () => {
  resetForm()
  const modal = new Modal(itemModal.value)
  modal.show()
}

const openEditModal = (item) => {
  isEditing.value = true
  formData.value = { ...item }
  const modal = new Modal(itemModal.value)
  modal.show()
}

const closeitemModal = () => {
  const modal = Modal.getInstance(itemModal.value)
  if (modal) {
    modal.hide()
    resetForm()
  }
}

const submititem = () => {
  if (!validateForm()) return

  if (isEditing.value) {
    const index = items.value.findIndex(p => p.id === formData.value.id)
    if (index !== -1) {
      items.value[index] = { ...formData.value }
    }
  } else {
    const newId = items.value.length + 1
    items.value.push({
      ...formData.value,
      id: newId
    })
  }

  closeitemModal()
}

const viewDetails = (item) => {
  selecteditem.value = item
  const modal = new Modal(viewModal.value)
  modal.show()
}

const closeViewModal = () => {
  const modal = Modal.getInstance(viewModal.value)
  if (modal) {
    modal.hide()
    selecteditem.value = null
  }
}

const confirmDelete = (item) => {
  selecteditem.value = item
  const modal = new Modal(deleteModal.value)
  modal.show()
}

const closeDeleteModal = () => {
  const modal = Modal.getInstance(deleteModal.value)
  if (modal) {
    modal.hide()
    selecteditem.value = null
  }
}

const deleteitem = () => {
  if (selecteditem.value) {
    items.value = items.value.filter(p => p.id !== selecteditem.value.id)
    closeDeleteModal()
  }
}

const toggleStatus = (item) => {
  const index = items.value.findIndex(p => p.id === item.id)
  if (index !== -1) {
    items.value[index] = {
      ...item,
      status: !item.status
    }
  }
}

// Styling helpers
const getCategoryClass = (category) => {
  const classes = {
    'Pastas': 'bg-warning-subtle text-warning',
    'Cold Drinks': 'bg-info-subtle text-info',
    'Deserts': 'bg-danger-subtle text-danger',
    'Starters': 'bg-primary-subtle text-primary',
    'Hot Drinks': 'bg-secondary-subtle text-secondary',
    'Salads': 'bg-success-subtle text-success'
  }
  return classes[category] || 'bg-secondary-subtle text-secondary'
}

const getCategoryIcon = (category) => {
  const icons = {
    'Pastas': 'bi bi-egg-fried',
    'Cold Drinks': 'bi bi-cup-straw',
    'Deserts': 'bi bi-cake2',
    'Starters': 'bi bi-lightning',
    'Hot Drinks': 'bi bi-cup-hot',
    'Salads': 'bi bi-flower2'
  }
  return icons[category] || 'bi bi-tag'
}

// Watchers
watch([searchQuery, categoryFilter, statusFilter], () => {
  currentPage.value = 1
})

watch(itemsPerPage, () => {
  currentPage.value = 1
})

// Lifecycle hooks
onMounted(() => {
  loaditems()
})
</script>

<style scoped>

.col-50{
  width: 378px;
}
.table-responsive{
  border-radius:  10px;
  margin-bottom: 20px;
  padding: 1rem;
  box-shadow: 0 5px 8px rgba(73, 72, 72, 0.3);
  background-color: #fff;
}
.cursor-pointer {
  cursor: pointer;
}

.preview-img {
  max-width: 200px;
  height: 200px;
  object-fit: cover;
}

.item-img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 8px;
}

.category-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.875rem;
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.875rem;
}

.action-menu {
  position: absolute;
  right: 100%;
  top: 50%;
  transform: translateY(-50%);
  background: white;
  border-radius: 8px;
  min-width: 150px;
  z-index: 1000;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.action-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  width: 100%;
  padding: 0.5rem 1rem;
  border: none;
  background: none;
  text-align: left;
  transition: background-color 0.2s;
}

.action-item:hover {
  background-color: #f8f9fa;
}

.pagination {
  gap: 0.25rem;
}

.page-link {
  border-radius: 4px !important;
  border: none;
  padding: 0.5rem 0.75rem;
  color: #666;
}

.page-link:hover {
  background-color: #f8f9fa;
  color: #000;
}

.page-item.active .page-link {
  background-color: #ff5733;
  color: white;
}

.btn-danger {
  background-color: #ff5733;
  border-color: #ff5733;
}

/* Card view styles */
.card {
  transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.modal-lg {
  max-width: 800px;
}
.status-switch {
  position: relative;
  display: inline-block;
  width: 120px;
  height: 34px;
}

.status-switch-input {
  opacity: 0;
  width: 0;
  height: 0;
}

.status-switch-label {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ccc;
  border-radius: 34px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.status-switch-input:checked + .status-switch-label {
  background-color: #50a9f1;
  color: white;
}

.status-switch-input:not(:checked) + .status-switch-label {
  background-color: #ebe7e7;
  border:#bdbaba solid 1px;
  color: rgb(182, 180, 180);
}


.status-switch-input:checked + .status-switch-label::before {
  transform: translateX(85px);
}
</style>