
<?php

// require_once 'connectDB.php';

class user{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function getAllUser(){
        $sql = 'SELECT * FROM `users`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }


    public function setInsertDataUser($user_id,$user_name,$password,$email,$phone,$address,$role,$status,$create_at){
        $sql = 'INSERT INTO `users` VALUES (?,?,?,?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$user_id,$user_name,$password,$email,$phone,$address,$role,$status,$create_at]);
    }


    public function setInsertComment($review_id,$user_id,$product_id,$rating,$comment,$create_at){
        $sql = 'INSERT INTO `reviews` VALUES (?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$review_id,$user_id,$product_id,$rating,$comment,$create_at]);
    }




}
