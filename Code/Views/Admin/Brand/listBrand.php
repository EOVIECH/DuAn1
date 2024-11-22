
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>LIST BRAND</title>
</head>
<body>
    <div class="title">
        QUẢN LÝ BRAND
    </div>

    <form action="?act=DeleteSelectedBrand" method="post">
        <div class="list" border=1>
            
            <table>
                <tr class="title-table" style="background-color: rgba(172, 255, 47, 0.589);">
                    <th></th>
                    <th>MÃ THƯƠNG HIỆU</th>
                    <th>TÊN THƯƠNG HIỆU</th>
                    <th>MIÊU TẢ</th>
                    <th>IMAGE</th>
                    <th>STATUS</th>
                    <th></th>
                </tr>


                <?php
                    foreach($listBrand as $brand)
                    {
                        ?>
                        <tr>
                            <td class="btn-check"><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $brand -> brand_id  ?>"></td>
                            <td class="id"> <?php echo $brand -> brand_id  ?> </td>
                            <td class="name"> <?php echo $brand -> name ?> </td>
                            <td class="descrip"> <?php echo $brand -> description ?> </td>
                            <td class="image"> <img style="width: 50px;" src="<?php echo $brand -> image ?>" alt=""> </td>
                            <td class="status"> <?php echo $brand -> status ?> </td>
                            <td class="btn-setting-delete">
                                <button type="button"><a href="?act=EditBrand&id=<?php echo $brand -> brand_id ?>">SỬA</a></button>
                                <button type="button" onclick="confirmDeleted('?act=DeleteBrand&id=<?php echo $brand -> brand_id?>')">XOÁ</button>
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
            <button onclick="confirmDeleted('?act=DeleteSelectedBrand')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button>
            <button type="button"><a href="?act=AddBrand">Nhập thêm</a></button>
        </div>

    </form>

</body>
</html>

