<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  .container .check{
    display: flex;
    justify-content: space-between;
    margin: 10px;
    margin-top: -5px;
    margin-bottom: 20px;
}

.container .a{
  text-decoration: none;
}

.container .card-body{
  margin-bottom: 0px;
  padding-bottom: 0px;
}

.container .d-grid{
  width: 100px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  left: 250px;
  bottom: 0px;
  
}
</style>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data" onsubmit="return validate()">
              <!-- Email Field -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email">
                <span id="error_email" style="color: red;"></span>
              </div>
              <!-- Password Field -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                <span id="error_password" style="color: red;"></span>
              </div>
              </div>
              <div class="check">
                <div><input type="checkbox" name="" id=""> remmember me</div>
                <a href="./?act=register">Forgot password</a>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-success">Login</button> <br>
              </div>

            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
  function validate() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    // Reset lỗi trước khi kiểm tra
    document.getElementById('error_email').textContent = "";
    document.getElementById('error_password').textContent = "";

    let isValid = true;

    // Kiểm tra email
    if (!email) {
      document.getElementById('error_email').textContent = "Vui lòng nhập email của bạn";
      isValid = false;
    } else if (!/\S+@\S+\.\S/.test(email)) {
      document.getElementById('error_email').textContent = "Vui lòng nhập đúng định dạng email";
      isValid = false;
    }
    if (!password) {
      document.getElementById('error_password').textContent = "Vui lòng nhập mật khẩu của bạn";
      isValid = false;
    }

    return isValid;
  }
</script>
</html>
