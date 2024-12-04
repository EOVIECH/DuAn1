<?php
require_once 'connectDB.php';

class ProductsVariantSize
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addProductVariantsSize($id,$size_id)
    {
        $sql = 'INSERT INTO product_variant_sizes VALUES (?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$size_id]);
    }

    public function editProductVariantsSize($size_id, $product_variant_id)
    {
        $sql = 'UPDATE `product_variant_sizes` SET `size_id`= ? WHERE product_variant_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$size_id, $product_variant_id]);
    }

    public function deleteProductVariantsSize($product_variant_id)
    {
        $sql = 'DELETE FROM product_variant_sizes WHERE product_variant_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_variant_id]);
    }

    public function ListProductVariantsSize()
    {
        $sql = 'SELECT GROUP_CONCAT(sizes.name SEPARATOR ", ") AS sizes, product_variant_sizes.product_variant_id from product_variant_sizes JOIN sizes on product_variant_sizes.size_id = sizes.size_id GROUP BY product_variant_sizes.product_variant_id;';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function ListProductVariantsSizeById($id)
    {
        $sql = 'SELECT * from product_variant_sizes WHERE product_variant_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id]);
    }
}
?>