<?php
require_once("Models/category.php");

class CategoryController {
    var $categoryModel;
    private $productCounts = [];  // Cache để lưu tổng số sản phẩm của mỗi category

    public function __construct() {
        $this->categoryModel = new Category();
        
    }

    // Tính tổng số sản phẩm cho một category và tất cả subcategories của nó
    private function calculateTotalProducts($data, $category_id) {
        // Nếu đã tính toán trước đó, trả về kết quả từ cache
        if (isset($this->productCounts[$category_id])) {
            return $this->productCounts[$category_id];
        }

        $total = 0;
        foreach ($data as $item) {
            // Đếm sản phẩm của chính category này
            if ($item['category_id'] == $category_id) {
                $total = $item['product_count'];
                break;
            }
        }

        // Đếm sản phẩm từ tất cả subcategories
        foreach ($data as $item) {
            if ($item['parent_id'] == $category_id) {
                $total += $this->calculateTotalProducts($data, $item['category_id']);
            }
        }

        // Lưu kết quả vào cache
        $this->productCounts[$category_id] = $total;
        return $total;
    }

    // Tìm tất cả subcategories của một category
    private function findSubCategories($data, $parent_id) {
        $subs = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id) {
                $subs[] = $item;
                $subs = array_merge($subs, $this->findSubCategories($data, $item['category_id']));
            }
        }
        return $subs;
    }

    function menu($data, $parent_id = NULL) {
        $output = '';
        
    

        foreach ($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                // Reset cache for new calculations
                $this->productCounts = [];
                
                // Calculate total products including all subcategories
                $totalProducts = $this->calculateTotalProducts($data, $value['category_id']);
                
                // Check if category has children
                $hasChildren = false;
                foreach ($data as $child) {
                    if ($child['parent_id'] == $value['category_id'] || $value['parent_id'] === 0) {
                        $hasChildren = true;
                        break;
                    }
                }

                if ($hasChildren) {
                    // Parent category with subcategories
                    $output .= '<div class="filter-item">';
                    $output .= '<div class="custom-control  parent-category">';
                              '" name="category[]" value="' . $value['category_id'] . '">';
                    $output .= '<label class="custom-control-label" for="cat-' . $value['category_id'] . '">' . 
                              ucfirst($value['category_name']) . '</label>';
                    $output .= '<span class="Categories-count">' . $totalProducts . '</span>';
                    $output .= '<p class="toggle-icon"></p>';
                    $output .= '</div>';
                    
                    // Sub categories container
                    $output .= '<div class="sub-categories">';
                    $output .= $this->menu($data, $value['category_id']);
                    $output .= '</div>';
                    $output .= '</div>';
                } else {
                    // Single category without subcategories
                    $output .= '<div class="filter-item sub-cat">';
                    $output .= '<div class="custom-control">';
                    $output .= '<a href="index.php?act=shop&product_cat=' . $value['category_id'] . '" class="category-link">';
                    $output .= '<label class="custom-control-label" for="cat-' . $value['category_id'] . '">' . 
                            ucfirst($value['category_name']) . '</label>';
                    $output .= '<span class="subCategories-count">' . $value['product_count'] . '</span>';
                    $output .= '</a>';
                    $output .= '</div>';
                    $output .= '</div>';

                }
            }
        }
        return $output;
    }
    public function list_cat() {
        $data = $this->categoryModel->list();
        return $this->menu($data);
    }

    //menu cate home

    private function findSubCategories_home($data, $parent_id) {
        $subs = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id) {
                $subs[] = $item;
                $subs = array_merge($subs, $this->findSubCategories($data, $item['category_id']));
            }
        }
        return $subs;
    }

    function menu_home($data, $parent_id = NULL) {
        $output = '';

        foreach ($data as $value) {
            
            if ($value['parent_id'] == $parent_id) {
                // Check if category has children
                $hasChildren = false;
                foreach ($data as $child) {
                    if ($child['parent_id'] == $value['category_id']) {
                        $hasChildren = true;
                        break;
                    }
                }

                // Start list item
                $output .= '<li class="' . ($hasChildren ? 'has-submenu' : '') . '">';
               
                // Add category link
                $output .= '<a href="index.php?act=shop&product_cat=' . $value['category_id'] . '">';
                $output .= ucfirst($value['category_name']);
                if ($hasChildren) {
                    $output .= '<i class="icon-angle-right"></i>';
                }
                $output .= '</a>';

                // If has children, add submenu
                if ($hasChildren) {
                    $output .= '<ul>';
                    $output .= $this->menu_home($data, $value['category_id']);
                    $output .= '</ul>';
                }

                $output .= '</li>';
            }
        }
        
        return $output;
    }
    public function list_cat_home() {
        $data = $this->categoryModel->list();
        return $this->menu_home($data);
    }
}