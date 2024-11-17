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
}
?>