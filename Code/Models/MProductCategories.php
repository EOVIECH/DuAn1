<?php
require_once 'connectDB.php';

class ProductCategories
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductCategories($productId,$categoryId)
    {
        $sql = 'INSERT INTO productcategories VALUES (?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$productId,$categoryId]);
    }
}
?>