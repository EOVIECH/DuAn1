<?php
require_once 'connectDB.php';

class Carts
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addCart($cart_id,$user_id,$product_variant_id,$quantity,$color,$size)
    {
        $sql = 'INSERT INTO cart VALUES (?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$cart_id,$user_id,$product_variant_id,$quantity,$color,$size]);
    }
    
    public function listCart($user_id)
    {
        $sql = 'SELECT 
                    products.name AS product_name, 
                    images.link, 
                    productvariants.price,
                    productvariants.product_variant_id, 
                    cart.* 
                FROM 
                    cart
                JOIN 
                    productvariants ON cart.product_variant_id = productvariants.product_variant_id
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN 
                    (
                        SELECT 
                            product_variant_id, 
                            MIN(link) AS link 
                        FROM 
                            images 
                        WHERE 
                            album = 1 
                        GROUP BY 
                            product_variant_id
                    ) AS images ON productvariants.product_variant_id = images.product_variant_id
                WHERE 
                    productvariants.status = "active" 
                    AND user_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$user_id]);
    }

    public function listCartById($product_variant_id,$color,$size)
    {
        $sql = 'SELECT * FROM `cart` WHERE product_variant_id = ? AND color = ? AND size = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_variant_id,$color,$size]);
    }

    public function clearCart($user_id)
    {
        $sql = 'DELETE  FROM cart WHERE user_id = ?';
        $this->connect->setQuery($sql);
        $this->connect->execute([$user_id]);
    }

    public function deleteCartById($cart_id)
    {
        $sql = 'DELETE FROM cart WHERE cart_id = ?';
        $this->connect->setQuery($sql);
        $this->connect->execute([$cart_id]);
    }
}
?>