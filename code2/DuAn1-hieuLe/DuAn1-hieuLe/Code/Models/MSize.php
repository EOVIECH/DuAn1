<?php
require_once 'connectDB.php';

class Size
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDataSize()
    {
        $sql = 'SELECT * FROM sizes';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
}
?>