<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
<?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Checkout</h3>
				</div>		
			</div>
		</div>
	</div>

    <!-- Checkout Page -->
	<section class="checkout_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title">
                            <h3>Billing Details</h3>
                        </div>
                        <form class="checkout_form" action="?act=Checkout" method="post">
                            <div class="form-row">
                                <!-- <div class="form-group col-md-6">
                                    <input name="first_name" placeholder="First name" class="form-control" type="text" required>
                                </div> -->
                                <div class="form-group col-md-6">
                                    <input name="Name" placeholder="Name" class="form-control" type="text" value="<?php echo $listUser -> username ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="email" placeholder="Email address" class="form-control" type="email" value="<?php echo $listUser -> email ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input name="phone" placeholder="Phone number" class="form-control" value="<?php echo $listUser -> phone ?>" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country">Country:</label>
                                <div class="custom-select-wrapper">
                                    <select id="country" name="country" class="custom-select" required>
                                        <option value="vietnam">Việt Nam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address:</label>
                                <textarea rows="3" name="street" id="address" placeholder="Street address. Apartment, suite, unit etc. (optional)" class="form-control" required><?php echo $listUser -> address ?></textarea>
                            </div>

                            <!-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="code" placeholder="Post code / Zip" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input name="city" placeholder="Town / City" class="form-control" type="text" required>
                                </div>
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="order_note">Order note:</label>
                                <textarea rows="3" name="order_note" placeholder="Order note" class="form-control"></textarea>
                            </div> -->

                            <div class="payment_method">
                                <ul>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="payment_method" value="VNPay" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadio1">VNPay</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="payment_method" value="COD" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadio2">Ship Cod</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="qc-button">
                                <input type="submit" value="Place Order" name="order" class="btn border-btn"></input>
                            </div>

                    </div>
                    <div class="col-md-6">
                        <div class="title">
                            <h3>your order</h3>
                        </div>
						
						<div class="your-order-table table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="product-name">Product Name</th>
										<th class="product-total">Total</th>
										<th class="product-color">Color</th>
										<th class="product-size">Size</th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                        $total = 0;
                                        foreach($listCart as $cart)
                                        {
                                            // $total += $cart->price;
                                            $total = $_SESSION['final_price'] ?? $cart->price;
                                            ?>
                                                <tr>
                                                    <td class="product-name"><?php echo $cart -> product_name ?></td>
                                                    <td class="product-total"><span>$<?php echo $total ?></span></td>
                                                    <td class="product-color"><span><p class="cp_color" style="width: 50px; height: 50px; border-radius: 50%; background-color: <?php echo $cart -> color ?>;"></p></span></td>
                                                    <td class="product-size"><span><?php echo $cart -> size ?></span></td>
                                                </tr>
                                                
                                                <input type="hidden" name="quantity[]" value="<?php echo $cart->quantity ?>">
                                                <input type="hidden" name="price[]" value="<?php echo $total ?>">
                                                <input type="hidden" name="product_variant_id[]" value="<?php echo $cart->product_variant_id ?>">
                                                <input type="hidden" name="color[]" value="<?php echo $cart->color ?>">
                                                <input type="hidden" name="size[]" value="<?php echo $cart->size ?>">
                                            <?php
                                            
                                        }
                                    ?>
								</tbody>
								<tfoot>
									<tr>
										<th>Total</th>
										<td><span class="amount">$<?php echo $total ?></span></td>
                                        <input type="hidden" name="total" value="<?php echo $total ?>">
									</tr>
								</tfoot>
							</table>
						</div>
				
                    </div>
                    </form>

					
                </div>
            </div>
        </section>


<?php require_once 'Components/User/footer.php';?>
</body>
</html>