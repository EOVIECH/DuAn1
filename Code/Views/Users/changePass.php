<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form #error_password,
    #error_password2 {
        color: red;
    }
</style>

<body>
    <h1>Đổi mật khẩu</h1>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="">Nhập mật khẩu</label>
        <input type="password" id="password" name="pass1"><br>
        <span class="error" id="error_password"></span> <br><br>
        <label for="">Nhập lại mật khẩu</label>
        <input type="password" id="password2" name="pass2"><br>
        <span class="error" id="error_password2"></span> <br><br>
        <button type="submit" name="submit">Gui</button>
    </form>
</body>
<script>
    function validateForm() {
        let password = document.getElementById("password").value.trim();
        let password2 = document.getElementById("password2").value.trim();

        document.querySelectorAll(".error").forEach((el) => (el.textContent = ""));

        let isValid = true;


        if (password === "") {
            document.getElementById("error_password").textContent = "Mật khẩu không được để trống.";
            isValid = false;
        } else if (password.length < 12) {
            document.getElementById("error_password").textContent = "Mật khẩu phải có ít nhất 12 ký tự.";
            isValid = false;
        } else if (!/^(?=.*[A-Z])(?=.*[!@#$%^&*()_{}\[\]:;<>,.?/~`]).{12,}$/.test(password)) {
            document.getElementById("error_password").textContent = "Mật khẩu phải có ít nhất 1 chữ in hoa, 1 ký tự đặc biệt và tối thiểu 8 ký tự.";
            isValid = false;
        }


        if (password2 === "") {
            document.getElementById("error_password2").textContent = "Mật khẩu không được để trống.";
            isValid = false;
        } else if (password !== password2) {
            document.getElementById("error_password2").textContent = "Mật khẩu sai vui lòng nhập lại.";
            isValid = false;
        }
        return isValid;
    }
</script>

</html>