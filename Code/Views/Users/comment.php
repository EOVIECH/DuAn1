
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Comment</title>
    <script src="https://kit.fontawesome.com/e2b0b931b4.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="comment-container">
        <h2>Để lại bình luận</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="comment">Bình luận</label>
                <textarea id="comment" name="comment" placeholder="Nhập nội dung bình luận" ></textarea>
            </div>

            <h1>Danh gia san pham</h1>
    <ul>
    <?php
$product_id = $_GET['id']; // Thay bằng ID sản phẩm thực tế
for ($count = 1; $count <= 5; $count++) {
    $color = ($count <= 1) ? 'color: #ffcc00' : 'color: #ccc;';
    ?>
    <li id="<?= $product_id ?>-<?= $count ?>" 
        class="rating" 
        data-index="<?= $count ?>" 
        data-product_id="<?= $product_id ?>" 
        data-rating="0"
        style="cursor: pointer; font-size: 40px; <?= $color ?>">
        <i class="fa-solid fa-star"></i>
    </li>
    <?php
}
?>

    </ul>
            <!-- Nút Gửi bình luận -->
            <button type="submit" class="comment-button" name="submit" onclick="remove_background($_GET['id'])">Gửi bình luận</button>
        </form>
    </div>

   
</body>

<script>
				 function remove_background(product_id)
					{
						for(var count = 1; count <= 5; count++)
						{
						$('#'+product_id+'-'+count).css('color', '#ccc'); 
						}
					}
					//hover chuột đánh giá sao
					$(document).on('mouseenter', '.rating', function(){
							var index = $(this).data("index"); //3
							var product_id = $(this).data('product_id'); //13
						
							// alert(index);
							// alert(product_id);
							remove_background(product_id);
							for(var count = 1; count<=index; count++)
							{
							$('#'+product_id+'-'+count).css('color', '#ffcc00');
							}
					});
					  //nhả chuột ko đánh giá
						$(document).on('mouseleave', '.rating', function(){
							var index = $(this).data("index");
							var product_id = $(this).data('product_id');
							var rating = $(this).data("rating");
							remove_background(product_id);
							//alert(rating);
							for(var count = 1; count<=rating; count++)
							{
							$('#'+product_id+'-'+count).css('color', '#ffcc00');
							}
							});

				</script>
				<script>
					 $('.rating').click(function(){
						var index = $(this).data("index"); //3
						var product_id = $(this).data('product_id');
						var customer_id = $(this).data('customer_id');
						$.ajax(
								{ url: 'ajax/rating.php',
									data: {index:index, product_id:product_id, customer_id:customer_id},
									type: 'POST',
									success: function(data) {
										
											alert('Đánh giá '+index+' sao thành công');
										
											

											}
							});
					})
					$(document).on('mouseenter', '.rating_login', function(){
						alert('Làm ơn đăng nhập để đánh giá sao.');
					})
				</script>

</html>






