<?php
require_once 'category.php';

$category = new Category();
$categories = $category->getCategories();

function getCategoryTree($category, $categoryObj) {
    $subcategories = $categoryObj->getSubcategories($category['category_id']);
    if (!empty($subcategories)) {
        foreach ($subcategories as &$subcategory) {
            $subcategory['subcategories'] = getCategoryTree($subcategory, $categoryObj);
        }
    }
    return $subcategories;
}

$response = [];
foreach ($categories as $cat) {
    $cat['subcategories'] = getCategoryTree($cat, $category);
    $response[] = $cat;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
