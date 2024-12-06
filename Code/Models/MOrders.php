<?php
require_once 'connectDB.php';

class Orders
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addOrders($order_id,$user_id,$order_date,$status,$total,$updated_at)
    {
        $sql = 'INSERT INTO orders VALUES(?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$order_id,$user_id,$order_date,$status,$total,$updated_at]);
        return $this->connect->lastInsertId();
    }

    public function addOrderDetails($order_detail_id,$order_id,$product_variant_id,$quantity,$price,$size,$color)
    {
        $sql = 'INSERT INTO orderdetails VALUES(?,?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$order_detail_id,$order_id,$product_variant_id,$quantity,$price,$size,$color]);
    }

    public function addPayments($payment_id,$order_id,$payment_date,$amount,$payment_method,$transaction_id,$status)
    {
        $sql = 'INSERT INTO payments VALUES(?,?,?,?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$payment_id,$order_id,$payment_date,$amount,$payment_method,$transaction_id,$status]);
    }

    public function listOrders($user_id)
    {
        $sql = 'SELECT
					orderdetails.order_detail_id,
                    orderdetails.order_id,
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    orders.order_date,
                    orders.status,
                    payments.status AS payment_status,
                    payments.payment_method,
                    users.address,
                    products.name AS product_name,
                    products.product_id,
                    (orderdetails.quantity * orderdetails.price) AS total_price
                FROM 
                    orderdetails
                JOIN 
                    productvariants ON orderdetails.product_variant_id = productvariants.product_variant_id
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN orders on orderdetails.order_id = orders.order_id
                JOIN users on orders.user_id = users.user_id
                JOIN payments on orders.order_id = payments.order_id
                WHERE users.user_id = ? and orders.status != "canceled"
                
                GROUP BY 
                    orderdetails.order_detail_id, 
                    orderdetails.order_id, 
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name,
                    products.product_id,
                    orderdetails.color,
                    orderdetails.size
                ORDER BY orders.order_date DESC';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$user_id]);
    }

    public function listOrderCanceled($user_id)
    {
        $sql = 'SELECT
					orderdetails.order_detail_id,
                    orderdetails.order_id,
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    orders.order_date,
                    orders.status,
                    payments.status AS payment_status,
                    payments.payment_method,
                    users.address,
                    products.name AS product_name,
                    products.product_id,
                    (orderdetails.quantity * orderdetails.price) AS total_price
                FROM 
                    orderdetails
                JOIN 
                    productvariants ON orderdetails.product_variant_id = productvariants.product_variant_id
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN orders on orderdetails.order_id = orders.order_id
                JOIN users on orders.user_id = users.user_id
                JOIN payments on orders.order_id = payments.order_id
                WHERE users.user_id = ? and orders.status = "canceled"
                
                GROUP BY 
                    orderdetails.order_detail_id, 
                    orderdetails.order_id, 
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name,
                    products.product_id,
                    orderdetails.color,
                    orderdetails.size
                ORDER BY orders.order_date DESC';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$user_id]);
    }

    public function listOrderDetails($order_id)
    {
        $sql = 'SELECT 
                    orderdetails.order_detail_id,
                    orderdetails.order_id,
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name AS product_name,
                    products.product_id,
                    orderdetails.color,
                    orderdetails.size,
                    MIN(images.link) AS link, -- Chọn link ảnh đầu tiên (có thể thay MIN bằng MAX)
                    (orderdetails.quantity * orderdetails.price) AS total_price
                FROM 
                    orderdetails
                JOIN 
                    productvariants ON orderdetails.product_variant_id = productvariants.product_variant_id
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN 
                    images ON productvariants.product_variant_id = images.product_variant_id
                WHERE 
                    orderdetails.order_id = ? AND images.album = 1
                GROUP BY 
                    orderdetails.order_detail_id, 
                    orderdetails.order_id, 
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name,
                    products.product_id,
                    orderdetails.color,
                    orderdetails.size;';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$order_id]);
    }

    public function totalOrder($order_id)
    {
        $sql = 'SELECT 
                    SUM(orderdetails.quantity * orderdetails.price) AS total
                FROM 
                    orderdetails
                WHERE 
                    orderdetails.order_id = ?;';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$order_id],false);
    }
    
    public function getAllOrders()
    {
        $sql = 'SELECT
					orderdetails.order_detail_id,
                    orderdetails.order_id,
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    orders.order_date,
                    orders.status,
                    payments.status AS payment_status,
                    payments.payment_method,
                    users.address,
                    users.username,
                    products.name AS product_name,
                    products.product_id,
                    (orderdetails.quantity * orderdetails.price) AS total_price
                FROM 
                    orderdetails
                JOIN 
                    productvariants ON orderdetails.product_variant_id = productvariants.product_variant_id
                JOIN 
                    products ON productvariants.product_id = products.product_id
                JOIN orders on orderdetails.order_id = orders.order_id
                JOIN users on orders.user_id = users.user_id
                JOIN payments on orders.order_id = payments.order_id
                GROUP BY 
                    orderdetails.order_detail_id, 
                    orderdetails.order_id, 
                    orderdetails.product_variant_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name,
                    products.product_id,
                    orderdetails.color,
                    orderdetails.size
                ORDER BY orders.order_date DESC';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
    
    public function updateOrderStatus($status,$order_id)
    {
        $sql = 'UPDATE orders SET status = ? WHERE order_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$status,$order_id]);
    }

    public function deleteOrder($order_id)
    {
        $sql = 'UPDATE orders SET status = "canceled" WHERE order_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$order_id]);
    }
}
?>