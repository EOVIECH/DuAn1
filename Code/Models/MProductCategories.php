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

    public function getProductCategoryById($productId)
    {
        $sql = 'SELECT * FROM `productcategories` WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$productId],false);
    }

    public function editProductCategories($categoryId,$productId)
    {
        $sql = 'UPDATE productcategories SET `category_id`= ? WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$categoryId,$productId]);
    }

    public function deleteProductCategories($productId)
    {
        $sql = 'DELETE FROM productcategories  WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$productId]);
    }

}
?>