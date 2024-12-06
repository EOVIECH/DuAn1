
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>LIST BRAND</title>
</head>
<body>
<?php require_once 'Components/Admin/navbar.php' ?>
<div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Brand List</h4>
                        <p class="mb-0">Use brand list as to describe your overall core business from the provided list. <br>
                        Click the name of the category where you want to add a list item. .</p>
                    </div>
                    <a href="?act=AddBrand" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Brand</a>
                </div>
            </div>
            <div class="col-lg-12">
                <form action="?act=DeleteSelectedBrand" method="post">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <!-- <input type="checkbox" class="checkbox-input" id="checkbox1"> -->
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>ID Brand</th>
                                <th>Name Brand</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            <?php
                            foreach($listBrand as $brand)
                            {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="checkbox d-inline-block">
                                                <input type="checkbox" name="checkboxes[]" value="<?php echo $brand -> brand_id  ?>" class="checkbox" id="checkbox2">
                                                <label for="checkbox2" class="mb-0"></label>
                                            </div>
                                        </td>
                                        <td class="id"><?php echo $brand -> brand_id  ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img style="width: 50px;"  src="<?php echo $brand -> image ?>" class="img-fluid" alt="image">
                                                <div>
                                                    <?php echo $brand -> name ?>
                                                    <!-- <p class="mb-0"><small>This is test Product</small></p> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="descrip"><?php echo $brand -> description ?></td>
                                        <td class="status"><?php echo $brand -> status ?></td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <!-- <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                    href="#"><i class="ri-eye-line mr-0"></i></a> -->
                                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                    href="?act=EditBrand&id=<?php echo $brand -> brand_id ?>"><i class="ri-pencil-line mr-0"></i></a>
                                                <!-- <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                    href="#" onclick="confirmDeleted('?act=DeleteBrand&id=<?php echo $brand -> brand_id?>')"><i class="ri-delete-bin-line mr-0"></i></a> -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <!-- <button type="button" class="btn btn-primary mr-2" onclick="selectAll()">Chọn tất cả</button>
                        <button type="button"  class="btn btn-primary mr-2" onclick="deselectAll()">Bỏ chọn tất cả</button>
                        <button class="btn btn-primary" onclick="confirmDeleted('?act=DeleteSelectedBrand')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button> -->
                        <button style="margin-left: 10px;" class="btn btn-primary" type="button"><a style="color: white;" href="?act=AddBrand">Nhập thêm</a></button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
        <!-- Page end  -->
    </div>
</body>
</html>

