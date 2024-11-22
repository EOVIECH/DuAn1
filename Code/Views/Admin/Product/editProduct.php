<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>EDIT Product</title>
</head>
<body>
 <!-- Form Thêm Sản Phẩm -->
 <form id="addProductForm" onsubmit="return validateForm()" action="" method="post" enctype="multipart/form-data">
    <h3>Thông Tin Sản Phẩm</h3>
    <!-- Input để lưu số lượng sản phẩm -->
    <input type="hidden" id="totalProductsInput" name="totalProducts" value="1">
    <div id="productsContainer">
        <div class="product">
            <label for="product_name">Tên sản phẩm:</label>
            <input type="text" name="product_name" value="<?php echo $listProById -> name ?>" required><br>

            <label for="description">Mô tả sản phẩm:</label>
            <textarea name="description"><?php echo $listProById -> description ?></textarea><br>

            <label for="brand_id">Thương hiệu:</label>
            <select name="brand_id" required>
                <?php
                    foreach($listBrand as $brand)
                    {
                        ?>
                            <option value="<?php echo $brand->brand_id ?>" <?php echo ($listProById -> brand_id == $brand -> brand_id) ? 'selected' : '' ?>><?php echo $brand->name ?></option>
                        <?php
                    }
                ?>
            </select><br>

            <label for="category_id">Danh mục:</label>
            <select name="category_id" required>
                <?php
                    foreach($listCategories as $category)
                    {
                        ?>
                            <option value="<?php echo $category->category_id ?>" <?php echo ($listProductCategoryById -> category_id == $category -> category_id) ? 'selected' : '' ?>><?php echo $category->name ?></option>
                        <?php
                    }
                ?>
            </select><br>
        </div>
    </div>

    <input name="edit_Product" type="submit" value="Sửa Sản Phẩm">
</form>
</body>
</html>
<script>
function validateForm() {
    // Kiểm tra tất cả các sản phẩm
    const products = document.querySelectorAll('.product');
    if (products.length === 0) {
        alert('Vui lòng thêm ít nhất một sản phẩm.');
        return false;
    }

    let isValid = true;
    products.forEach((product, index) => {
        const productName = product.querySelector('input[name="product_name[]"]').value.trim();
        if (productName.length < 3) {
            alert(`Tên sản phẩm thứ ${index + 1} phải có ít nhất 3 ký tự.`);
            isValid = false;
        }
    });

    return isValid;
}

</script>