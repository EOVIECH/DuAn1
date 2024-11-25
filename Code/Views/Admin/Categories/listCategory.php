
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS"> -->
    <title>LIST Category</title>
</head>
<body>

    <?php require_once 'Components/Admin/navbar.php' ?>

    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Category List</h4>
                        <p class="mb-0">Use category list as to describe your overall core business from the provided list. <br>
                        Click the name of the category where you want to add a list item. .</p>
                    </div>
                    <a href="?act=AddCategories" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Category</a>
                </div>
            </div>
            <div class="col-lg-12">
                <form action="?act=DeleteSelectedCategory" method="post">
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
                                <th>ID Category</th>
                                <th>Name Category</th>
                                <th>Description</th>
                                <th>Parent Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            <?php
                            foreach($listCategories as $category)
                            {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="checkbox d-inline-block">
                                                <input type="checkbox" name="checkboxes[]" value="<?php echo $category -> category_id  ?>" class="checkbox" id="checkbox2">
                                                <label for="checkbox2" class="mb-0"></label>
                                            </div>
                                        </td>
                                        <td class="category_id"><?php echo $category -> category_id  ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- <img src="../assets/images/table/product/01.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image"> -->
                                                <div>
                                                    <?php echo $category -> name ?>
                                                    <!-- <p class="mb-0"><small>This is test Product</small></p> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="descrip"><?php echo $category -> description ?></td>
                                        <td class="parentId"><?php
                                                    if($category -> parent_category_id == null)
                                                    {
                                                        echo 'No chinh la danh muc cha';
                                                    }else
                                                    {
                                                        $listCategoryById = $mCategories -> getDataCategoryById($category -> parent_category_id);
                                                        echo $listCategoryById -> name;
                                                    }
                                                     
                                                     ?></td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <!-- <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                    href="#"><i class="ri-eye-line mr-0"></i></a> -->
                                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                    href="?act=EditCategory&id=<?php echo $category -> category_id ?>"><i class="ri-pencil-line mr-0"></i></a>
                                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                    href="#" onclick="confirmDeleted('?act=DeleteCategory&id=<?php echo $category -> category_id?>')"><i class="ri-delete-bin-line mr-0"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mr-2" onclick="selectAll()">Chọn tất cả</button>
                        <button type="button"  class="btn btn-primary mr-2" onclick="deselectAll()">Bỏ chọn tất cả</button>
                        <button class="btn btn-primary" onclick="confirmDeleted('?act=DeleteSelectedCategory')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button>
                        <button style="margin-left: 10px;" class="btn btn-primary" type="button"><a style="color: white;" href="?act=AddCategories">Nhập thêm</a></button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
        <!-- Page end  -->
    </div>
</body>
</html>

