<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Cart</h3>
				</div>		
			</div>
		</div>
	</div>

    <!-- Cart -->
    <div class="cart_page_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="cart_table_area table-responsive">
							<table class="table cart_prdct_table text-center">
								<thead>
									<tr>
										<!-- <th class="cpt_no">Id cart</th> -->
										<th class="cpt_img">image</th>
										<th class="cpt_pn">product name</th>
										<th class="cpt_q">quantity</th>
										<th class="cpt_q">size</th>
										<th class="cpt_q">color</th>
										<th class="cpt_p">price</th>
										<th class="cpt_t">total</th>
										<th class="cpt_r">remove</th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                    foreach($listCart as $cart)
                                    {
                                        $totalPrice = $cart->quantity * $cart->price;
                                        ?>
                                            <tr>
                                                <!-- <td><span class="cp_no"></span></td> -->
                                                <td><a href="#" class="cp_img"><img src="<?php echo $cart -> link ?>" alt="" /></a></td>
                                                <td><a href="#" class="cp_title"><?php echo $cart -> product_name ?></a></td>
                                                <td>										
                                                    <div class="cp_quntty">																			
                                                        <input name="quantity" value="<?php echo $cart -> quantity ?>" size="2" type="number">													
                                                    </div>
                                                </td>
                                                <td><p class="cp_size"><?php echo $cart -> size ?></p></td>
                                                <td><p class="cp_color" style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid black; background-color: <?php echo $cart -> color ?>;"></p></td>
                                                <td><p class="cp_price"><?php echo $cart -> price ?></p></td>
                                                <td><p class="cpp_total"><?php echo $totalPrice ?></p></td>
                                                <td><a href="?act=DeleteItemCart&cartId=<?php echo $cart -> cart_id ?>" class="btn btn-default cp_remove"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        <?php
                                    }
                                    ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8 col-xs-12 cart-actions cart-button-cuppon">
						<div class="row">
							<div class="col-sm-7">
								<div class="cart-action">
									<a href="?act=Shop" class="btn border-btn">continiue shopping</a>
									<a href="#" class="btn border-btn">update shopping bag</a>
								</div>
							</div>
							
							<div class="col-sm-5">
								<div class="cuppon-wrap">
									<h4>Discount Code</h4>
									<p>Enter your coupon code if you have one:</p>
									<form method="POST" action="?act=Cart">
										<input type="text" name="discount_code" placeholder="Enter discount code" />
										<button type="submit" name="apply_discount" class="btn border-btn">Apply Coupon</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
						<div class="wrap">
							<?php
							if (isset($totalPrice)) {
								$finalPrice = isset($_SESSION['final_price']) ? $_SESSION['final_price'] : $totalPrice;
								$discountAmount = isset($_SESSION['discount_amount']) ? $_SESSION['discount_amount'] : 0;
								?>
								<p><span>Subtotal:</span><span><?php echo $totalPrice; ?></span></p>
								<p><span>Discount:</span><span><?php echo $discountAmount; ?></span></p>
								<h4><span>Grand total:</span><span><?php echo $finalPrice; ?></span></h4>
								<a href="?act=Checkout" class="btn border-btn">process to checkout</a>
								<?php
							}
							?>
						</div>
					</div>
					
				</div>
			</div>
		</div>

    <?php require_once 'Components/User/footer.php';?>
    
</body>
</html>