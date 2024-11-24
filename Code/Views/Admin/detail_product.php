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
            height: 2000px;
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
            width: 80%;
            height: 1000px;
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
    <iframe src="?act=comment&id=<?php echo $_GET['id'] ?>" frameborder="0">
        
 </iframe>
 <?php
}
    ?>

</body>
</html>
