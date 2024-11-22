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
        $sql = 'SELECT 
                products.*,
                brands.name AS brand_name
            FROM 
                products
            JOIN 
                brands
            ON 
                products.brand_id = brands.brand_id;';
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
    public function editProduct($brand_id,$name,$des,$status,$created_at,$id)
    {
        $sql = 'UPDATE `products` SET `brand_id`= ? ,`name`= ? ,`description`= ? ,`status`= ? ,`created_at`= ? WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$brand_id,$name,$des,$status,$created_at,$id]);
    }
    public function deleteProduct($id)
    {
        $sql = 'DELETE FROM `products` WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id]);
    }
}
?>