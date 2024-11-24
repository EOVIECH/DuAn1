<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Views/css/register.css">
    <title>Form Đăng Ký</title>
</head>
<body>
   
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <h1>Form Đăng Ký</h1>
<div class="container">
    <div class="contentLeft">
                    <!-- Tên đăng nhập -->
                    <label for="user_name">Tên đăng nhập:</label>
                    <input type="text" id="user_name" name="user_name">
                    <span class="error" id="error_user_name"></span>
                    <br><br>

                    <!-- Mật khẩu -->
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password">
                    <span class="error" id="error_password"></span>
                    <br><br>

                    <!-- Email -->
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email">
                    <span class="error" id="error_email"></span>
                    <br><br>
    </div>

    <div class="contentRight">

                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" id="phone" name="phone">
                    <span class="error" id="error_phone"></span>
                    <br><br>

                    <!-- Địa chỉ -->
                    <label for="address">Địa chỉ:</label>
                    <textarea id="address" name="address" rows="1"></textarea>
                    <span class="error" id="error_address"></span>
                    <br><br>


                    <!-- Ngày tạo -->
                    <label for="create_at">Ngày tạo:</label>
                    <input type="date" id="create_at" name="create_at">
                    <span class="error" id="error_create_at"></span>
                    <br><br>

    </div>
</div>

        <!-- Nút gửi -->
        <button name="submit">Đăng ký</button>
    </form>
    
</body>

<script>
    function validateForm() {
    let userName = document.getElementById("user_name").value.trim();
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
    else if (!/^(?=.*[A-Z])(?=.*[!@#$%^&*()_{}\[\]:;<>,.?/~`]).{12,}$/.test(password)) {
    document.getElementById("error_password").textContent = "Mật khẩu phải có ít nhất 1 chữ in hoa, 1 ký tự đặc biệt và tối thiểu 8 ký tự.";
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
</html>
