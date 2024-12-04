
<?php

// require_once 'connectDB.php';

class MUser
{
    public $connect;

    public function __construct()
    {
        $this->connect = new ConnectDB();
    }

    public function getAllUser()
    {
        $sql = 'SELECT * FROM `users`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function getEmailUser()
    {
        $sql = 'SELECT email FROM `users`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function getIdDataUser($id)
    {
        $sql = 'SELECT * FROM `users` WHERE user_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }


    public function setInsertDataUser($user_id, $username, $password, $email, $phone, $address, $role, $status, $create_at)
    {
        $sql = 'INSERT INTO `users` VALUES (?,?,?,?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$user_id, $username, $password, $email, $phone, $address, $role, $status, $create_at]);
    }

    public function updateUser($user_name, $password, $email, $phone, $address, $role, $status, $create_at, $user_id)
    {
        $sql = "UPDATE `users` SET `username`=?,`password`=?,`email`=?,`phone`=?,`address`=?,`role`=?,`status`=?,`created_at`=? WHERE `user_id`=?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$user_name, $password, $email, $phone, $address, $role, $status, $create_at, $user_id]);
    }

    public function changePass($password, $user_id)
    {
        $sql = "UPDATE `users` SET `password`=? WHERE `user_id`=?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$password, $user_id]);
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM `users` WHERE user_id= ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }

    public function deleteComment_IdUser($id)
    {
        $sql = 'DELETE FROM `reviews` WHERE user_id= ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
}
