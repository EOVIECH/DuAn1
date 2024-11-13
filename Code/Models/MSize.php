<?php
require_once 'connectDB.php';

class Sizes
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addSize()
        {
            $sql = 'INSERT INTO  VALUES ()';
            $this -> connect -> setQuery($sql);
            $this -> connect -> execute([]);
        }
}
?>