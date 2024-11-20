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
}
?>