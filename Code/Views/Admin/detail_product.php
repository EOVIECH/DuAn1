<?php
// Dữ liệu giả lập sản phẩm (có thể thay bằng truy vấn từ cơ sở dữ liệu)
$product = [
    'name' => 'Giay NIKE',
    'brand' => 'NIKE',
    'sku' => 'A123456',
    'description' => 'Điện thoại thông minh thế hệ mới nhất với màn hình ProMotion 120Hz, chip A16 Bionic mạnh mẽ, và hệ thống camera đỉnh cao.',
    'price' => '35,000,000 VND',
    'status' => 'active',
    'image' => 'https://goccuanho.com/wp-content/uploads/2021/06/m-4-1012x1024.jpeg' // Đường dẫn ảnh sản phẩm
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm - <?php echo $product['name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            height: auto;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            max-width: 70%;
            height: auto;
            border-radius: 8px;
        }
        .product-details {
            margin-top: 20px;
        }
        .product-name {
            font-size: 28px;
            font-weight: bold;
        }
        .product-brand, .product-sku, .product-price, .product-status {
            font-size: 16px;
            margin-top: 10px;
        }
        .product-description {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-inactive {
            color: red;
            font-weight: bold;
        }

        iframe{
            width: 100%;
            height: 400px;  
            position: relative;
            left: 20px;
        }

        .comment-container {
            width: 50%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comment-container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .comment-button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #ccc;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment-button:hover {
            background-color: #2980b9;
        }

        .rating {
            direction: rtl; /* Đảo chiều để chọn sao từ phải sang trái */
            unicode-bidi: bidi-override;
            display: inline-flex;
        }
        .rating input {
            display: none; /* Ẩn input radio */
        }
        .rating label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #f5a623; /* Màu vàng cho sao được chọn */
        }
    </style>

</head>
<body>
    <div class="container">
        <!-- Hình ảnh sản phẩm -->
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
        
        <!-- Thông tin sản phẩm -->
        <div class="product-details">
            <div class="product-name"><?php echo $product['name']; ?></div>
            <div class="product-brand"><strong>Thương hiệu:</strong> <?php echo $product['brand']; ?></div>
            <div class="product-sku"><strong>SKU:</strong> <?php echo $product['sku']; ?></div>
            <div class="product-price"><strong>Giá:</strong> <?php echo $product['price']; ?></div>
            <div class="product-status">
                <strong>Trạng thái:</strong> 
                <span class="status-<?php echo $product['status']; ?>">
                    <?php echo ($product['status'] === 'active') ? 'Còn hàng' : 'Hết hàng'; ?>
                </span>
            </div>
            <div class="product-description">
                <strong>Mô tả sản phẩm:</strong> <?php echo $product['description']; ?>
            </div>
        </div>
    </div>
    <h3>COMMENT</h3> 
    <?php
    if(!isset($_SESSION['user_id'])){
    echo '<a href="?act=login">Muốn comment thì phải đăng nhập</a>';
    exit;
    
  } elseif(isset($_SESSION['user_id'])){
    ?>
     <div class="comment-container">
        <h2>Để lại bình luận</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="comment">Bình luận</label>
                <textarea id="comment" name="comment" placeholder="Nhập nội dung bình luận" ></textarea>
                <br> <br>

                <div class="rating">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">&#9733;</label>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Gửi đánh giá</button>
            </div>
            <div>
                <p><em style="color: red;"><?php echo $_SESSION['average'] ?> tren 5</em></p>
            </div>
</form>
    </div>
 <?php
}
?>

<iframe src="?act=feedBack" frameborder="0" style="height: 1000px;"></iframe>
</body>
</html>
