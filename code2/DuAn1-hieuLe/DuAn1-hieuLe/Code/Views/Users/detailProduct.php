<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
    <style>
        .pd_img {
            text-align: center; /* Căn giữa hình ảnh chính */
            margin-bottom: 20px;
        }

        .pd_thumbnails {
            display: flex;
            justify-content: center; /* Căn giữa các thumbnail */
            gap: 10px; /* Khoảng cách giữa các hình ảnh */
        }

        .pd_thumbnails .thumbnail img {
            width: 60px; /* Kích thước ảnh phụ */
            height: 60px;
            object-fit: cover; /* Đảm bảo ảnh không bị méo */
            border: 1px solid #ddd; /* Đường viền ảnh */
            border-radius: 5px;
            transition: 0.3s; /* Hiệu ứng hover */
        }

        .pd_thumbnails .thumbnail img:hover {
            border-color: #000; /* Đổi màu đường viền khi hover */
            transform: scale(1.1); /* Phóng to nhẹ khi hover */
        }
        .pd_clr a{
            border: 1px solid orange;
        }


        .comment-container {
            width: 100%;
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
        .rating input[type="radio"] {
        display: none;
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
    <?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Shop Details</h3>
				</div>		

				<div class="col-sm-6 text-right">
					<ul class="p_items">
						<li><a href="?act=Home">home</a></li>
						<li><a href="#">category</a></li>
						<li><span>Product Title</span></li>
					</ul>					
				</div>	
					
			
				
			</div>
		</div>
	</div>

    <!-- Product Details Area  -->
	<div class="prdct_dtls_page_area">
        <?php
        foreach($listProductDetails as $product)
        {
            ?>
                <div class="container">
                    <div class="row">
                        <!-- Product Details Image -->
                        <div class="col-md-6 col-xs-12">
                            <div class="pd_img fix">
                                <!-- Main Product Image -->
                                <a class="venobox">
                                    <img src="<?php echo $product -> primary_image ?>" alt="Main Product Image" />
                                </a>
                            </div>

                            <!-- Thumbnails for Additional Images -->
                            <div class="pd_thumbnails">
                                <?php
                                $images = $product -> secondary_images;
                                $imageAlbum = explode(",", $images);
                                // var_dump($images);
                                $i = 0;
                                foreach($imageAlbum as $image)
                                {
                                    ?>
                                        <a class="thumbnail">
                                            <img src="<?php echo $image ?>" alt="Thumbnail <?php echo $i++ ?>" />
                                        </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Product Details Content -->
                        <div class="col-md-6 col-xs-12">
                            <div class="prdct_dtls_content">
                                <a class="pd_title" href="#"><?php echo $product -> product_name ?></a>
                                <div class="pd_price_dtls fix">
                                    <!-- Product Price -->
                                    <div class="pd_price">
                                        <span class="new"><?php echo $product -> price ?></span>
                                        <?php
                                            $currentDate = date('Y-m-d'); // Ngày hiện tại (định dạng YYYY-MM-DD)

                                            // Giả sử các giá trị được lấy từ DB
                                            $startDate = $product->start_date; // Ngày bắt đầu
                                            $endDate = $product->end_date; // Ngày kết thúc
                                            $priceCoupon = $product->price_coupon; // Giá khuyến mãi

                                            // Kiểm tra điều kiện hiển thị
                                            if (strtotime($currentDate) >= strtotime($startDate) && strtotime($currentDate) <= strtotime($endDate)) {
                                                echo '<span class="old">' . $priceCoupon . '</span>';
                                            } else {
                                                echo '<span class="old">Hết hạn khuyến mãi</span>';
                                            }
                                        ?>
                                    </div>
                                    <!-- Product Ratting -->
                                    <div class="pd_ratng">
                                        <div class="rtngs">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd_text">
                                    <h4>overview:</h4>
                                    <p><?php echo $product -> description ?></p>
                                </div>
                                <div class="pd_img_size fix">
                                    <h4>size:</h4>
                                    <?php 
                                    foreach($sizes as $size)
                                    {
                                        $value = (isset($size->status) && $size->status === 'inactive') ? '' : '<a href="index.php?act=ProductDetails&id='.$_GET['id'].'&size='. $size -> size_id.'">'. htmlspecialchars($size->name).'</a>';
                                     echo $value;
                                    }
                                    ?>
                                </div>
                                <div class="pd_clr_qntty_dtls fix">
                                    <div class="pd_clr">
                                        <h4>color:</h4>
                                        <?php
                                            foreach($listColor as $color)
                                            {
                                                $getSize = isset($_GET['size']) ? $_GET['size'] : 1 ;
                                                ?>
                                                    <a  href="index.php?act=ProductDetails&id=<?php echo $product -> product_id ?>&size=<?= $getSize ?>&color=<?php echo $color -> color_id?>" class="<?php if($color -> color_id == $product -> color_id){echo 'active';} ?>" style="background: <?php echo $color -> color_code ?>;"><?php echo $color -> name ?></a>
                                                <?php
                                            }

                                            $colorr = isset($_GET['color']) ? $_GET['color'] : '';
                                            $sizer = isset($_GET['size']) ? $_GET['size'] : '';
         
                                        ?>
                                    </div>
                                    <div class="pd_qntty_area">
                                        <h4>quantity:</h4>
                                        <div class="pd_qty fix">
                                            <input value="1" name="quantity" class="cart-plus-minus-box" type="number">
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Action -->
                                <div class="pd_btn fix">
                                            <form action="" method="post" enctype="multipart/form-data">
                                            <a class="btn btn-default acc_btn">add to bag</a>

                                    <a class="btn btn-default acc_btn btn_icn" href="?act=wishlist&id=<?php echo $_GET['id'] ?>&color=<?php echo $colorr ?>&size=<?php echo $sizer ?>"><i class="fa fa-heart"></i></a>
                                    <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a>
                                            </form>
                                </div>
                                <div class="pd_share_area fix">
                                    <h4>share this on:</h4>
                                    <div class="pd_social_icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                        <a class="vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                                        <a class="google_plus" href="#"><i class="fa fa-google-plus"></i></a>
                                        <a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">					
                            <div class="pd_tab_area fix">									
                                <ul class="pd_tab_btn nav nav-tabs" role="tablist">
                                    <li>
                                    <a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
                                    </li>
                                    <li>
                                    <a href="#information" role="tab" data-toggle="tab">Information</a>
                                    </li>
                                    <li>
                                    <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="description">
                                        <p><?php echo $product -> description ?></p>
                                        <!-- <ul>
                                            <li>Lorem ipsum dolor sit amet, consectetur product</li>
                                            <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                                            <li>Excepteur sinted occaecat cupidatat non proident products</li>
                                            <li>Voluptate velit esse cillum.</li>
                                        </ul>					   -->
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="information">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor 
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>										  
                                    </div>

                                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                                            <div class="pda_rtng_area fix">
                                                <h4>4.5 <span>(Overall)</span></h4>
                                                <span>Based on 9 Comments</span>
                                            </div>
                                            <div class="rtng_cmnt_area fix">
                                                <div class="single_rtng_cmnt">
                                                    <div class="rtngs">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    <span>(4)</span>
                                                    </div>
                                                    <div class="rtng_author">
                                                        <h3>John Doe</h3>
                                                        <span>11:20</span>
                                                        <span>6 January 2017</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.</p>
                                                </div>

                                            </div>
                                            <div class="col-md-6 rcf_pdnglft">
                                                <div class="rtng_cmnt_form_area fix">
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

                                                </div>
                                            </div>				  
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            <?php
        }
        ?>
    </div>

    <!-- Related Product Area -->
	<div class="related_prdct_area text-center">
		<div class="container">		
				<!-- Section Title -->
				<div class="rp_title text-center"><h3>Related products</h3></div>
				
				<div class="row">
                    <?php
                    foreach($relatedProduct as $relatedPro)
                    {
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="single_product">
                                    <div class="product_image">
                                        <a href="?act=ProductDetails&id=<?php echo $relatedPro -> product_id ?>"><img style="height: 256px;" src="<?php echo $relatedPro -> link ?>" alt=""/></a>
                                        <div class="box-content">
                                            <a href="#"><i class="fa fa-heart-o"></i></a>
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        </div>										
                                    </div>

                                    <div class="product_btm_text">
                                        <h4><a href="?act=ProductDetails&id=<?php echo $relatedPro -> product_id ?>"><?php echo $relatedPro -> name ?></a></h4>
                                        <span class="price"><?php echo $relatedPro -> min_price ?></span>
                                    </div>
                                </div>								
                            </div> <!-- End Col -->		
                        <?php
                    }
                    ?>
			</div>
		</div>
	</div>


    <?php require_once 'Components/User/footer.php';?>
</body>
</html>