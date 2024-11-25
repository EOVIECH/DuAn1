<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>Edit Category</title>
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
                                <h4 class="card-title">Add Category</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="?act=EditCategory&id=<?php echo $listCategoryById -> category_id ?>" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category_name">Category Name *</label>
                                            <input type="text" class="form-control" id="category_name" value="<?php echo $listCategoryById -> name ?>" name="category_name" placeholder="Enter category name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Mô tả Danh Mục:</label>
                                            <<textarea id="description" class="form-control" name="description"><?php echo $listCategoryById -> description ?></textarea><br />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="parent_category_id">Parent Category</label>
                                            <select class="form-control " id="parent_category_id" name="parent_category_id">
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
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="edit_Category" value="edit Danh Mục" class="btn btn-primary mr-2">Edit Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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