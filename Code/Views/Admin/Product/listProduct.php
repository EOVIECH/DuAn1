
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>LIST Product</title>
</head>
<body>
    <div class="title">
        QUẢN LÝ Product
    </div>

    <form action="?act=DeleteSelectedProduct" method="post">
        <div class="list" border=1>
            
            <table>
                <tr class="title-table" style="background-color: rgba(172, 255, 47, 0.589);">
                    <th></th>
                    <th>MÃ San Pham</th>
                    <th>Ten Thuong Hieu</th>
                    <th>Ten San Pham</th>
                    <th>Mieu Ta</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Thuoc Danh Muc</th>
                    <th></th>
                </tr>


                <?php
                    foreach($listProduct as $product)
                    {
                        ?>
                        <tr>
                            <td class="btn-check"><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $product -> product_id  ?>"></td>
                            <td class="id"> <?php echo $product -> product_id  ?> </td>
                            <td class="brand_name"> <?php echo $product -> brand_name ?> </td>
                            <td class="name"> <?php echo $product -> name ?> </td>
                            <td class="descrip"> <?php echo $product -> description ?> </td>
                            <td class="status"> <?php echo $product -> status ?> </td>
                            <td class="created_at"> <?php echo $product -> created_at ?> </td>
                            <td class="btn-setting-delete">
                                <button type="button"><a href="?act=EditProduct&id=<?php echo $product -> product_id ?>">SỬA</a></button>
                                <button type="button" onclick="confirmDeleted('?act=DeleteProduct&id=<?php echo $product -> product_id?>')">XOÁ</button>
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
            <button onclick="confirmDeleted('?act=DeleteSelectedProduct')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button>
            <button type="button"><a href="?act=AddProducts">Nhập thêm</a></button>
        </div>

    </form>

</body>
</html>

