<?php
require_once 'connectDB.php';

class ProductsVariants
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariants($id, $product_id, $price, $price_coupon, $start_date, $end_date, $quantity, $color_id, $sku, $status)
    {
        // Kiểm tra nếu biến thể với màu đã tồn tại
        if ($this->checkDuplicateColor($product_id, $color_id)) {
             // Lưu thông báo lỗi vào session
            $_SESSION['error_message'] = 'Biến thể với màu này đã tồn tại!';
            // Chuyển hướng về trang thêm sản phẩm
            header('Location: index.php?act=AddProductVariants');
            exit;
        }

        $sql = 'INSERT INTO productvariants VALUES (?,?,?,?,?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$id, $product_id, $price, $price_coupon, $start_date, $end_date, $quantity, $color_id, $sku, $status]);
        return $this->connect->lastInsertId();
    }

    public function checkDuplicateColor($product_id, $color_id)
    {
        $sql = 'SELECT COUNT(*) FROM productvariants WHERE product_id = ? AND color_id = ?';
        $this->connect->setQuery($sql);
        $result = $this->connect->execute([$product_id, $color_id]);
        return $result->fetchColumn() > 0; // True nếu đã tồn tại
    }

    public function listProductVariant()
    {
        $sql = 'SELECT productvariants.*, products.name AS product_name, colors.name AS color_name FROM productvariants
                JOIN products on productvariants.product_id = products.product_id
                JOIN colors on productvariants.color_id = colors.color_id';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function listProductVariantById($id)
    {
        $sql = 'SELECT * FROM `productvariants` WHERE product_variant_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id],false);
    }

    public function getDataProductVariantWithPagination($offset,$perPage)
    {
                $sql = 'SELECT 
            productvariants.product_variant_id,
            productvariants.product_id,
            productvariants.price,
            productvariants.price_coupon,
            productvariants.start_date,
            productvariants.end_date,
            productvariants.quantity,
            productvariants.color_id,
            productvariants.sku,
            productvariants.status,
            products.name AS product_name,
            colors.name AS color_name,
            GROUP_CONCAT(sizes.name ORDER BY sizes.size_id ASC SEPARATOR ", ") AS size_names
            FROM 
                productvariants
            JOIN 
                products ON productvariants.product_id = products.product_id
            JOIN 
                colors ON productvariants.color_id = colors.color_id
            JOIN 
                product_variant_sizes ON productvariants.product_variant_id = product_variant_sizes.product_variant_id
            JOIN 
                sizes ON product_variant_sizes.size_id = sizes.size_id
            WHERE 
                productvariants.status = "active"
            GROUP BY 
                productvariants.product_variant_id
            ORDER BY 
                product_variant_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function getDataProductVariantByProductIdWithPagination($product_id,$offset,$perPage)
    {
        $sql = 'SELECT 
                productvariants.product_variant_id,
                productvariants.product_id,
                productvariants.price,
                productvariants.price_coupon,
                productvariants.start_date,
                productvariants.end_date,
                productvariants.quantity,
                productvariants.color_id,
                productvariants.sku,
                productvariants.status,
                products.name AS product_name,
                colors.name AS color_name,
                GROUP_CONCAT(sizes.name ORDER BY sizes.size_id ASC SEPARATOR ", ") AS size_names
                FROM 
                    productvariants
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN 
                    colors ON productvariants.color_id = colors.color_id
                JOIN 
                    product_variant_sizes ON productvariants.product_variant_id = product_variant_sizes.product_variant_id
                JOIN 
                    sizes ON product_variant_sizes.size_id = sizes.size_id
                WHERE products.product_id = ? AND productvariants.status = "active" ORDER BY product_variant_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_id]);
    }

    public function countAllProductVariants()
    {
        $sql = "SELECT COUNT(*) AS total FROM productvariants";
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([],false);
    }

    public function countProductVariantsByProductId($productId)
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM productvariants 
                WHERE productvariants.product_id = ?";
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$productId],false);
    }


    public function editProductVariants($product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$status,$product_variant_id)
    {
        $sql = 'UPDATE `productvariants` SET `product_id`= ?,`price`= ?,`price_coupon`= ?,`start_date`= ?,`end_date`= ?,`quantity`= ?,`color_id`= ?,`sku`= ?, `status` =  ? WHERE `product_variant_id` = ? ';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$status,$product_variant_id]);
    }

    public function deleteProductVariant($productVariant_id)
    {
        $sql = 'UPDATE productvariants SET status = "inactive" WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$productVariant_id]);
    }

    public function deleteProductVariantByVariantId($productVariant_id)
    {
        $sql = 'UPDATE productvariants SET status = "inactive" WHERE product_variant_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$productVariant_id]);
    }
}
?>