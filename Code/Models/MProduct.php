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
                 WHERE productcategories.category_id = ?  AND products.name LIKE ? AND products.status = "active"?';
        $this -> connect -> setQuery($sql);
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

    public function getProductNewest()
    {
        $sql = 'SELECT products.*, images.album, images.link, MIN(price) AS min_price, MAX(price) AS max_price FROM productvariants 
                JOIN products on productvariants.product_id = products.product_id 
                JOIN images on productvariants.product_variant_id = images.product_variant_id
                WHERE productvariants.status = "active" AND images.album = 1
                GROUP BY product_id 
                ORDER BY created_at DESC LIMIT 12';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([]);
    }   

    public function getRelatedProduct($product_id)
    {
        $sql = 'SELECT 
                products.*, 
                images.album, 
                images.link, 
                MIN(productvariants.price) AS min_price, 
                MAX(productvariants.price) AS max_price 
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN images ON productvariants.product_variant_id = images.product_variant_id
                JOIN productcategories ON products.product_id = productcategories.product_id
                WHERE productvariants.status = "active" 
                    AND images.album = 1
                    AND productcategories.category_id IN (
                        SELECT category_id 
                        FROM productcategories 
                        WHERE product_id = ' . $product_id . ' -- ID của sản phẩm hiện tại
                    )
                    AND products.product_id != ' . $product_id . ' -- Loại bỏ sản phẩm hiện tại
                GROUP BY products.product_id
                ORDER BY products.created_at DESC 
                LIMIT 4;';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([]);
    }   

    public function getColorAvailableInProduct($product_id)
    {
        $sql = 'SELECT colors.* FROM `productvariants`
                JOIN colors on productvariants.color_id = colors.color_id
                WHERE product_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_id]);
    }   

    public function getDataProductDetails($product_id)
    {
        $sql = 'SELECT 
                products.name AS product_name,
                products.product_id,
                products.description,
                colors.color_id,
                colors.color_code,
                productvariants.product_variant_id,
                productvariants.price,
                productvariants.price_coupon,
                productvariants.start_date,
                productvariants.end_date,
                sizes.size_id,
                GROUP_CONCAT(DISTINCT sizes.size_id ORDER BY sizes.size_id ASC) AS available_sizesId,
                GROUP_CONCAT(DISTINCT sizes.name ORDER BY sizes.name ASC) AS available_sizes,
                (SELECT link 
                FROM images 
                WHERE images.product_variant_id = productvariants.product_variant_id 
                AND images.album = 1 
                LIMIT 1) AS primary_image,
                (SELECT 
                    GROUP_CONCAT(link ORDER BY images.image_id ASC) 
                FROM images 
                WHERE images.product_variant_id = productvariants.product_variant_id 
                AND images.album = 0) AS secondary_images
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN colors ON productvariants.color_id = colors.color_id
                JOIN product_variant_sizes ON productvariants.product_variant_id = product_variant_sizes.product_variant_id
                JOIN sizes ON product_variant_sizes.size_id = sizes.size_id
                LEFT JOIN images ON productvariants.product_variant_id = images.product_variant_id
                WHERE productvariants.status = "active" 
                AND products.product_id = ?
                GROUP BY products.product_id, colors.color_id, productvariants.product_variant_id
                LIMIT 1;
            ';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_id]);
    }  
    
    public function getDataProductDetailsWithColorId($product_id,$color_id)
    {
        $sql = 'SELECT 
                products.name AS product_name,
                products.product_id,
                products.description,
                colors.color_id,
                colors.color_code,
                productvariants.product_variant_id,
                productvariants.price,
                productvariants.price_coupon,
                productvariants.start_date,
                productvariants.end_date,
                sizes.size_id,
                GROUP_CONCAT(DISTINCT sizes.size_id ORDER BY sizes.size_id ASC) AS available_sizesId,
                GROUP_CONCAT(DISTINCT sizes.name ORDER BY sizes.name ASC) AS available_sizes,
                (SELECT link 
                FROM images 
                WHERE images.product_variant_id = productvariants.product_variant_id 
                AND images.album = 1 
                LIMIT 1) AS primary_image,
                (SELECT 
                    GROUP_CONCAT(link ORDER BY images.image_id ASC) 
                FROM images 
                WHERE images.product_variant_id = productvariants.product_variant_id 
                AND images.album = 0) AS secondary_images
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN colors ON productvariants.color_id = colors.color_id
                JOIN product_variant_sizes ON productvariants.product_variant_id = product_variant_sizes.product_variant_id
                JOIN sizes ON product_variant_sizes.size_id = sizes.size_id
                LEFT JOIN images ON productvariants.product_variant_id = images.product_variant_id
                WHERE productvariants.status = "active" AND products.product_id = ? AND colors.color_id = ?
                GROUP BY products.product_id, colors.color_id, productvariants.product_variant_id
                LIMIT 1
            ';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$product_id,$color_id]);
    }   
    public function countAllShop()
    {
        $sql = 'SELECT COUNT(*) AS total FROM products WHERE status = "active"';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([],false);
    }

    public function countAllShopByName($productName)
    {
        $sql = 'SELECT COUNT(*) AS total FROM products WHERE products.name LIKE ? AND products.status = "active"';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData(['%' . $productName . '%'],false);
    }

    public function countShopByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM products 
                JOIN productcategories ON products.product_id = productcategories.product_id
                WHERE productcategories.category_id = ? AND products.status = 'active'";
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$categoryId],false);
    }
    public function countAllShopByNameAndCategoryId($categoryId,$productName)
    {
        $sql = 'SELECT COUNT(*) AS total FROM products
                JOIN productcategories ON products.product_id = productcategories.product_id
                 WHERE productcategories.category_id = ?  AND products.name LIKE ? AND products.status = "active"?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$categoryId,'%' . $productName . '%'],false);
    }

    public function getDataShopByCategoryIdAndNameWithPagination($category_id,$productName,$offset,$perPage)
    {
         

        $sql = 'SELECT 
                    products.*, 
                    products.product_id, 
                    images.album, 
                    images.link, 
                    MIN(productvariants.price) AS min_price, 
                    MAX(productvariants.price) AS max_price, 
                    categories.name AS category_name, 
                    categories.category_id 
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN productcategories ON products.product_id = productcategories.product_id
                JOIN categories ON productcategories.category_id = categories.category_id
                JOIN images ON productvariants.product_variant_id = images.product_variant_id
                WHERE products.status = "active" 
                    AND images.album = 1 
                    AND categories.category_id = ?
                    AND products.name LIKE ?
                GROUP BY products.product_id
                ORDER BY products.created_at DESC
                LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$category_id,'%' . $productName . '%']);
    }

    public function getDataShopWithPaginationAndName($productName,$offset,$perPage)
    {
        $sql = 'SELECT 
                    products.*, 
                    products.product_id, 
                    images.album, 
                    images.link, 
                    MIN(productvariants.price) AS min_price, 
                    MAX(productvariants.price) AS max_price
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN images ON productvariants.product_variant_id = images.product_variant_id
                WHERE products.status = "active" 
                    AND images.album = 1 
                    AND products.name LIKE ?
                GROUP BY products.product_id
                ORDER BY products.created_at DESC 
                LIMIT ' . $offset . ', ' . $perPage;
        $this->connect->setQuery($sql);
        return $this->connect->loadData(['%' . $productName . '%']);
    }

    public function getDataShopByCategoryIdWithPagination($category_id,$offset,$perPage)
    {
        $sql = 'SELECT 
                products.*, 
                products.product_id, 
                images.album, 
                images.link, 
                MIN(productvariants.price) AS min_price, 
                MAX(productvariants.price) AS max_price,
                categories.name as category_name, categories.category_id
            FROM productvariants
            JOIN products ON productvariants.product_id = products.product_id
            JOIN images ON productvariants.product_variant_id = images.product_variant_id
            JOIN productcategories on products.product_id = productcategories.product_id
            JOIN categories on productcategories.category_id = categories.category_id
            WHERE products.status = "active" 
                AND images.album = 1 
                AND categories.category_id = ?  
            GROUP BY products.product_id
            ORDER BY products.created_at DESC LIMIT '. (int)$offset . ',' . (int)$perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$category_id]);
    }

    public function getDataShopWithPagination($offset,$perPage)
    {
        $sql = 'SELECT 
                    products.*, 
                    products.product_id, 
                    images.album, 
                    images.link, 
                    MIN(productvariants.price) AS min_price, 
                    MAX(productvariants.price) AS max_price,
                    categories.name as category_name, categories.category_id
                FROM productvariants
                JOIN products ON productvariants.product_id = products.product_id
                JOIN images ON productvariants.product_variant_id = images.product_variant_id
                JOIN productcategories on products.product_id = productcategories.product_id
                JOIN categories on productcategories.category_id = categories.category_id
                WHERE products.status = "active" 
                    AND images.album = 1 
                GROUP BY products.product_id
                ORDER BY products.created_at DESC 
                LIMIT '. $offset . ',' . $perPage;
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
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