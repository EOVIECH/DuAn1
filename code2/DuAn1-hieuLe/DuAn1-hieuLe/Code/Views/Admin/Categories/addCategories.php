<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="Views/Admin/Css/form.css"> -->
    <title>Add Categories</title>
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
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category_name">Category Name *</label>
                                            <input type="text" class="form-control" id="categories_name" name="categories_name" placeholder="Enter category name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Mô tả Danh Mục:</label>
                                            <<textarea id="description" class="form-control" name="description"></textarea><br />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="parent_category">Parent Category</label>
                                            <select class="form-control " id="parent_category" name="parent_category">
                                                <option value="null">None</option>
                                                <?php
                                                  foreach($listCategories as $category){
                                                    ?>
                                                      <option value="<?php echo $category -> category_id ?>"><?php echo $category -> name ?></option>
                                                    <?php
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add_categories" value="Thêm Danh Mục" class="btn btn-primary mr-2">Add Category</button>
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