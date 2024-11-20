<?php
require_once 'connectDB.php';

class Products
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDataProduct()
    {
        $sql = 'SELECT * FROM products';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function getDataProductById($id)
    {
        $sql = 'SELECT * FROM products WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id],false);
    }

    public function addProduct($id,$brand_id,$name,$des,$status,$created_at)
    {
        $sql = 'INSERT INTO products VALUES (?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$brand_id,$name,$des,$status,$created_at]);
        return $this -> connect -> lastInsertId(); // lấy id sản phẩm vừa thêm
    }
}
?>