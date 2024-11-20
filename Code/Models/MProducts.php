<?php
require_once 'MConnectDB.php';

class product{

    public $connect;

    public function __construct(){
        $this->connect = new connectDB();
    }

    public function getAllDataProduct(){
        $sql = 'SELECT * FROM `products`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }


    public function getIdDataProduct($id){
        $sql = 'SELECT * FROM products WHERE id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
    }

    public function setInsertDataProduct($product_id,$brand_id,$sku,$name,$description,$status,$create_at){
        $sql = 'INSERT INTO products VALUES (?,?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        return $this->connect->execute([$product_id,$brand_id,$sku,$name,$description,$status,$create_at]);
    }

    public function updateProduct($name,$price,$status,$quantity,$image,$id){
   $sql="UPDATE `products` SET `name`=?,`price`=?,`status`=?,`quantity`=?,`image`=? WHERE `id`=?";
   $this->connect->setQuery($sql);
   return $this->connect->execute([$name,$price,$status,$quantity,$image,$id]);
    }
}

?>