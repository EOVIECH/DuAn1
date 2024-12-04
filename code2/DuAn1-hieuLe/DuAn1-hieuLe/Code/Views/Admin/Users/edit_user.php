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
    <div class="containers mt-5">
        <h2 class="text-center">Sửa thông tin khách hàng</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Trường Name -->
            <div class="mb-3">
                <label for="username" class="form-label">Userusername</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $getID->username ?>" required>
            </div>
            <!-- Trường Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $getID->email ?>" required>
            </div>
                  <!-- Trường password -->
                  <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $getID->password ?>" required>
            </div>
            <!-- Trường Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $getID->phone ?>" required>
            </div>
            <!-- Trường Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $getID->address ?>" required>
            </div>

            <div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    </div>


                <!-- <button class="btn btn-success" name="submit">ADD</button> -->
            <!-- Nút Submit -->
            <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
            <a href="?act=list-user" class="btn btn-secondary" name="huy">Hủy</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
