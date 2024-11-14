<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>Add Categories</title>
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
      <div>
        <h3></h3>
        <label for="categories_name">Tên Danh Mục:</label>
        <input type="text" id="categories_name" name="categories_name" required /><br />

        <label for="description">Mô tả Danh Mục:</label>
        <textarea id="description" name="description"></textarea><br />

         <!-- Parent Category -->
         <label for="parent_category">Parent Category</label>
         <select id="parent_category" name="parent_category">
             <option value='null'>None</option>
             <!-- Option values should be dynamically generated from existing categories in the database -->
            <?php
            foreach($listCategories as $category){
              ?>
                <option value="<?php echo $category -> category_id ?>"><?php echo $category -> name ?></option>
              <?php
            }
            ?>
             <!-- Add more categories as needed -->
         </select>
          <input type="submit" name="add_categories" value="Thêm Danh Mục">
      </div>
    </form>
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