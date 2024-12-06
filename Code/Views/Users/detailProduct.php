    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
    <style>
        .pd_img {
            text-align: center;
            /* Căn giữa hình ảnh chính */
            margin-bottom: 20px;
        }

        .pd_thumbnails {
            display: flex;
            justify-content: center;
            /* Căn giữa các thumbnail */
            gap: 10px;
            /* Khoảng cách giữa các hình ảnh */
        }

        .pd_thumbnails .thumbnail img {
            width: 60px;
            /* Kích thước ảnh phụ */
            height: 60px;
            object-fit: cover;
            /* Đảm bảo ảnh không bị méo */
            border: 1px solid #ddd;
            /* Đường viền ảnh */
            border-radius: 5px;
            transition: 0.3s;
            /* Hiệu ứng hover */
        }

        .pd_thumbnails .thumbnail img:hover {
            border-color: #000;
            /* Đổi màu đường viền khi hover */
            transform: scale(1.1);
            /* Phóng to nhẹ khi hover */
        }

        .pd_clr a {
            border: 1px solid orange;
        }

        .size-btn {
            padding: 8px 16px;
            margin: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            cursor: pointer;
            /* Hiển thị bàn tay khi trỏ vào */
            border-radius: 4px;
            transition: all 0.3s ease;
            /* Hiệu ứng chuyển đổi mượt mà */
        }

        .size-btn:hover {
            background-color: #ddd;
            /* Màu khi trỏ vào */
        }

        .size-btn:active {
            background-color: #bbb;
            /* Màu khi nhấn vào */
            transform: scale(0.95);
            /* Hiệu ứng thu nhỏ nhẹ khi nhấn */
        }

        .size-btn.active {
            background-color: #007bff;
            /* Màu khi nút được chọn */
            color: white;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <?php require_once 'Components/User/header.php'; ?>
    <!-- Page item Area -->
    <div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Details Product</h3>
				</div>		
			</div>
		</div>
	</div>

    <!-- Product Details Area  -->
    <div class="prdct_dtls_page_area">
        <?php
        ?>
            <div class="container">
                <div class="row">
                    <!-- Product Details Image -->
                    <div class="col-md-6 col-xs-12">
                        <div class="pd_img fix">
                            <!-- Main Product Image -->
                            <a class="venobox">
                                <img style="height: 675px; width: 540px;" id="main-image" src="<?php echo $listProductDetails->primary_image ?>" alt="Main Product Image" />
                            </a>
                        </div>

                        <!-- Thumbnails for Additional Images -->
                        <div class="pd_thumbnails">
                            <?php
                            $images = $listProductDetails->secondary_images;
                            $imagePrimary = $listProductDetails->primary_image;
                            $imageAlbum = explode(",", $images);
                            $i = 0;
                            foreach ($imageAlbum as $image) {
                            ?>
                                <a class="thumbnail" onmouseover="changeMainImage('<?php echo $image ?>')">
                                    <img src="<?php echo $image ?>" alt="Thumbnail <?php echo $i++ ?>" />
                                </a>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                    <!-- Product Details Content -->
                    <div class="col-md-6 col-xs-12">
                        <form action="?act=AddCart" method="POST">
                            <div class="prdct_dtls_content">
                                <a class="pd_title" id="product-name" href="#"><?php echo $listProductDetails->product_name ?></a>
                                <div class="pd_price_dtls fix">
                                    <!-- Product Price -->
                                    <div class="pd_price" id="product-price">
                                        <?php
                                        $currentDate = date('Y-m-d'); // Ngày hiện tại (định dạng YYYY-MM-DD)

                                        // Giả sử các giá trị được lấy từ DB
                                        $startDate = $listProductDetails->start_date; // Ngày bắt đầu
                                        $endDate = $listProductDetails->end_date; // Ngày kết thúc
                                        $priceCoupon = $listProductDetails->price_coupon; // Giá khuyến mãi

                                        // Kiểm tra điều kiện hiển thị
                                        if (strtotime($currentDate) >= strtotime($startDate) && strtotime($currentDate) <= strtotime($endDate)) {
                                        ?><span class="new"><?php echo $listProductDetails->price_coupon ?></span>
                                            <span class="old"><?php echo $listProductDetails->price ?></span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="new"><?php echo $listProductDetails->price ?></span>
                                            <span class="old">Hết hạn khuyến mãi</span>;
                                        <?php
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
                                    <p><?php echo $listProductDetails->description ?></p>
                                </div>
                                <h4>Size:</h4>
                                <div class="pd_img_size fix" id="product-sizes">
                                    <?php
                                    $sizes = explode(',', $listProductDetails->available_sizes);
                                    foreach ($sizes as $size) {
                                    ?>
                                        <button style="" type="button" class="size-btn" data-size="<?php echo $size ?>" onclick="selectSize('<?php echo $size ?>')">
                                            <?php echo $size ?>
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <input type="hidden" name="selected_size" id="selected-size" value="">
                                <input type="hidden" name="product_variant_id" id="product_variant_id" value="<?php echo $listProductDetails->product_variant_id ?>">
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $listProductDetails->product_id ?>">
                                <!-- Input hidden để lưu giá trị màu -->
                                <input type="hidden" id="selectedColor" name="selected_color" />
                                <div class="pd_clr_qntty_dtls fix">
                                    <div class="pd_clr">
                                        <h4>color:</h4>
                                        <?php
                                        foreach ($listColor as $color) {
                                        ?>
                                            <button
                                                type="button"
                                                class="color-btn <?php if ($color->color_id == $listProductDetails->color_id) echo 'active'; ?>"
                                                style="cursor: pointer; width: 30px; height: 30px; border-radius: 50%;background-color: <?php echo $color->color_code; ?>;"
                                                data-color-code="<?php echo $color->color_code; ?>"
                                                onclick="changeProductDetails(<?php echo $listProductDetails->product_id; ?>, <?php echo $color->color_id; ?>)">
                                            </button>
                                        <?php
                                        }
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
                                    <input type="submit" class="btn btn-default acc_btn" value="Add To Cart">
                                    <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-heart"></i></a>
                                    <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a>
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
                        </form>

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
                                    <p><?php echo $listProductDetails->description ?></p>
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
                                            <h3>Add your Comments</h3>
                                            <div class="rtng_form">
                                            <?php
                                            if(!isset($_SESSION['user_id']))
                                            {
                                            echo '<a href="?act=login">Muốn comment thì phải đăng nhập</a>';
                                            // exit;
                                            } elseif(isset($_SESSION['user_id']))
                                            {
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
                                                    <button type="submit" name="sendReviews" class="btn btn-success">Gửi đánh giá</button>
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
            </div>
        <?php
        ?>
    </div>
    <!-- Related Product Area -->
    <div class="related_prdct_area text-center">
        <div class="container">
            <!-- Section Title -->
            <div class="rp_title text-center">
                <h3>Related products</h3>
            </div>

            <div class="row">
                <?php
                foreach ($relatedProduct as $relatedPro) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single_product">
                            <div class="product_image">
                                <a href="?act=ProductDetails&id=<?php echo $relatedPro->product_id ?>"><img style="height: 256px;" src="<?php echo $relatedPro->link ?>" alt="" /></a>
                                <div class="box-content">
                                    <a href="#"><i class="fa fa-heart-o"></i></a>
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                </div>
                            </div>

                            <div class="product_btm_text">
                                <h4><a href="?act=ProductDetails&id=<?php echo $relatedPro->product_id ?>"><?php echo $relatedPro->name ?></a></h4>
                                <span class="price"><?php echo $relatedPro->min_price ?></span>
                            </div>
                        </div>
                    </div> <!-- End Col -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <?php require_once 'Components/User/footer.php'; ?>
</body>

</html>
<script>
    function changeMainImage(newImage) {
        // Tìm ảnh chính theo ID và cập nhật thuộc tính src
        document.getElementById('main-image').src = newImage;
    }

    function selectSize(size) {
        document.getElementById('selected-size').value = size;
    }
    // Lấy tất cả các tùy chọn màu
    const colorOptions = document.querySelectorAll('.color-option');

    // Lắng nghe sự kiện click
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Loại bỏ lớp 'active' khỏi tất cả các tùy chọn
            colorOptions.forEach(o => o.classList.remove('active'));

            // Thêm lớp 'active' vào tùy chọn được chọn
            this.classList.add('active');

            // Cập nhật giá trị cho input hidden
            
        });
    });

    function changeProductDetails(productId, colorId) {
    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `detailsProduct.php?id=${productId}&color=${colorId}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {

            const productData = JSON.parse(xhr.responseText);

            // Cập nhật thông tin sản phẩm
            document.getElementById('main-image').src = productData.primary_image || 'default-image.jpg';  // Thêm giá trị mặc định nếu không có primary_image
            document.getElementById('product-price').textContent = productData.price || 'Price not available';
            // document.getElementById('product-name').textContent = productData.name || 'Product name unavailable';

            // Cập nhật ảnh phụ
            const thumbnailsContainer = document.querySelector('.pd_thumbnails');
            thumbnailsContainer.innerHTML = ''; // Xóa nội dung cũ
            if (productData.secondary_images && productData.secondary_images.length > 0) {
                productData.secondary_images.forEach((image, index) => {
                    const anchor = document.createElement('a');
                    anchor.className = 'thumbnail';
                    anchor.onmouseover = () => changeMainImage(image);

                    const img = document.createElement('img');
                    img.src = image || 'default-thumbnail.jpg';  // Thêm giá trị mặc định nếu không có image
                    img.alt = `Thumbnail ${index}`;

                    anchor.appendChild(img);
                    thumbnailsContainer.appendChild(anchor);
                });
            } else {
                const noImageMessage = document.createElement('p');
                noImageMessage.textContent = 'No additional images available.';
                thumbnailsContainer.appendChild(noImageMessage);
            }

            // Cập nhật size
            const sizesContainer = document.getElementById('product-sizes');
            sizesContainer.innerHTML = ''; // Xóa nội dung cũ
            if (productData.sizes && productData.sizes.length > 0) {
                productData.sizes.forEach(size => {
                    const button = document.createElement('button');
                    button.className = 'size-btn';
                    button.textContent = size;
                    button.type = 'button';
                    button.setAttribute('data-size', size); // Thêm thuộc tính data-size
                    button.setAttribute('onclick', `selectSize('${size}')`); // Thêm phương thức onclick
                    sizesContainer.appendChild(button);
                });
            } else {
                const noSizeMessage = document.createElement('p');
                noSizeMessage.textContent = 'No sizes available.';
                sizesContainer.appendChild(noSizeMessage);
            }

            // Cập nhật trạng thái active cho màu
            document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.color-btn[onclick="changeProductDetails(${productId}, ${colorId})"]`).classList.add('active');
        }
    };
    xhr.send();
}

// Lắng nghe sự kiện click của tất cả nút màu
document.querySelectorAll('.color-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Xóa trạng thái 'active' khỏi các nút khác
        document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('active'));

        // Thêm trạng thái 'active' cho nút được chọn
        this.classList.add('active');

        // Lấy giá trị color_code từ thuộc tính data-color-code
        const selectedColorCode = this.getAttribute('data-color-code');

        // Cập nhật giá trị cho input hidden
        document.getElementById('selectedColor').value = selectedColorCode;
    });
});
</script>