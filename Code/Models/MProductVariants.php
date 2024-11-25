<?php
require_once 'connectDB.php';

class ProductsVariants
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariants($id,$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku)
    {
        $sql = 'INSERT INTO productvariants VALUES (?,?,?,?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku]);
        return $this -> connect -> lastInsertId(); // lấy id sản phẩm vừa thêm
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
        $sql = 'SELECT productvariants.*, products.name AS product_name, sizes.name AS size_name, colors.name AS color_name FROM productvariants
                JOIN products on productvariants.product_id = products.product_id
                JOIN colors on productvariants.color_id = colors.color_id
                JOIN product_variant_sizes on productvariants.product_variant_id = product_variant_sizes.product_variant_id
                JOIN sizes on product_variant_sizes.size_id = sizes.size_id
                ORDER BY product_variant_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function getDataProductVariantByProductIdWithPagination($product_id,$offset,$perPage)
    {
        $sql = 'SELECT productvariants.*, products.name AS product_name, sizes.name AS size_name, colors.name AS color_name FROM productvariants
                JOIN products on productvariants.product_id = products.product_id
                JOIN colors on productvariants.color_id = colors.color_id
                JOIN product_variant_sizes on productvariants.product_variant_id = product_variant_sizes.product_variant_id
                JOIN sizes on product_variant_sizes.size_id = sizes.size_id
                WHERE products.product_id ' . (int)$product_id . 
                ' ORDER BY product_variant_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
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


    public function editProductVariants($product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$product_variant_id)
    {
        $sql = 'UPDATE `productvariants` SET `product_id`= ?,`price`= ?,`price_coupon`= ?,`start_date`= ?,`end_date`= ?,`quantity`= ?,`color_id`= ?,`sku`= ?WHERE `product_variant_id` = ? ';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$product_variant_id]);
    }
}
?>