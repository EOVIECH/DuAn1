<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

form {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #333;
}

input[type="text"], 
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    color: #555;
}

input[type="text"]:focus, 
select:focus {
    border-color: #007bff;
    outline: none;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

a {
    text-decoration: none;
}

a button {
    display: block;
    width: 100px;
    text-align: center;
}


</style>
<body>
<?php require_once 'Components/Admin/navbar.php' ?>
    <a href="?act=dataComment"><button class="btn btn-danger">Back</button></a>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">ID</label>
        <input type="text" name="review_id" value="<?php echo $result->review_id ?>">
        <label for="">Tên người dùng</label>
        <input type="text" name="user_name" value="<?php echo $result->username ?>" >
        <label for="">Tên sản phẩm</label>
        <input type="text" name="product_name" value="<?php echo $result->name ?>">
        <label for="">Nội dung</label>
        <input type="text" name="content" value="<?php echo $result->comment ?>">
        <label for="">Ngày tạo</label>
        <input type="text" name="" value="<?php echo $result->created_at ?>">
        <select name="status" id="status">
    <option value="<?php echo $result->status; ?>">
        <?php echo ($result->status === '1') ? "Active" : "Inactive"; ?>
    </option>
</select>
    </form>
</body>
</html>