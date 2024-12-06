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

    public function getProductCategory()
    {
        $sql = 'SELECT products.*, categories.category_id, categories.name as category_name, categories.description as category_description, categories.parent_category_id FROM `productcategories` JOIN products ON productcategories.product_id = products.product_id JOIN categories ON productcategories.category_id = categories.category_id';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function getProductCategoryByCategoryId($categoryId)
    {
        $sql = 'SELECT products.*, categories.category_id, categories.name as category_name, categories.description as category_description, categories.parent_category_id FROM `productcategories` JOIN products ON productcategories.product_id = products.product_id JOIN categories ON productcategories.category_id = categories.category_id WHERE category_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$categoryId]);
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