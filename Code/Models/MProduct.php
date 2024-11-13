<?php
require_once 'connectDB.php';

class Products
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProduct()
        {
            $sql = 'INSERT INTO  VALUES ()';
            $this -> connect -> setQuery($sql);
            $this -> connect -> execute([]);
        }
}
?>