<?php
require_once 'connectDB.php';

class Categories
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addCategories($id,$name,$des,$parentId)
    {
        $sql = 'INSERT INTO categories VALUES (?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$name,$des,$parentId]);
    }

    public function getDataCategories()
    {
        $sql = 'SELECT * FROM categories';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
}
?>