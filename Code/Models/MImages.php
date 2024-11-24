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

    public function editMainImage($link,$product_variant_id)
    {
        $sql = 'UPDATE `images` SET `link`= ? WHERE product_variant_id = ? AND album = 1';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$link,$product_variant_id]);
    }

    public function editAlbumImage($link,$product_variant_id)
    {
        $sql = 'UPDATE `images` SET `link`= ? WHERE product_variant_id = ? AND album = 0';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$link,$product_variant_id]);
    }

    public function deleteAlbumImagesByVariantId($product_variant_id)
    {
        $sql = 'DELETE FROM `images` WHERE `product_variant_id` = ? AND `album` = 0';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_variant_id]);
    }

    public function getMainImageById($product_variant_id)
    {
        $sql = 'SELECT * FROM `images` WHERE product_variant_id = ? AND album = 1';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_variant_id],false);
    }

    public function getAlbumImageById($product_variant_id)
    {
        $sql = 'SELECT * FROM `images` WHERE product_variant_id = ? AND album = 0';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_variant_id]);
    }

}
?>