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


    public function editProductVariants($product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$product_variant_id)
    {
        $sql = 'UPDATE `productvariants` SET `product_id`= ?,`price`= ?,`price_coupon`= ?,`start_date`= ?,`end_date`= ?,`quantity`= ?,`color_id`= ?,`sku`= ?WHERE `product_variant_id` = ? ';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$sku,$product_variant_id]);
    }
}
?>