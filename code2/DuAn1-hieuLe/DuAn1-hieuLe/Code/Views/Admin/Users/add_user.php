<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
    body{
        height: 1500px;
    }

    form div span{
        color: red;
        font-style: italic;
    }

    .containers{
        max-width: 80%;
        padding-left: 70px;
        position: relative;
        left: 210px;
        top: 50px;
    }
</style>
<body>
<?php require_once './Components/Admin/navbar.php' ?>
<div class="content-page">
<div class="container-fluid add-form-list">
<h2 class="text-center">Thêm thông tin khách hàng</h2>
        <form action="?act=add-user" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <!-- Trường Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" >
                <span class="error" id="error_user_name"></span>
            </div>
            <!-- Trường Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" >
                <span class="error" id="error_email"></span>
                    <br><br>
            </div>
                  <!-- Trường password -->
                  <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
                <span class="error" id="error_password"></span>
                    <br><br>

            </div>
            <!-- Trường Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="phone" name="phone" >
                <span class="error" id="error_phone"></span>
                <br><br>

            </div>
            <!-- Trường Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" >

                <span class="error" id="error_address"></span>
                    <br><br>
            </div>

                <button class="btn btn-success" name="submit">ADD</button>
            <!-- Nút Submit
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a> -->
        </form>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function validateForm() {
    let userName = document.getElementById("name").value.trim();
    let password = document.getElementById("password").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let address = document.getElementById("address").value.trim();

    document.querySelectorAll(".error").forEach((el) => (el.textContent = ""));

    let isValid = true;


    if (userName === "") {
        document.getElementById("error_user_name").textContent = "Tên đăng nhập không được để trống.";
        isValid = false;
    } else if(userName.length<5){
        document.getElementById("error_user_name").textContent = "Tên đăng nhập cần có ít nhất 6 ký tự.";
        isValid = false;
    }


    if (password === "") {
        document.getElementById("error_password").textContent = "Mật khẩu không được để trống.";
        isValid = false;
    } else if (password.length < 12) {
        document.getElementById("error_password").textContent = "Mật khẩu phải có ít nhất 12 ký tự.";
        isValid = false;
    }


    if (email === "") {
        document.getElementById("error_email").textContent = "Email không được để trống.";
        isValid = false;
    } else if (!/\S+@\S+\.\S/.test(email)) {
        document.getElementById("error_email").textContent = "Email không đúng định dạng.";
        isValid = false;
    }

 
    if (phone === "") {
        document.getElementById("error_phone").textContent = "Số điện thoại không được để trống.";
        isValid = false;
    } else if (!/^[0-9]{10,11}$/.test(phone)) {
        document.getElementById("error_phone").textContent = "Số điện thoại phải là 10-11 chữ số.";
        isValid = false;
    }

    if (address === "") {
        document.getElementById("error_address").textContent = "Địa chỉ không được để trống.";
        isValid = false;
    }

    return isValid;
}

</script>
</body>
</html>
