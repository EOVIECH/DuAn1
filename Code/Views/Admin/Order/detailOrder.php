<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
<?php require_once 'Components/Admin/navbar.php' ?>

<div class="content-page">
    <div class="container">
        <h2>Order Details</h2>
        <a href="?act=ListOrder" class="btn btn-primary"><i class="las la-plus mr-2"></i>List Order </a>
        <?php if ($orderDetails): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Image</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($detail->product_name); ?></td>
                            <td><?php echo htmlspecialchars($detail->quantity); ?></td>
                            <td>$<?php echo htmlspecialchars($detail->price); ?></td>
                            <td><?php echo htmlspecialchars($detail->size); ?></td>
                            <td>
                                <div style="border: 1px solid black;width: 20px; height: 20px; border-radius: 50%; background-color: <?php echo htmlspecialchars($detail->color); ?>;"></div>
                            </td>
                            <td>
                                <img src="<?php echo htmlspecialchars($detail->link); ?>" alt="Product Image" style="border:  1px solid black;width: 50px; height: auto;">
                            </td>
                            <td>$<?php echo htmlspecialchars($detail->quantity * $detail->price); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No details available for this order.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>