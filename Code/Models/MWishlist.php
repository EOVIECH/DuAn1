<?php
require_once 'connectDB.php';
class Wishlist
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addWishlist($wishlist_id,$user_id,$product_variant_id,$status,$product_id)
    {
        $sql = 'INSERT INTO wishlist VALUES (?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$wishlist_id,$user_id,$product_variant_id,$status,$product_id]);
    }

    public function getVariant($size,$product_id,$color_id)
    {
        $sql = 'SELECT productvariants.product_variant_id AS variant_id FROM `productvariants` 
        JOIN product_variant_sizes ON productvariants.product_variant_id = product_variant_sizes.product_variant_id 
        JOIN sizes ON product_variant_sizes.size_id = sizes.size_id
        WHERE sizes.size_id = ?
        AND productvariants.product_id = ? 
        AND productvariants.color_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$size,$product_id,$color_id]);
    }

    public function delWishList($status,$id)
    {
        $sql = 'UPDATE `wishlist` SET `status`= ? WHERE wishlist.wishlist_id = ?;';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$status,$id]);
    }

    public function getSku($id)
    {
        $sql = 'SELECT productvariants.sku FROM productvariants WHERE productvariants.product_variant_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id]);
    }
}

?>