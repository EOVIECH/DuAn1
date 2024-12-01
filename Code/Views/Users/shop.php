<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
    <style>
        .pagination {
            display: flex !important; 
            list-style: none;
            padding: 0;
            margin: 0;
            }

        .pagination .page-item {
        margin: 0 5px;
        }

        .pagination .page-item a {
        display: block;
        padding: 8px 12px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
        }

        .pagination .page-item a:hover {
        background-color: #007bff;
        color: #fff;
        }

        .pagination .page-item.active a {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        }

        .pagination .page-item.disabled a {
        color: #6c757d;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
        }       
    </style>
</head>
<body>
	<?php require_once 'Components/User/header.php';?>

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
					<!-- Filter by Categories and Name-Product -->
                    <div class="row">
                        <form action="index.php?act=Shop" method="POST">
                            <div class="col-lg-12 mb-4">
                                <div class="input-group">
                                        <input type="search" name="product_name" class="form-control rounded" placeholder="Search" aria-label="Search By Name" aria-describedby="search-addon" />
                                        <select name="category_id" class="form-select">
                                            <?php
                                                if(!isset($_POST['product_name']) && !isset($_POST['category_id']))
                                                {
                                                    ?>
                                                        <option value="" selected>Search By Category</option>
                                                    <?php
                                                }
                                            ?>
                                            <?php
                                                foreach($listCategories as $category)
                                                {
                                                    ?>
                                                        <option value="<?php echo $category->category_id ?>"> <?php echo $category->name ?>  </option>
                                                    <?php
                                                }
                                            ?>
                                            <option value="">All</option>
                                        </select>
                                        <button type="submit" name="search" class="btn btn-outline-primary" data-mdb-ripple-init>Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                                                
					<div class="product_item">
						<div class="row">	
							<?php
                            if(isset($listProduct) && !empty($listProduct))
                            {
                                foreach($listProduct as $product)
								{
									?>
										<div class="col-lg-3 col-md-4 col-sm-6 mix sale">
											<div class="single_product">
												<div class="product_image">
													<a href="?act=ProductDetails&id=<?php echo $product -> product_id ?>"><img style="height: 256px;" src="<?php echo $product -> link ?>" alt=""/></a>
													<div class="new_badge">New</div>
													<div class="box-content">
														<a style="line-height: 35px;" href="#"><i class="fa fa-heart-o"></i></a>
														<a href="#"><i class="fa fa-cart-plus"></i></a>
														<!-- <a href="#"><i class="fa fa-search"></i></a> -->
													</div>										
												</div>

												<div class="product_btm_text">
													<h4><a href="?act=ProductDetails&id=<?php echo $product -> product_id ?>"><?php echo $product -> name ?></a></h4>
													<div class="p_rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>										
													<span class="price"><?php echo $product -> min_price ?></span>
						
												</div>
											</div>
											
										</div> <!-- End Col -->	
									<?php
								}
                            }else
                            {

                            }

							?>
						</div>
					</div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php 
                                if(isset($totalPages)){
                                    for ($i = 1; $i <= $totalPages; $i++)
                                    {
                                        ?>
                                            <li class="page-item <?php echo $i == $currentPage ? 'active' : '' ?>">
                                                <a class="page-link" href="?act=Shop&page=<?php echo $i ?>">
                                                    <?php echo $i ?>
                                                </a>
                                            </li>
                                        <?php
                                    }
                                }
                                ?>
                        </ul>
                    </nav>
				</div>
			</div>
		</section>
	<!-- End product Area -->

	<?php require_once 'Components/User/footer.php';?>
</body>
</html>