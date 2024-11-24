h<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Views/Admin/Css/form.css" />
    <title>Edit Product Variants</title>
    <style>
      img{
        height: 50px;
      }
    </style>
  </head>
  <body>
    <h3>Thông Tin Sản Phẩm</h3>
    <form
      id="editVariantForm"
      method="post"
      enctype="multipart/form-data"
    >
      <!-- <input type="hidden" id="totalVariantsInput" name="totalVariants" value="1"> -->
      <label for="product_id">Sản Phẩm:</label>
      <select id="product_id" name="product_id" required>
         <?php
          foreach($allDataProduct as $product)
          {
              ?>
                <option value="<?php echo $product -> product_id ?>" <?php echo ($product -> product_id == $listProductVariantById -> product_id) ? 'selected' : '' ?>><?php echo $product -> name ?></option>
              <?php
          }
         ?>
        </select
      ><br />
      <div id="variantsContainer">
        <div class="variant">
          <h4>Sửa Biến Thể Sản Phẩm</h4>
          <label for="variant_price">Giá:</label>
          <input type="number" name="variant_price" value="<?php echo $listProductVariantById -> price ?>" required /><br />

          <label for="variant_priceCoupon">Giá Giảm:</label>
          <input type="number" name="variant_priceCoupon" value="<?php echo $listProductVariantById -> price_coupon ?>" /><br />

          <label for="variant_start_date">Ngày Bắt Đầu:</label>
          <input type="date" name="variant_start_date" value="<?php echo $listProductVariantById -> start_date ?>" /><br />

          <label for="variant_end_date">Ngày Kết Thúc:</label>
          <input type="date" name="variant_end_date" value="<?php echo $listProductVariantById -> end_date ?>" /><br />
          
          <label for="variant_sku">Sku:</label>
          <input type="text" name="variant_sku" required value="<?php echo $listProductVariantById -> sku ?>" /><br />

          <label for="variant_color">Màu sắc:</label>
          <select name="variant_color">
          <?php
            foreach($allDataColor as $color)
            {
                ?>
                  <option value="<?php echo $color -> color_id ?>" <?php echo ($color -> color_id == $listProductVariantById -> color_id) ? 'selected' : '' ?> ><?php echo $color -> name ?></option>
                <?php
            }
          ?>
          </select
          ><br />

          <label for="variant_size">Kích thước:</label>
          <?php
            foreach($allDataSize as $size)
            {
                ?>
                  <input type="checkbox" name="variant_size[<?php echo $size->size_id; ?>]" value="<?php echo $size->size_id; ?>" <?php   //$check = false;
                                                                                                                                         foreach($listProductVariantSizeById as $productSize)
                                                                                                                                         {
                                                                                                                                          if($size -> size_id  == $productSize -> size_id)
                                                                                                                                          {echo 'checked';  break;}
                                                                                                                                         } ?> />
                  <?php echo $size->name; ?>
                <?php
            }
          ?>
          ><br />

          <label for="variant_quantity">Số lượng:</label>
          <input type="number" name="variant_quantity" value="<?php echo $listProductVariantById -> quantity ?>" required /><br />

          <label for="variant_main_image">Ảnh Chính Đại Diện:</label>
          <input
            type="file"
            name="variant_main_image"
            accept="image/*"
            
          /><br />
          <?php if(isset($mainImageById) && $mainImageById !== false && isset($mainImageById->link)) {
            ?>
              <img src="<?php echo $mainImageById -> link ?>" alt="">
            <?php
          }else{echo 'Không có ảnh chính đại diện';} ?>

          <label for="variant_album_images">Album Ảnh:</label>
          <input
            type="file"
            name="variant_album_images[]"
            accept="image/*"
            multiple
          /><br />
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
      <input style="cursor: pointer;" name="editProductVariants" value="Sửa Biến Thể" type="submit"></input >
    </form>
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
