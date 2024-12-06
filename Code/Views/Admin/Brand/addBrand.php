<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="Views/Admin/Css/form.css"> -->
    <title>Add Brand</title>
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
                        <form action="?act=AddBrand" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
                            <div class="row">
                              <div class="col-md-12">                      
                                <div class="form-group">
                                    <label for="brand_name">Tên thương hiệu:</label>
                                    <input type="text" id="brand_name"  name="brand_name" class="form-control" placeholder="Enter Name Brand" data-errors="Please Enter Name Brand." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                              </div>    
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="description">Mô tả thương hiệu:</label>
                                      <textarea name="description" id="description"  class="form-control" rows="4"></textarea>
                                      <div class="help-block with-errors"></div>
                                  </div>
                              </div> 
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="brand_image">Ảnh thương hiệu:</label>
                                      <input type="file" id="brand_image" name="brand_image" accept="image/*" class="form-control image-file">
                                  </div>
                              </div>
                              <div class="col-md-12"> 
                                  <div class="form-group">
                                      <label for="brand_status">Hoạt động nhập hàng:</label>
                                      <select name="brand_status" id="brand_status"  class=" form-control" data-style="py-0" required>
                                        <option value="active">Có</option>
                                        <option value="inactive">Không</option>
                                      </select>
                                  </div>
                              </div> 
                              <!-- <input class="btn btn-primary" style="cursor: pointer" name="add_Brand" value="Thêm Thương Hiệu" type="submit"> -->
                              <button type="submit" name="add_Brand" value="Thêm Thương Hiệu" class="btn btn-primary mr-2">Thêm Thương Hiệu</button>
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