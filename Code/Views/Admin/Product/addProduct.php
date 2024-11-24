<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="Views/Admin/Css/form.css"> -->
    <title>Add Product Variants</title>
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
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>

                    <div id="successMessage" class="alert alert-success if <?php echo ($err) ? '' : 'd-none' ?>" role="alert">
                      Sản phẩm đã được thêm thành công!
                    </div>

                    <div class="card-body">
                      <form
                        id="addProductForm"
                        class="p-4 border rounded shadow-sm"
                        onsubmit="return validateForm()"
                        action=""
                        method="post"
                        enctype="multipart/form-data"
                        >
                        <h3 class="mb-4">Thông Tin Sản Phẩm</h3>

                        <!-- Input để lưu số lượng sản phẩm -->
                        <input
                          type="hidden"
                          id="totalProductsInput"
                          name="totalProducts"
                          value="1"
                        />

                        <div id="productsContainer" class="row g-3">
                          <div class="product col-12 border-bottom pb-3 mb-4">
                            <div class="row g-3">
                              <div class="col-md-6">
                                <label for="product_name" class="form-label">Tên sản phẩm:</label>
                                <input type="text" name="product_name[]" class="form-control" required />
                              </div>

                              <div class="col-md-6">
                                <label for="description" class="form-label">Mô tả sản phẩm:</label>
                                <textarea name="description[]" class="form-control" rows="2"></textarea>
                              </div>

                              <div class="col-md-6">
                                <label for="brand_id" class="form-label">Thương hiệu:</label>
                                <select name="brand_id[]" class="form-select" required>
                                  <?php
                                    foreach($listBrand as $brand) {
                                  ?>
                                  <option value="<?php echo $brand->brand_id ?>">
                                    <?php echo $brand->name ?>
                                  </option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>

                              <div class="col-md-6">
                                <label for="category_id" class="form-label">Danh mục:</label>
                                <select name="category_id[]" class="form-select" required>
                                  <?php
                                    foreach($listCategories as $category) {
                                  ?>
                                  <option value="<?php echo $category->category_id ?>">
                                    <?php echo $category->name ?>
                                  </option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>

                              <div class="col-12">
                                <button type="button" class="btn btn-danger" onclick="removeProduct(this)">Xóa Sản Phẩm</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                          <button type="button" class="btn btn-secondary" onclick="addProduct()">Thêm Sản Phẩm Khác</button>
                          <input name="add_Product" type="submit" class="btn btn-primary" value="Thêm Tất Cả Sản Phẩm" />
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
    </div>

  </body>
</html>
<script>
  function addProduct() {
    const productTemplate = document.querySelector(".product");
    const newProduct = productTemplate.cloneNode(true);
    newProduct
      .querySelectorAll("input, textarea")
      .forEach((input) => (input.value = ""));
    document.getElementById("productsContainer").appendChild(newProduct);

    updateTotalProducts();
  }

  function removeProduct(button) {
    const productElement = button.closest(".product");
    const productsContainer = document.getElementById("productsContainer");
    productsContainer.removeChild(productElement);

    // Cập nhật số lượng sản phẩm sau khi xóa
    updateTotalProducts();
  }

  function updateTotalProducts() {
    // Đếm tổng số sản phẩm hiện tại
    const totalProducts = document.querySelectorAll(".product").length;

    // Cập nhật giá trị vào input ẩn
    document.getElementById("totalProductsInput").value = totalProducts;
    // alert(document.getElementById('totalProductsInput').value);
  }
  function validateForm() {
    // Kiểm tra tất cả các sản phẩm
    const products = document.querySelectorAll(".product");
    if (products.length === 0) {
      alert("Vui lòng thêm ít nhất một sản phẩm.");
      return false;
    }

    let isValid = true;
    products.forEach((product, index) => {
      const productName = product
        .querySelector('input[name="product_name[]"]')
        .value.trim();
      if (productName.length < 3) {
        alert(`Tên sản phẩm thứ ${index + 1} phải có ít nhất 3 ký tự.`);
        isValid = false;
      }
    });

    return isValid;
  }
</script>
