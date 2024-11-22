
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>LIST Category</title>
</head>
<body>
    <div class="title">
        QUẢN LÝ Category
    </div>

    <form action="?act=DeleteSelectedCategory" method="post">
        <div class="list" border=1>
            
            <table>
                <tr class="title-table" style="background-color: rgba(172, 255, 47, 0.589);">
                    <th></th>
                    <th>MÃ Danh Muc</th>
                    <th>TÊN Danh Muc</th>
                    <th>MIÊU TẢ</th>
                    <th>Danh muc cha </th>
                    <th></th>
                </tr>


                <?php
                    foreach($listCategories as $category)
                    {
                        ?>
                        <tr>
                            <td class="btn-check"><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $category -> category_id  ?>"></td>
                            <td class="id"> <?php echo $category -> category_id  ?> </td>
                            <td class="name"> <?php echo $category -> name ?> </td>
                            <td class="descrip"> <?php echo $category -> description ?> </td>
                            <td class="parentId"> <?php
                                                    if($category -> parent_category_id == null)
                                                    {
                                                        echo 'No chinh la danh muc cha';
                                                    }else
                                                    {
                                                        $listCategoryById = $mCategories -> getDataCategoryById($category -> parent_category_id);
                                                        echo $listCategoryById -> name;
                                                    }
                                                     
                                                     ?> </td>
                            <td class="btn-setting-delete">
                                <button type="button"><a href="?act=EditCategory&id=<?php echo $category -> category_id ?>">SỬA</a></button>
                                <button type="button" onclick="confirmDeleted('?act=DeleteCategory&id=<?php echo $category -> category_id?>')">XOÁ</button>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>


        <div class="btn-func">
            <button type="button" onclick="selectAll()">Chọn tất cả</button>
            <button type="button" onclick="deselectAll()">Bỏ chọn tất cả</button>
            <button onclick="confirmDeleted('?act=DeleteSelectedCategory')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button>
            <button type="button"><a href="?act=AddCategories">Nhập thêm</a></button>
        </div>

    </form>

</body>
</html>

