<?php
require_once 'connectDB.php';

class Discounts
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getDiscountByCode($code)
    {
        $sql = 'SELECT * FROM discount_codes WHERE code = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$code],false);
    }

    public function decreaseUsageLimit($code)
    {
        $sql = 'UPDATE discount_codes 
            SET usage_limit = usage_limit - 1 
            WHERE code = ? AND usage_limit > 0';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$code]);
    }

    public function increaseUsedCount($code)
    {
        $sql = 'UPDATE discount_codes 
            SET used_count =  used_count + 1 
            WHERE code = ? AND usage_limit > 0';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$code]);
    }
}
?>