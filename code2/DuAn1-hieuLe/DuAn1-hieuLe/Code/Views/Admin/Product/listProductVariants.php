<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>List Product Variant</title>
</head>
<body>

    <?php require_once 'Components/Admin/navbar.php' ?>

    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Product Variant List</h4>
                            <p class="mb-0">
                                Manage and track product variants efficiently in this section. <br>
                                You can edit, delete, or add new product variants as needed.
                            </p>
                        </div>
                        <a href="?act=AddProductVariants" class="btn btn-primary"><i class="las la-plus mr-2"></i>Add Product Variant</a>
                    </div>
                </div>
            </div>

            

            <!-- Product Variant Table -->
            <form action="?act=DeleteSelectedProductVariant" method="post">
                <div class="table-responsive border rounded shadow-sm">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Mã Sản Phẩm Biến Thể</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Giá Được Giảm</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Sku</th>
                                <th>Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listProductVariants as $variant): ?>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $variant->product_variant_id ?>"></td>
                                    <td><?php echo $variant->product_variant_id ?></td>
                                    <td><?php echo $variant->product_name ?></td>
                                    <td><?php echo $variant->price ?></td>
                                    <td><?php echo $variant->price_coupon ?></td>
                                    <td><?php echo $variant->start_date ?></td>
                                    <td><?php echo $variant->end_date ?></td>
                                    <td><?php echo $variant->quantity ?></td>
                                    <td><?php echo $variant->color_name ?></td>
                                    <td><?php echo $variant->sku ?></td>
                                    <td>
                                        <?php
                                            $found = false;
                                            foreach($listProductVariantSize as $variantSize) {
                                                if ($variantSize->product_variant_id == $variant->product_variant_id) {
                                                    $found = true;
                                                    echo $variantSize->sizes;
                                                    break;
                                                }
                                            }
                                            if (!$found) echo 'KHÔNG CÓ';
                                        ?>
                                    </td>
                                    <td>
                                        <a href="?act=EditProductVariant&id=<?php echo $variant->product_variant_id ?>" 
                                           class="btn btn-warning btn-sm">Sửa</a>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="confirmDeleted('?act=DeleteProductVariant&id=<?php echo $variant->product_variant_id ?>')">
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if (isset($totalPages)): ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?act=ListProductVariant&page=<?php echo $i ?>">
                                        <?php echo $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </ul>
                </nav>

                <!-- Actions -->
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <button type="button" class="btn btn-outline-secondary" onclick="selectAll()">Chọn tất cả</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="deselectAll()">Bỏ chọn tất cả</button>
                    </div>
                    <div>
                        <button class="btn btn-danger" onclick="confirmDeleted('?act=DeleteSelectedProductVariant')" type="submit" name="btn-delSelected">
                            Xóa các mục đã chọn
                        </button>
                        <a href="?act=AddProductVariants" class="btn btn-primary">Nhập thêm</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
