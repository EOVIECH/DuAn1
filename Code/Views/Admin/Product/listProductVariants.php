
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CODE/Views/CSS/./ListProducts.CSS">
    <title>LIST Product Variant</title>
</head>
<body>
    <div class="title">
        QUẢN LÝ Product Variant
    </div>

    <form action="?act=DeleteSelectedProductVariant" method="post">
        <div class="list" border=1>
            
            <table>
                <tr class="title-table" style="background-color: rgba(172, 255, 47, 0.589);">
                    <th></th>
                    <th>MÃ San Pham Bien The</th>
                    <th>Ten San Pham</th>
                    <th>Gia</th>
                    <th>Gia duoc giam</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Quantity</th>
                    <th>Color</th>
                    <th>Sku</th>
                    <th>Size</th>
                    <th></th>
                </tr>


                <?php
                    foreach($listProductVariants as $variant)
                    {
                        ?>
                        <tr>
                            <td class="btn-check"><input type="checkbox" class="checkbox" name="checkboxes[]" value="<?php echo $variant -> product_variant_id  ?>"></td>
                            <td class="id"> <?php echo $variant -> product_variant_id  ?> </td>
                            <td class="product_name"> <?php echo $variant -> product_name ?> </td>
                            <td class="price"> <?php echo $variant -> price ?> </td>
                            <td class="priceCoupon"> <?php echo $variant -> price_coupon ?> </td>
                            <td class="startDate"> <?php echo $variant -> start_date ?> </td>
                            <td class="endDate"> <?php echo $variant -> end_date ?> </td>
                            <td class="quantity"> <?php echo $variant -> quantity ?> </td>
                            <td class="color_name"> <?php echo $variant -> color_name ?> </td>
                            <td class="sku"> <?php echo $variant -> sku ?> </td>
                            <?php
                                $found = false;
                                foreach($listProductVariantSize as $variantSize)
                                {
                                    if($variantSize -> product_variant_id == $variant -> product_variant_id)
                                    {
                                        $found = true;
                                        ?>
                                            <td class="size"> <?php echo $variantSize -> sizes ?> </td>  
                                        <?php
                                        break;
                                    }
                                }
                                if(!$found)
                                {
                                    ?>
                                        <td class="size"> <?php echo 'KHONG CO' ?> </td> 
                                    <?php
                                }
                                
                            ?>
                            <td class="btn-setting-delete">
                                <button type="button"><a href="?act=EditProductVariant&id=<?php echo $variant -> product_variant_id ?>">SỬA</a></button>
                                <button type="button" onclick="confirmDeleted('?act=DeleteProduct&id=<?php echo $variant -> product_variant_id?>')">XOÁ</button>
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
            <button onclick="confirmDeleted('?act=DeleteSelectedProductVariant')" type="submit" name="btn-delSelected">Xoá các mục đã chọn</button>
            <button type="button"><a href="?act=AddProductVariants">Nhập thêm</a></button>
        </div>

    </form>

</body>
</html>

