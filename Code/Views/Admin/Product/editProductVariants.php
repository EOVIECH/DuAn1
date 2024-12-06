h<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="Views/Admin/Css/form.css" /> -->
    <title>Edit Product Variants</title>
    <style>
      img{
        height: 50px;
      }
    </style>
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
                            <h4 class="card-title">Add Product Variants</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addVariantForm" method="post" enctype="multipart/form-data" data-toggle="validator">
                            <div class="row">
                            <input type="hidden" id="totalVariantsInput" name="totalVariants" value="1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Type *</label>
                                        <select id="product_id" name="product_id" class=" form-control" data-style="py-0" required>
                                          <?php foreach($allDataProduct as $product): ?>
                                          <option value="<?php echo $product->product_id; ?>"  <?php echo ($product -> product_id == $listProductVariantById -> product_id) ? 'selected' : '' ?>>
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
                                              <input type="number" name="variant_price" class="form-control" value="<?php echo $listProductVariantById -> price ?>"  placeholder="Enter Price" data-errors="Please Enter Price." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                        </div>    
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_priceCoupon">Price Coupon *</label>
                                              <input type="number" name="variant_priceCoupon" value="<?php echo $listProductVariantById -> price_coupon ?>"  class="form-control" placeholder="Enter Price Coupon" data-errors="Please Enter Price Coupon." >
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_start_date">Start Date *</label>
                                              <input type="date" name="variant_start_date" value="<?php echo $listProductVariantById -> start_date ?>"  class="form-control" placeholder="Choose Start Date" data-errors="Please Enter Date." >
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_end_date">End Date *</label>
                                              <input type="date" name="variant_end_date"  value="<?php echo $listProductVariantById -> end_date ?>" class="form-control" placeholder="Choose End Date" data-errors="Please Enter Date." >
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="variant_sku">SKU *</label>
                                              <input type="text" name="variant_sku" value="<?php echo $listProductVariantById -> sku ?>" class="form-control" placeholder="Enter SKU" data-errors="Please Enter SKU." required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div> 
                                      <div class="col-md-6"> 
                                          <div class="form-group">
                                              <label for="variant_color">Color *</label>
                                              <select name="variant_color"  class=" form-control" data-style="py-0">
                                                <?php foreach($allDataColor as $color): ?>
                                                  <option value="<?php echo $color->color_id; ?>" <?php echo ($color -> color_id == $listProductVariantById -> color_id) ? 'selected' : '' ?> >
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
                                                  <input class="form-check-input" name="variant_size[<?php echo $size->size_id; ?>]" value="<?php echo $size->size_id; ?>" <?php 
                                                                                                                                         foreach($listProductVariantSizeById as $productSize)
                                                                                                                                         {
                                                                                                                                          if($size -> size_id  == $productSize -> size_id)
                                                                                                                                          {echo 'checked';  break;}
                                                                                                                                         } ?>  type="checkbox" id="inlineCheckbox1" >
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
                                              <input type="number" name="variant_quantity" value="<?php echo $listProductVariantById -> quantity ?>" class="form-control" placeholder="Enter Quantity" required>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="status">Status</label>
                                              <select class="form-control " id="variant_status" name="variant_status">
                                                <option value="active" <?php echo ($listProductVariantById -> status == 'active') ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?php echo ($listProductVariantById -> status == 'inactive') ? 'selected' : '' ?>>InActive</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="variant_main_image">Main Image</label>
                                              <input type="file" name="variant_main_image" accept="image/*" class="form-control image-file">
                                          </div>
                                          <?php if(isset($mainImageById) && $mainImageById !== false && isset($mainImageById->link)) {
                                            ?>
                                              <img src="<?php echo $mainImageById -> link ?>" alt="">
                                            <?php
                                          }else{echo 'Không có ảnh chính đại diện';} ?>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="variant_album_images">Album Image</label>
                                              <input type="file" name="variant_album_images[]" accept="image/*" multiple class="form-control image-file">
                                          </div>
                                          <?php
                                              // var_dump($albumImageById);
                                              if(isset($albumImageById) && !empty($albumImageById))
                                              {
                                                foreach($albumImageById as $albumImage)
                                                {
                                                  ?>
                                                    <img src="<?php echo $albumImage -> link ?>" alt="">
                                                  <?php
                                                }
                                              }else{echo 'Không có album ảnh';}
                                            ?>
                                      </div>
                                  </div>
                                </div>
                                
                            </div>  
                              <div class="d-flex justify-content-end">
                                  <input style="cursor: pointer;" name="editProductVariants" value="Sửa Biến Thể" type="submit"></input >
                              </div>    
                        
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

  function validateForm(event) {
    const variants = document.querySelectorAll(".variant");
    let isValid = true;

    variants.forEach((variant, index) => {
      const price = variant.querySelector('input[name="variant_price[]"]').value.trim();
      const sku = variant.querySelector('input[name="variant_sku[]"]').value.trim();
      const quantity = variant.querySelector('input[name="variant_quantity[]"]').value.trim();
      // const mainImage = variant.querySelector('input[name="variant_main_image[]"]').value.trim();

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
      // if (!mainImage) {
      //   alert(`Vui lòng chọn ảnh chính đại diện cho biến thể ${index + 1}.`);
      //   isValid = false;
      //   return;
      // }
    });

    // Ngăn gửi form nếu có lỗi
    if (!isValid) {
      event.preventDefault();
    }
  }

  // Gắn sự kiện validate vào form khi submit
  document.getElementById("addVariantForm").addEventListener("submit", validateForm);
</script>
