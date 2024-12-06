<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
<?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Order Details</h3>
				</div>		
			</div>
		</div>
	</div>

    <!-- Order Details Area -->
    <div class="order_details_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Order Details (Order ID: <?php echo $_GET['order_id']; ?>)</h3>
                    <div class="order_details_table table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>View Details</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Giả sử $orderDetails là kết quả của truy vấn SQL
                                foreach ($orderDetails as $detail) {
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $detail->product_name; ?></td>
                                        <td>
                                            <img style="width: 50px; height: 50px; border: 1px solid grey;" src="<?php echo $detail->link; ?>" alt="">
                                        </td>
                                        <td><?php echo $detail->quantity; ?></td>
                                        <td><?php echo $detail->size; ?></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; border-radius: 50%; background-color: <?php echo $detail->color; ?>;"></div>
                                        </td>
                                        <td>$<?php echo $detail->price; ?></td>
                                        <td>$<?php echo $detail->total_price; ?></td>
                                        <td>
                                            <a href="?act=ProductDetails&id=<?php echo $detail->product_id; ?>" class="btn btn-default op_view">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <h4>Grand Total: $<?php echo $total; ?></h4>
                    </div>
                    <button><a href="?act=Order">Order</a></button>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'Components/User/footer.php';?>
</body>
</html>