<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>Add Product Variants</title>
</head>
<body>
 <!-- Form Thêm Sản Phẩm -->
 <form id="addProductForm" onsubmit="validateForm()" action="" method="post" enctype="multipart/form-data">
    <h3>Thông Tin Sản Phẩm</h3>
    <div id="productsContainer">
        <div class="product">
            <label for="product_name">Tên sản phẩm:</label>
            <input id="product_name" type="text" name="product_name[]" required><br>

            <label for="description">Mô tả sản phẩm:</label>
            <textarea id="description" name="description[]"></textarea><br>

            <label for="brand_id">Thương hiệu:</label>
            <select name="brand_id[]" required>
                <?php
                    foreach($listBrand as $brand)
                    {
                        ?>
                            <option value="<?php echo $brand -> brand_id ?>"><?php echo $brand -> name ?></option>
                        <?php
                    }
                ?>
            </select><br>

            <label for="category_id">Danh mục:</label>
            <select name="category_id[]" required>
                <?php
                    foreach($listCategories as $category)
                    {
                        ?>
                            <option value="<?php echo $category -> category_id ?>"><?php echo $category -> name ?></option>
                        <?php
                    }
                ?>
            </select><br>
        </div>
    </div>

    <button type="button" onclick="addProduct()">Thêm Sản Phẩm Khác</button>
    <input name="add_Product" type="submit" value="Thêm Tất Cả Sản Phẩm"></input>
</form>

</body>
</html>
<script>
    function addProduct() {
        // Select the first product form as a template
        const productTemplate = document.querySelector('.product');
        const newProduct = productTemplate.cloneNode(true); // Clone the first product form
        // Clear input values in the cloned form
        newProduct.querySelectorAll('input, textarea').forEach(input => input.value = '');
        document.getElementById('productsContainer').appendChild(newProduct);
    }
    function validateForm() {
        // Kiểm tra tên thương hiệu
        const brandName = document.getElementById("categories_name").value;
        if (brandName.length < 3) {
          alert("Tên thương hiệu phải có ít nhất 3 ký tự.");
          return false;
        }

        // Kiểm tra mô tả thương hiệu
        const description = document.getElementById("description").value;
        if (description.length > 200) {
          alert("Mô tả không được vượt quá 200 ký tự.");
          return false;
        }

        // Nếu tất cả đều hợp lệ
        return true;
      }

</script>
