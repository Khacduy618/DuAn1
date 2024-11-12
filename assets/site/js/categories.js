document.addEventListener("DOMContentLoaded", function () {
    fetch('controllers/getcategory.php')
        .then(response => response.json())
        .then(data => {
            const menuContainer = document.getElementById('category-menu');

            function createCategoryTree(categories) {
                const ul = document.createElement('ul');
                ul.classList.add("submenu");

                categories.forEach(category => {
                    const li = document.createElement('li');
                    li.classList.add(category.parent_id ? "subcategory-item" : "item-lead");

                    const link = document.createElement('a');
                    link.href = data[0].imternal_link;
                    link.textContent = category.category_name;

                    li.appendChild(link);

                    if (category.subcategories && category.subcategories.length > 0) {
                        li.appendChild(createCategoryTree(category.subcategories));
                    }

                    ul.appendChild(li);
                });

                return ul;
            }

            data.forEach(category => {
                const categoryItem = document.createElement('li');
                categoryItem.classList.add("item-lead");

                const categoryLink = document.createElement('a');
                categoryLink.href = data[0].imternal_link;
                categoryLink.textContent = category.category_name;

                categoryItem.appendChild(categoryLink);

                if (category.subcategories && category.subcategories.length > 0) {
                    categoryItem.appendChild(createCategoryTree(category.subcategories));
                }

                menuContainer.appendChild(categoryItem);
            });
        })
        .catch(error => console.error('Error loading categories:', error));
});