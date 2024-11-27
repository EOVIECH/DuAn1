<?php
require_once 'connectDB.php';

class Brands
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addBrand($id,$name,$des,$img,$status)
    {
        $sql = 'INSERT INTO brands VALUES (?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$name,$des,$img,$status]);
    }
    public function getDataBrands()
    {
        $sql = 'SELECT * FROM brands';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
    public function getDataBrandsById($id)
    {
        $sql = 'SELECT * FROM brands WHERE brand_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id],false);
    }
    public function editBrand($name,$des,$img,$status,$id)
    {
        $sql = 'UPDATE `brands` SET `name`= ?,`description`= ?,`image`= ?,`status`= ? WHERE brand_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$name,$des,$img,$status,$id]);
    }
    // public function deleteBrand($id)
    // {
    //     $sql = 'DELETE FROM `brands` WHERE brand_id= ?';
    //     $this -> connect -> setQuery($sql);
    //     $this -> connect -> execute([$id]);
    // }
}
?>