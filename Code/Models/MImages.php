<?php
require_once 'connectDB.php';

class Image
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addImages($image_id,$product_variant_id,$link,$album,$status)
    {
        $sql = 'INSERT INTO `images`(`image_id`, `product_variant_id`, `link`, `album`, `status`) VALUES (?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$image_id,$product_variant_id,$link,$album,$status]);
    }
}
?>