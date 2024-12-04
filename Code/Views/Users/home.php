<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
</head>
<body>
	<?php require_once 'Components/User/header.php';?>
	<?php require_once 'Components/User/sliderHome.php';?>

	<!-- Start product Area -->
		<section id="product_area" class="section_padding">
			<div class="container">		
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="section_title">						
							<h2>Our <span>Products</span></h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>
			
				<div class="text-center">
					<div class="product_filter">
						<ul>
							<li class=" active filter" data-filter="all">Sản phẩm mới</li>
							<li class="filter" data-filter=".sale">Sản phẩm bán chạy</li>
							<li class="filter" data-filter=".bslr">Sản phẩm nhiều lượt xem nhất</li>
							<!-- <li class="filter" data-filter=".ftrd">Featured</li> -->
						</ul>
					</div>
					
					<div class="product_item">
						<div class="row">	
							<?php
								foreach($listProductNewest as $productNewest)
								{
									?>
										<div class="col-lg-3 col-md-4 col-sm-6 mix sale">
											<div class="single_product">
												<div class="product_image">
													<a href="?act=ProductDetails&id=<?php echo $productNewest -> product_id ?>"><img style="height: 256px;" src="<?php echo $productNewest -> link ?>" alt=""/></a>
													<div class="new_badge">New</div>									
												</div>

												<div class="product_btm_text">
													<h4><a href="?act=ProductDetails&id=<?php echo $productNewest -> product_id ?>"><?php echo $productNewest -> name ?></a></h4>
													<div class="p_rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>										
													<span class="price"><?php echo $productNewest -> min_price ?></span>
						
												</div>
											</div>
											
										</div> <!-- End Col -->	
									<?php
								}
							?>
						</div>
					</div>
					
				</div>
			</div>
		</section>
	<!-- End product Area -->

	<?php require_once 'Components/User/footer.php';?>
</body>
</html>