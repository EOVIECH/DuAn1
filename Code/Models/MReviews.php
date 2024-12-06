<?php

class MReview
{
    public $connect;

    public function __construct()
    {
        $this->connect = new ConnectDB();
    }

    public function setInsertComment($review_id, $user_id, $product_id, $rating, $comment, $create_at,$status)
    {
        $sql = 'INSERT INTO `reviews` VALUES (?,?,?,?,?,?,?)';
        $this->connect->setQuery($sql);
        $this->connect->execute([$review_id, $user_id, $product_id, $rating, $comment, $create_at,$status]);
    }

    public function getIdDataComment($id)
    {
        $sql = 'SELECT * FROM `reviews` WHERE user_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }

    public function getIdDataReview($id)
    {
        $sql = 'SELECT * FROM `reviews` WHERE review_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }


    public function getDataComment()
    {
        $sql = 'SELECT review_id, users.username, products.name, reviews.comment, reviews.created_at , reviews.status FROM reviews INNER JOIN users INNER JOIN products ON reviews.user_id = users.user_id AND reviews.product_id = products.product_id;';
        $this->connect->setQuery($sql);
        return $this->connect->loadData(); 
    }

    public function searchDataComment($content,$name)
    {
        $sql = 'SELECT * FROM `reviews` JOIN users JOIN products ON reviews.product_id = products.product_id AND reviews.user_id = users.user_id WHERE users.username LIKE ? OR products.name LIKE ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$content,$name]);
    }

    public function filterDataComment($create_at)
    {
        $sql = 'SELECT review_id, users.username, products.name, reviews.comment, reviews.created_at , reviews.status FROM `reviews` JOIN users JOIN products ON reviews.product_id = products.product_id AND reviews.user_id = users.user_id WHERE reviews.created_at = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$create_at]);
    }

    public function getIdDataJoin($id)
    {
        $sql = 'SELECT review_id, users.username, products.name, reviews.comment, reviews.created_at , reviews.status FROM reviews INNER JOIN users INNER JOIN products ON reviews.user_id = users.user_id AND reviews.product_id = products.product_id  WHERE review_id = ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }

    public function deleteComment($id)
    {
        $sql = 'DELETE FROM `reviews` WHERE user_id= ?';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }

    public function getRatingComment($product_id)
    {
        $sql = 'SELECT `rating` FROM `reviews` WHERE product_id = ? AND rating IS NOT NULL;';
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id]);
    }

    public function updateStatus($status, $user_id)
    {
        $sql = "UPDATE `reviews` SET `status`=? WHERE `review_id`=?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$status, $user_id]);
    }

    public function feedBack(){
        $sql = 'SELECT users.username, reviews.review_id , reviews.user_id , reviews.product_id, reviews.comment FROM reviews JOIN users ON reviews.user_id = users.user_id WHERE reviews.status = 1;`';
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
}