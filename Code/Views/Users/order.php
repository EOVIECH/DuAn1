<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>
<body>
<?php require_once 'Components/User/header.php';?>
    <!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Order</h3>
				</div>		
			</div>
		</div>
	</div>
    <a href="?act=OrderCanceled">Order Canceled</a>
    <div class="order_page_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="order_table_area table-responsive">
                        <table class="table order_prdct_table text-center">
                            <thead>
                                <tr>
                                    <th class="opt_nameProduct">Name Product</th>
                                    <th class="opt_date">Order Date</th>
                                    <th class="opt_status">Status</th>
                                    <th class="opt_payment">Payment</th>
                                    <th class="opt_address">Address</th>
                                    <th class="opt_total">Total</th>
                                    <th class="opt_action">Details</th>
                                    <th class="opt_delete"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listOrders as $order) {
                                    ?>
                                    <tr>
                                        <td><span class="op_date"><?php echo $order->product_name; ?></span></td>
                                        <td><span class="op_date"><?php echo $order->order_date; ?></span></td>
                                        <td><span class="op_status"><?php echo ucfirst($order->status); ?></span></td>
                                        <td><span class="op_payment"><?php echo $order -> payment_status ?></span></td>
                                        <td><span class="op_status"><?php echo ucfirst($order->address); ?></span></td>
                                        <td><span class="op_total">$<?php echo $order->total_price; ?></span></td>
                                        <td>
                                            <a href="?act=OrderDetails&order_id=<?php echo $order->order_id; ?>" class="btn btn-default op_view">
                                                View Details
                                            </a>
                                        </td>
                                        <td><button onclick="confirmDeleted('?act=deleteOrder&orderId=<?php echo $order -> order_id ?>')">DELETE ORDER</button></td>
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
                <div class="col-md-12 text-center">
                    <a href="?act=Shop" class="btn border-btn">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'Components/User/footer.php';?>

</body>
</html>
<script>
    function confirmDeleted(delURL)
    {
        if(confirm('DO YOU WANT TO DELETE ORDER'))
        {
            document.location = delURL;
        }
    }
   
</script>