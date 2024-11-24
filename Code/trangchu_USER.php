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
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .product-box {
            width: calc(25% - 20px); /* 4 sản phẩm chia đều */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .product-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-price {
            color: #e74c3c;
            font-size: 16px;
            margin: 10px 0;
        }
        .product-button {
            display: inline-block;
            margin: 10px 0 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        .product-button:hover {
            background-color: #2980b9;
        }
    </style>
<body>
    <h1>Day la ttrang nguoi dung</h1>
  <a href="?act=login"><button >Login</button></a>
<?php
foreach($listProduct as $value){
    ?>
    <div class="container">
        <div class="product-box">
            <img src="https://goccuanho.com/wp-content/uploads/2021/06/m-4-1012x1024.jpeg" alt="Sản phẩm 1" class="product-image">
            <div class="product-name"><?= $value->name ?></div>
            <div class="product-price">35,000,000 VND</div>
            <a href="?act=detail-product&id=<?= $value->product_id?>" class="product-button">Xem chi tiết</a>
        </div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>