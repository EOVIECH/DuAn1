<?php
require_once 'connectDB.php';

class Color
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDataColor()
    {
        $sql = 'SELECT * FROM colors';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
}
?>