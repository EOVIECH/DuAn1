
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

    public function getEmailUser(){
        $sql = 'SELECT email FROM `users`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function getIdDataUser($id){
        $sql = 'SELECT * FROM `users` WHERE user_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
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

    public function getIdDataComment($id){
        $sql = 'SELECT * FROM `reviews` WHERE user_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
    }

    
    public function getDataComment(){
        $sql = 'SELECT review_id, users.username, products.name, reviews.comment FROM reviews INNER JOIN users INNER JOIN products ON reviews.user_id = users.user_id AND reviews.product_id = products.product_id;';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function updateUser($user_name,$password,$email,$phone,$address,$role,$status,$create_at,$user_id){
        $sql="UPDATE `users` SET `username`=?,`password`=?,`email`=?,`phone`=?,`address`=?,`role`=?,`status`=?,`created_at`=? WHERE `user_id`=?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$user_name,$password,$email,$phone,$address,$role,$status,$create_at,$user_id]);
         }

         public function changePass($password,$user_id){
            $sql="UPDATE `users` SET `password`=? WHERE `user_id`=?";
            $this->connect->setQuery($sql);
            $this->connect->execute([$password,$user_id]);
             }

         public function deleteUser($id){
            $sql = 'DELETE FROM `users` WHERE user_id= ?';
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$id], false);
        }

        public function deleteReview($id){
            $sql = 'DELETE FROM `reviews` WHERE user_id= ?';
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$id], false);
        }

}
