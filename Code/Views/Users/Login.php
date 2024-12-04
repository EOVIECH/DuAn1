<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Login</h3>
				</div>		
			</div>
		</div>
	</div>

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
						<div><input type="checkbox" name="remmember" id=""> remmember me</div>
						<a href="./?act=forgot">Forgot password</a>
					</div>
					<div class="d-grid">
						<button type="submit" class="btn btn-success" name="submit">Login</button> <br>
					</div>

					<a href="./?act=register">Resgister</a>
					</form>
				</div>
				</div>
			</div>
			</div>
		</div>

		<!-- Bootstrap JS Bundle -->
	</body>
    
    <?php require_once 'Components/User/footer.php';?>
    
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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