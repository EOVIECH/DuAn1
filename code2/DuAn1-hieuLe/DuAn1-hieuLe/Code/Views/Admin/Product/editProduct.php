<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT Product</title>
</head>
<body>

    <?php require_once 'Components/Admin/navbar.php' ?>
    <div class="content-page">
      <div class="container-fluid add-form-list">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">Edit Product</h4>
                </div>
              </div>

              <div id="successMessage" class="alert alert-success <?php echo ($err) ? '' : 'd-none' ?>" role="alert">
                Sản phẩm đã được cập nhật thành công!
              </div>

              <div class="card-body">
                <form id="editProductForm" class="p-4 border rounded shadow-sm" onsubmit="return validateForm()" action="" method="post" enctype="multipart/form-data">
                  <h3 class="mb-4">Thông Tin Sản Phẩm</h3>

                  <!-- Input để lưu số lượng sản phẩm -->
                  <input type="hidden" id="totalProductsInput" name="totalProducts" value="1">

                  <div id="productsContainer" class="row g-3">
                    <div class="product col-12 border-bottom pb-3 mb-4">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label for="product_name" class="form-label">Tên sản phẩm:</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $listProById -> name ?>" required><br>
                        </div>

                        <div class="col-md-6">
                          <label for="description" class="form-label">Mô tả sản phẩm:</label>
                            <textarea name="description" class="form-control"rows="2" ><?php echo $listProById -> description ?></textarea><br>
                        </div>

                        <div class="col-md-6">
                          <label for="brand_id" class="form-label">Thương hiệu:</label>
                            <select name="brand_id" class="form-select" required>
                                <?php
                                    foreach($listBrand as $brand)
                                    {
                                        ?>
                                            <option value="<?php echo $brand->brand_id ?>" <?php echo ($listProById -> brand_id == $brand -> brand_id) ? 'selected' : '' ?>><?php echo $brand->name ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                          <label for="category_id" class="form-label" >Danh mục:</label>
                            <select name="category_id" class="form-select"  required>
                                <?php
                                    foreach($listCategories as $category)
                                    {
                                        ?>
                                            <option value="<?php echo $category->category_id ?>" <?php echo ($listProductCategoryById -> category_id == $category -> category_id) ? 'selected' : '' ?>><?php echo $category->name ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                          <label for="status_id" class="form-label" >Status:</label>
                            <select name="status_id" class="form-select"  required>
                                <option value="active" <?php echo ($listProById -> status == 'active') ? 'selected' : '' ?>>active</option>
                                <option value="inactive" <?php echo ($listProById -> status == 'inactive') ? 'selected' : '' ?>>inactive</option>
                            </select>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between mt-4">
                    <input name="edit_Product" type="submit" class=" btn btn-primary mr-2" value="Cập Nhật Sản Phẩm" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Page end -->
      </div>
</div>

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