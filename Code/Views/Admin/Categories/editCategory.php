<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>Edit Category</title>
  </head>
  <body>
    <form action="?act=EditCategory&id=<?php echo $listCategoryById -> category_id ?>" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
      <div>
        <h3></h3>
        <label for="category_name">Tên Danh Mục:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo $listCategoryById -> name ?>" required /><br />

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"><?php echo $listCategoryById -> description ?></textarea><br />

        <label for="parent_category_id">Thuộc đối tượng cha:</label>
        <select id="parent_category_id" name="parent_category_id" required>
        <?php
                if($listCategoryById -> parent_category_id == null)
                {
                    ?>
                        <option value="null" >NULL</option>
                    <?php
                }else
                {
                    ?>
                    <option value="null" >NULL</option>
                    <?php
                }
                foreach($listCategories as $category)
                {
                    ?>
                        <option value="<?php echo $category -> category_id ?>" <?php echo ($listCategoryById -> parent_category_id == $category -> category_id) ? 'selected' : '' ?>><?php echo $category -> name ?></option>
                    <?php
                }
                ?>
        ><br />
      </div>
      <input name="edit_Category" type="submit" value="edit Danh Muc"></input>
    </form>
  </body>
</html>
<script>
function validateForm() {
        // Kiểm tra tên thương hiệu
        const brandName = document.getElementById("brand_name").value;
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

        // Kiểm tra ảnh thương hiệu
        const brandImage = document.getElementById("brand_image").files[0];
        if (brandImage) {
          const validImageTypes = ["image/jpeg", "image/png", "image/gif"];
          if (!validImageTypes.includes(brandImage.type)) {
            alert("Chỉ chấp nhận các định dạng ảnh: JPEG, PNG, GIF.");
            return false;
          }
        }

        // Kiểm tra trạng thái hoạt động nhập hàng
        const brandStatus = document.getElementById("brand_status").value;
        if (brandStatus === "") {
          alert("Vui lòng chọn trạng thái hoạt động nhập hàng.");
          return false;
        }

        // Nếu tất cả đều hợp lệ
        return true;
      }
</script>