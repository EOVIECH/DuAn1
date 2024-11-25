
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>List Product</title>
</head>
<body>

    <?php require_once 'Components/Admin/navbar.php' ?>


    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                <h4 class="mb-3">Product List</h4>
                <p class="mb-0">
                    The product list effectively dictates product presentation and provides space<br>
                    to list your products and offerings in the most appealing way.
                </p>
                </div>
                <a href="?act=AddProducts" class="btn btn-primary"><i class="las la-plus mr-2"></i>Add Product </a>
            </div>
            </div>
        </div>


         <!-- Filter by Categories -->
         <div class="row">
                <div class="col-lg-12 mb-4">
                    <h4>Danh Mục</h4>
                    <div class="d-flex flex-wrap">
                        <a href="?act=ListProduct" class="btn btn-outline-primary m-2">Tất Cả</a>
                        <?php foreach ($listCategories as $category): ?>
                            <a href="?act=ListProduct&category=<?php echo $category->category_id ?>" 
                               class="btn btn-outline-primary m-2">
                                <?php echo $category->name ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Product Table -->
            <form action="?act=DeleteSelectedProduct" method="post">
                <div class="table-responsive border rounded shadow-sm">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Thương Hiệu</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Miêu Tả</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Thuộc Danh Mục</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listProduct as $product): ?>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $product->product_id ?>"></td>
                                    <td><?php echo $product->product_id ?></td>
                                    <td><?php echo $product->brand_name ?></td>
                                    <td><?php echo $product->name ?></td>
                                    <td><?php echo $product->description ?></td>
                                    <td><?php echo $product->status ?></td>
                                    <td><?php echo $product->created_at ?></td>
                                    <td><?php echo $product->category_name ?></td>
                                    <td>
                                        <a href="?act=EditProduct&id=<?php echo $product->product_id ?>" 
                                           class="btn btn-warning btn-sm">Sửa</a>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="confirmDeleted('?act=DeleteProduct&id=<?php echo $product->product_id ?>')">
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
                        <?php 
                            if(isset($totalPages)){
                                for ($i = 1; $i <= $totalPages; $i++)
                                {
                                    ?>
                                        <li class="page-item <?php echo $i == $currentPage ? 'active' : '' ?>">
                                            <a class="page-link" href="?act=ListProduct&page=<?php echo $i ?>&category=<?php echo isset($_GET['category']) ? $_GET['category'] : '' ?>">
                                                <?php echo $i ?>
                                            </a>
                                        </li>
                                    <?php
                                }
                            }
                            ?>
                    </ul>
                </nav>


 <!--ACTION  --> 
            <div class="d-flex justify-content-between mt-3">
            <div>
                <button type="button" class="btn btn-outline-secondary" onclick="selectAll()">Chọn tất cả</button>
                <button type="button" class="btn btn-outline-secondary" onclick="deselectAll()">Bỏ chọn tất cả</button>
            </div>
            <div>
                <button
                class="btn btn-danger"
                onclick="confirmDeleted('?act=DeleteSelectedProduct')"
                type="submit"
                name="btn-delSelected"
                >
                Xóa các mục đã chọn
                </button>
                <a href="?act=AddProducts" class="btn btn-primary">Nhập thêm</a>
            </div>
            </div>
        </form>
        </div>
    </div>

    

    
</body>
</html>

