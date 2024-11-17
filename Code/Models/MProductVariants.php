<?php
require_once 'connectDB.php';

class ProductsVariants
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariants($id,$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$size_id)
        {
            $sql = 'INSERT INTO productvariants VALUES (?,?,?,?,?,?,?,?,?)';
            $this -> connect -> setQuery($sql);
            $this -> connect -> execute([$id,$product_id,$price,$price_coupon,$start_date,$end_date,$quantity,$color_id,$size_id]);
        }
}
?>