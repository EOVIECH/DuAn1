<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="Views/Admin/Css/form.css" /> -->
    <title>Add Product Variants</title>
    <style>
      .variant {
          margin-bottom: 20px; /* Khoảng cách giữa các biến thể */
          padding: 20px;
          /* border: 1px solid #ddd; */
          border-radius: 5px;
      }
    </style>
  </head>
  <body>

  <?php require_once 'Components/Admin/navbar.php';?>


  <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Product Variants</h4>
                        </div>
                        <?php
                          if (isset($_SESSION['error_message'])) 
                          {
                            echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
                          }
                        ?>
                    </div>
                    <div class="card-body">
                        <form id="addVariantForm" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <input type="hidden" id="totalVariantsInput" name="totalVariants" value="1">
                                <div class="col-md-12">
                                    <div class="form-group">  
                                        <label>Product Type *</label>
                                        <select id="product_id" name="product_id" class=" form-control" data-style="py-0" required>
                                          <?php foreach($allDataProduct as $product): ?>
                                          <option value="<?php echo $product->product_id; ?>">
                                            <?php echo $product->name; ?>
                                          </option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div> 
                                </div>
                                <div id="variantsContainer">
                                  <div class="row variant" data-index="0">
                                        <div class="col-md-6">                      
                                          <div class="form-group">
                                              <label for="variant_price">Price *</label>
                                              <input type="number" name="variant_price[0]" class="form-control" placeholder="Enter Price" data-errors="Please Enter Price." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                        </div>    
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_priceCoupon">Price Coupon *</label>
                                              <input type="number" name="variant_priceCoupon[0]" class="form-control" placeholder="Enter Price Coupon" data-errors="Please Enter Price Coupon." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_start_date">Start Date *</label>
                                              <input type="date" name="variant_start_date[0]" class="form-control" placeholder="Choose Start Date" data-errors="Please Enter Date." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_end_date">End Date *</label>
                                              <input type="date" name="variant_end_date[0]" class="form-control" placeholder="Choose End Date" data-errors="Please Enter Date." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_sku">SKU *</label>
                                              <input type="text" name="variant_sku[0]" class="form-control" placeholder="Enter SKU" data-errors="Please Enter SKU." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6"> 
                                          <div class="form-group">
                                              <label for="variant_color">Color *</label>
                                              <select name="variant_color[0]"  class=" form-control" data-style="py-0">
                                                <?php foreach($allDataColor as $color): ?>
                                                  <option value="<?php echo $color->color_id; ?>">
                                                    <?php echo $color->name; ?>
                                                  </option>
                                                <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div> 
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="variant_size">Size *</label>
                                              <?php foreach($allDataSize as $size): ?>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" name="variant_size[0][]" value="<?php echo $size->size_id; ?>"  type="checkbox" id="inlineCheckbox1" value="option1">
                                                  <label class="form-check-label" for="inlineCheckbox1"><?php echo $size->name; ?></label>
                                                </div>
                                              <!-- <input type="checkbox"  class="form-control" placeholder="Choose Size" data-errors="Please Choose Size." required> -->
                                              <?php endforeach; ?>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-12">                                    
                                          <div class="form-group">
                                              <label for="variant_quantity">Quantity *</label>
                                              <input type="number" name="variant_quantity[0]" class="form-control" placeholder="Enter Quantity" required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="variant_main_image">Main Image</label>
                                              <input type="file" name="variant_main_image[0]" accept="image/*" class="form-control image-file">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="variant_album_images">Album Image</label>
                                              <input type="file" name="variant_album_images[0][]" accept="image/*" multiple class="form-control image-file">
                                          </div>
                                      </div>
                                      
                                      <button id="delVariant" class="btn btn-danger" type="button" onclick="removeVariant(this)">
                                        Xóa Biến Thể
                                      </button>
                                  </div>
                                </div>
                                
                            </div>  
                            <div class="d-flex justify-content-end">
                              <button type="button" class="btn btn-primary mr-2" onclick="addVariant()">Thêm Biến Thể Khác</button>
                              <input class="btn btn-primary" style="cursor: pointer" name="addProductVariants" value="Thêm Tất Cả Biến Thể" type="submit">
                            </div>    
                            <!-- <button type="button" class="btn btn-primary mr-2" onclick="addVariant()">Thêm Biến Thể Khác</button
                              ><br />
                              <input class="btn btn-primary mr-2"
                                style="cursor: pointer"
                                name="addProductVariants"
                                value="Thêm Tất Cả Biến Thể"
                                type="submit"
                              /> -->
                            </form>                      
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    </div>

  </body>
</html>
<script>
let totalVariants = 1;

// Hàm thêm biến thể mới
function addVariant() {
  const variantsContainer = document.getElementById("variantsContainer");
  const newVariant = document.querySelector(".variant").cloneNode(true);

  // Đặt lại các giá trị trong bản sao
  resetVariantFields(newVariant, totalVariants);

  // Cập nhật chỉ số cho biến thể mới
  newVariant.dataset.index = totalVariants;
  updateVariantFieldNames(newVariant, totalVariants);

  // Thêm biến thể mới vào container
  variantsContainer.appendChild(newVariant);

  // Cập nhật tổng số biến thể
  totalVariants++;
  updateTotalVariants();
}

// Hàm đặt lại các trường trong biến thể
function resetVariantFields(variantElement, index) {
  variantElement.querySelectorAll("input, select").forEach((input) => {
    if (input.type === "checkbox" || input.type === "radio") {
      input.checked = false;
    } else if (input.type === "file") {
      input.value = "";
    } else {
      input.value = "";
    }
  });
}

// Hàm cập nhật tên các trường theo chỉ số
function updateVariantFieldNames(variantElement, index) {
  variantElement.querySelectorAll("input, select").forEach((input) => {
    const name = input.getAttribute("name");
    if (name) {
      const updatedName = name.replace(/\[\d+\]/, `[${index}]`);
      input.setAttribute("name", updatedName);
    }
  });
}

// Hàm xóa biến thể
function removeVariant(button) {
  const variantElement = button.closest(".variant");
  variantElement.remove();
  updateVariantIndexes();
}

// Cập nhật lại chỉ số cho các biến thể còn lại sau khi xóa
function updateVariantIndexes() {
  const variants = document.querySelectorAll(".variant");
  totalVariants = variants.length;
  variants.forEach((variant, index) => {
    variant.dataset.index = index;
    updateVariantFieldNames(variant, index);
  });
  updateTotalVariants();
}

// Cập nhật tổng số biến thể
function updateTotalVariants() {
  document.getElementById("totalVariantsInput").value = totalVariants;
}

  function validateForm(event) {
    const variants = document.querySelectorAll(".variant");
    let isValid = true;

    variants.forEach((variant, index) => {
      const price = variant
        .querySelector('input[name="variant_price[]"]')
        .value.trim();
      const sku = variant
        .querySelector('input[name="variant_sku[]"]')
        .value.trim();
      const quantity = variant
        .querySelector('input[name="variant_quantity[]"]')
        .value.trim();
      const mainImage = variant
        .querySelector('input[name="variant_main_image[]"]')
        .value.trim();

      // Kiểm tra giá
      if (!price || price <= 0) {
        alert(`Giá của biến thể ${index + 1} không hợp lệ.`);
        isValid = false;
        return;
      }

      // Kiểm tra SKU
      if (!sku) {
        alert(`SKU của biến thể ${index + 1} không được để trống.`);
        isValid = false;
        return;
      }

      // Kiểm tra số lượng
      if (!quantity || quantity <= 0) {
        alert(`Số lượng của biến thể ${index + 1} phải lớn hơn 0.`);
        isValid = false;
        return;
      }

      // Kiểm tra ảnh chính
      if (!mainImage) {
        alert(`Vui lòng chọn ảnh chính đại diện cho biến thể ${index + 1}.`);
        isValid = false;
        return;
      }
    });

    // Ngăn gửi form nếu có lỗi
    if (!isValid) {
      event.preventDefault();
    }
  }

  // Gắn sự kiện validate vào form khi submit
  document
    .getElementById("addVariantForm")
    .addEventListener("submit", validateForm);

  // Gọi cập nhật trạng thái nút xóa khi tải trang
  updateTotalVariants();
</script>