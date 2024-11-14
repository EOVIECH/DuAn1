<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Views/Admin/Css/form.css">
    <title>Add Brand</title>
  </head>
  <body>
    <form action="?act=AddBrand" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
      <div>
        <h3></h3>
        <label for="brand_name">Tên thương hiệu:</label>
        <input type="text" id="brand_name" name="brand_name" required /><br />

        <label for="description">Mô tả thương hiệu:</label>
        <textarea id="description" name="description"></textarea><br />

        <label for="brand_image">Ảnh thương hiệu:</label>
        <input
          type="file"
          id="brand_image"
          name="brand_image"
          accept="image/*"
        /><br />

        <label for="brand_status">Hoạt động nhập hàng:</label>
        <select id="brand_status" name="brand_status" required>
          <option value="active">Có</option>
          <option value="inactive">Không</option></select
        ><br />
      </div>
      <input name="add_Brand" type="submit" value="Thêm Thương Hiệu"></input>
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