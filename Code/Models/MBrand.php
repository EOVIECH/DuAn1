<?php
require_once 'connectDB.php';

class Brands
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addBrand()
        {
            $sql = 'INSERT INTO  VALUES ()';
            $this -> connect -> setQuery($sql);
            $this -> connect -> execute([]);
        }
}
?>