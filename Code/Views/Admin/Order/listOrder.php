<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
<?php require_once 'Components/Admin/navbar.php' ?>
<div class="content-page">
        <div class="container-fluid">
        <div class="row">
        <h2>Order Management</h2>
    
                <!-- Bảng đơn hàng -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Duyệt mảng đối tượng đơn hàng
                        foreach ($orders as $order) {
                            ?>
                            <tr>
                                <td><?php echo $order->order_id; ?></td>
                                <td><?php echo $order->username; ?></td>
                                <td>$<?php echo $order->total_price; ?></td>
                                <td>
                                    <form action="?act=ListOrder" method="POST">
                                        <select name="status">
                                            <option value="pending" <?php echo ($order->status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="confirmed" <?php echo ($order->status == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="completed" <?php echo ($order->status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                            <option value="canceled" <?php echo ($order->status == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                        </select>
                                        <input type="hidden" name="order_id" value="<?php echo $order->order_id; ?>">
                                        <input type="submit" name="updateStatus" value="Update Status">
                                    </form>
                                </td>
                                <td>
                                    <a href="?act=OrderDetailsMangage&order_id=<?php echo $order->order_id; ?>" class="btn btn-view">View Details</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
        <!-- Page end  -->
    </div>
<div class="container">
    
</div>

</body>
</html>