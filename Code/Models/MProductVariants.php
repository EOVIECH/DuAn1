<?php
require_once 'connectDB.php';

class ProductsVariants
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariants()
        {
            $sql = 'INSERT INTO  VALUES ()';
            $this -> connect -> setQuery($sql);
            $this -> connect -> execute([]);
        }
}
?>