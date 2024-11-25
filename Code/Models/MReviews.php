<?php

class MReview
{
    public $connect;

    public function __construct()
    {
        $this->connect = new ConnectDB();
    }

    public function setInsertComment($review_id, $user_id, $product_id, $rating, $comment, $create_at)
    {
        $sql = 'INSERT INTO `reviews` VALUES (?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$review_id, $user_id, $product_id, $rating, $comment, $create_at]);
    }

    public function getIdDataComment($id)
    {
        $sql = 'SELECT * FROM `reviews` WHERE user_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }


    public function getDataComment()
    {
        $sql = 'SELECT review_id, users.username, products.name, reviews.comment FROM reviews INNER JOIN users INNER JOIN products ON reviews.user_id = users.user_id AND reviews.product_id = products.product_id;';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function deleteComment($id)
    {
        $sql = 'DELETE FROM `reviews` WHERE user_id= ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
}
