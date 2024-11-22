
<div class="container-fluid">
    <!-- Header Section -->
    <div class="align-items-center mb-3">
        <h2>Products Management</h2>
    </div>
    <!-- Search and Filter Section -->
    <div class="row mb-3  justify-content-around">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" v-model="searchQuery" placeholder="Search items...">
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
                <button class="btn" :class="{'btn-primary': viewMode === 'list', 'btn-light': viewMode !== 'list'}"
                    @click="viewMode = 'list'">
                    <i class="bi bi-list"></i>
                </button>
                <button class="btn" :class="{'btn-primary': viewMode === 'grid', 'btn-light': viewMode !== 'grid'}"
                    @click="viewMode = 'grid'">
                    <i class="bi bi-grid"></i>
                </button>
            </div>
            <!-- <button class="btn btn-danger" @click="openAddModal">
                <i class="bi bi-plus-circle me-2"></i>Add new item
            </button> -->
            <a class="btn btn-danger" href="?mod=product&act=add_product&param=true">
                <i class="bi bi-plus-circle me-2"></i>Add new item
            </a>
        </div>
    </div>

    <!-- Loading State -->
    <!-- <div v-if="loading" class="text-center py-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->

    <!-- Error State -->
    <!-- <div v-else-if="error" class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ error }}
        <button class="btn btn-sm btn-outline-danger ms-3" @click="retryLoading">
            Retry
        </button>
    </div> -->

    <!-- Empty State -->
    <!-- <div v-else-if="filtereditems.length === 0" class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <p class="mt-3 text-muted">No items found</p>
        <button class="btn btn-primary mt-2" @click="openAddModal">
            Add your first item
        </button>
    </div> -->

    <?php
        if(!empty($_GET['msg'])){
            $msg = unserialize(urldecode($_GET['msg']));
            foreach($msg as $key => $value){
                echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
            }
        }
        if(!empty($_SESSION['msg'])){
            echo '<span style="color:blue;font-weight:bold">'.$_SESSION['msg'].'</span>';
            // unset($_SESSION['msg']);
        }
    ?>
    <!-- List View -->
    <div v-else-if="viewMode === 'list'" class="table-responsive">
        <table class="table align-middle">
            <thead class="bg-light">
                <tr>
                    <th @click="setSortBy('id')" class="cursor-pointer">
                        ID # <i class="bi" :class="getSortIcon('id')"></i>
                    </th>
                    <th>Image </th>
                    <th @click="setSortBy('name')" class="cursor-pointer">
                        Name <i class="bi" :class="getSortIcon('name')"></i>
                    </th>
                    <th colspan="2">Description </th>
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
                <?php
                // var_dump($product);
                // var_dump($descbox);
                $i = 0;
                foreach($product as $key => $pro){
                    extract($pro);
                    $i++;
                    if($product_status >=0 ){
                ?>
                <tr v-for="item in paginateditems" :key="item.id">
                    <td><?= $i ?></td>
                    <!-- <td>{{ item.id }}</td> -->
                    <td>
                        <!-- <img :src="item.image" :alt="item.name" class="item-img" @error="handleImageError" /> -->
                        <img src="<?= BASE_URL ?>/uploaded/<?=$product_img ?>" height="100" width="100" :alt="item.name" class="item-img" @error="handleImageError">
                    </td>
                    <td><?=$product_name?></td> 
                    <!-- <td>{{ item.name }}</td> -->
                    <td class="text-truncate" colspan="2" style="max-width: 300px">
                        <!-- {{ item.description }} -->
                          
                        <?=$screen_cam?> <br>
                        <?=$os?> <br>
                        <?=$gpu?> <br>
                        <?=$cpu?> <br>
                        <?=$pin?> <br>
                        <?=$colors?> <br>
                        <?=$sizes?> <br>
                        <?=$ram?> <br>
                        <?=$rom?> <br>
                        <?=$bluetooth?> <br>
                    </td>
                    <!-- <td>${{ formatPrice(item.price) }}</td> -->
                    <td><?php echo number_format($product_price * (100 - $product_discount) / 100,0,',','.').'đ'?>(<?=$product_discount?>%)</td> 
                    <td>
                        <span class="category-badge" :class="getCategoryClass(item.category)">
                            <i :class="getCategoryIcon(item.category)"></i>
                            <!-- {{ item.category }} -->
                            <?=$category_name?>
                        </span>
                    </td>
                    <td>
                        <div class="status-switch form-switch">
                            <input class="status-switch-input" :id="'status' + item.id" type="checkbox"
                                :checked="item.status" @change="toggleStatus(item)">
                            <label class="status-switch-label" :for="'status' + item.id">
                                <!-- {{ item.status ? 'Available' : 'Unavailable' }} -->
                                <?=$product_status == 1 ? 'Available' : 'Unavailable'?>
                            </label>
                        </div>
                    </td>
                    <td class="position-relative">
                        <button class="btn btn-link text-secondary" @click="toggleActionMenu(item.id)"
                            ref="actionButton">
                            <i class="bi bi-gear"></i>
                        </button>

                        <!-- Action Menu Popup -->
                        <div v-if="activeMenu === item.id" class="action-menu shadow" @mouseleave="closeActionMenu">
                            <!-- <button class="action-item" @click="viewDetails(item)">
                                <i class="bi bi-eye-fill text-primary"></i>
                                view Details
                            </button> -->
                            <!-- <button class="action-item" @click="openEditModal(item)">
                                <i class="bi bi-pencil-fill text-success"></i>
                                Edit
                            </button> -->
                            <div class="row">
                                <div class="col-6">
                                    <a class="btn btn-danger" href="?mod=product&act=delete_product&param=<?=$product_id ?>">delete</a> 
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-dark" href="?mod=product&act=edit_product&param=<?=$product_id ?>">edit</a> </td>
                                </div>
                            </div>
                            <!-- <button class="action-item" @click="confirmDelete(item)">
                                <i class="bi bi-trash-fill text-danger"></i>
                                Delete
                            </button> -->
                        </div>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Grid View -->
    <div v-else class="row g-4">
        <div v-for="item in paginateditems" :key="item.id" class="col-md-4 col-lg-3 p-2">
            <div class="card h-100">
                <img :src="item.image" class="card-img-top" :alt="item.name" style="height: 200px; object-fit: cover;"
                    @error="handleImageError">
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
                            <input class="form-check-input" type="checkbox" :checked="item.status"
                                @change="toggleStatus(item)">
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
                    <li v-for="page in totalPages" :key="page" class="page-item"
                        :class="{ active: currentPage === page }">
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
                            <img :src="formData.image || 'https://via.placeholder.com/150'" class="rounded preview-img"
                                :alt="formData.name || 'item preview'" @error="handleImageError">
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Image URL</label>
                                <input type="text" class="form-control" v-model="formData.image"
                                    :class="{ 'is-invalid': formErrors.image }" required>
                                <div class="invalid-feedback">{{ formErrors.image }}</div>
                            </div>

                            <div class="col-md-12 d-flex justify-content-between">
                                <div class="col-50">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" v-model="formData.name"
                                        :class="{ 'is-invalid': formErrors.name }" required>
                                    <div class="invalid-feedback">{{ formErrors.name }}</div>
                                </div>

                                <div class="col-50">
                                    <label class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" v-model="formData.price"
                                            :class="{ 'is-invalid': formErrors.price }" step="0.01" min="0" required>
                                        <div class="invalid-feedback">{{ formErrors.price }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between">
                                <div class="col-50">
                                    <label class="form-label">Category</label>
                                    <select class="form-select" v-model="formData.category"
                                        :class="{ 'is-invalid': formErrors.category }" required>
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
                                        <input class="form-check-input" type="checkbox" v-model="formData.status">
                                        <label class="form-check-label">
                                            {{ formData.status ? 'Available' : 'Unavailable' }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" v-model="formData.description"
                                    :class="{ 'is-invalid': formErrors.description }" rows="3" required></textarea>
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
                            <img :src="selecteditem.image" :alt="selecteditem.name" class="img-fluid rounded"
                                @error="handleImageError" />
                        </div>
                        <div class="col-md-7">
                            <h4>{{ selecteditem.name }}</h4>
                            <div class="mb-3">
                                <span class="category-badge" :class="getCategoryClass(selecteditem.category)">
                                    <i :class="getCategoryIcon(selecteditem.category)"></i>
                                    {{ selecteditem.category }}
                                </span>
                                <span class="status-badge ms-2"
                                    :class="selecteditem.status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'">
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