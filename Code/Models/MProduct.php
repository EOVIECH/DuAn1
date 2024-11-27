<?php
require_once 'connectDB.php';

class Products
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDataProductWithPagination($offset,$perPage)
    {
        $sql = 'SELECT products.*, brands.name as brand_name, categories.name as category_name, categories.category_id FROM products
                JOIN brands on products.brand_id = brands.brand_id
                JOIN productcategories on products.product_id = productcategories.product_id
                JOIN categories on productcategories.category_id = categories.category_id
                WHERE products.status = "active"
                ORDER BY product_id DESC
                LIMIT '. $offset . ',' . $perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }

    public function getDataProductWithPaginationAndName($productName,$offset,$perPage)
    {
        $sql = 'SELECT products.*, brands.name as brand_name, categories.name as category_name, categories.category_id 
            FROM products
            JOIN brands ON products.brand_id = brands.brand_id
            JOIN productcategories ON products.product_id = productcategories.product_id
            JOIN categories ON productcategories.category_id = categories.category_id
            WHERE products.status = "active" AND products.name LIKE ?
            ORDER BY product_id DESC
            LIMIT ' . $offset . ', ' . $perPage;
        $this->connect->setQuery($sql);
        echo $sql;
        return $this->connect->loadData(['%' . $productName . '%']);
    }

    public function getDataProductByCategoryIdWithPagination($category_id,$offset,$perPage)
    {
        $sql = 'SELECT products.*, brands.name as brand_name, categories.name as category_name, categories.category_id FROM products
                JOIN brands on products.brand_id = brands.brand_id
                JOIN productcategories on products.product_id = productcategories.product_id
                JOIN categories on productcategories.category_id = categories.category_id
                WHERE categories.category_id = ? AND products.status = "active" ORDER BY product_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$category_id]);
    }

    public function countAllProducts()
    {
        $sql = 'SELECT COUNT(*) AS total FROM products';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([],false);
    }

    public function countAllProductsByName($productName)
    {
        $sql = 'SELECT COUNT(*) AS total FROM products WHERE products.name LIKE ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData(['%' . $productName . '%'],false);
    }

    public function countProductsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM products 
                JOIN productcategories ON products.product_id = productcategories.product_id
                WHERE productcategories.category_id = ?";
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$categoryId],false);
    }

    public function countAllProductsByNameAndCategoryId($categoryId,$productName)
    {
        $sql = 'SELECT COUNT(*) AS total FROM products
                JOIN productcategories ON products.product_id = productcategories.product_id
                 WHERE productcategories.category_id = ? AND products.name LIKE ?';
        $this -> connect -> setQuery($sql);
        echo $sql;
        return $this -> connect -> loadData([$categoryId,'%' . $productName . '%'],false);
    }

    public function getDataProductByCategoryIdAndNameWithPagination($category_id,$productName,$offset,$perPage)
    {
        $sql = 'SELECT products.*, brands.name as brand_name, categories.name as category_name, categories.category_id FROM products
                JOIN brands on products.brand_id = brands.brand_id
                JOIN productcategories on products.product_id = productcategories.product_id
                JOIN categories on productcategories.category_id = categories.category_id
                WHERE categories.category_id = ? AND products.status = "active" AND products.name LIKE ?
                ORDER BY product_id DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$category_id,'%' . $productName . '%']);
    }

    public function getDataProductById($id)
    {
        $sql = 'SELECT * FROM products WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id],false);
    }

    public function getDataProductByCategoryId($id)
    {
        $sql = 'SELECT products.*, categories.* FROM `products` 
                JOIN productcategories on productcategories.product_id = products.product_id
                JOIN categories on productcategories.category_id = categories.category_id
                WHERE categories.category_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id]);
    }

    public function getDataProduct()
    {
        $sql = 'SELECT * FROM products';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([]);
    }

    public function addProduct($id,$brand_id,$name,$des,$status,$created_at)
    {
        $sql = 'INSERT INTO products VALUES (?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$brand_id,$name,$des,$status,$created_at]);
        return $this -> connect -> lastInsertId(); // lấy id sản phẩm vừa thêm
    }
    
    public function editProduct($brand_id,$name,$des,$status,$created_at,$id)
    {
        $sql = 'UPDATE `products` SET `brand_id`= ? ,`name`= ? ,`description`= ? ,`status`= ? ,`created_at`= ? WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$brand_id,$name,$des,$status,$created_at,$id]);
    }

    public function deleteProduct($product_id)
    {
        $sql = 'UPDATE products SET status = "inactive" WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$product_id]);
    }
}
?>