<?php
require_once 'connectDB.php';

class ProductsVariantSize
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariantsSize($id,$size_id)
    {
        $sql = 'INSERT INTO product_variant_sizes VALUES (?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$size_id]);
    }
}
?>