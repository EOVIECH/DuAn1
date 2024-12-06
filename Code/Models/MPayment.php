<?php
require_once 'connectDB.php';

class Payment
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDataPayment()
    {
        $sql = 'SELECT * FROM payments';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
    public function updatePaymentStatus($status,$order_id)
    {
        $sql = 'UPDATE payments SET status = ? WHERE order_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$status,$order_id]);
    }
}
?>  