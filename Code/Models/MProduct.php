<?php
require_once 'connectDB.php';

class Products
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
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