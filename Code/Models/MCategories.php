<?php
require_once 'connectDB.php';

class Categories
{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function addCategories($id,$name,$des,$parentId)
    {
        $sql = 'INSERT INTO categories VALUES (?,?,?,?)';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id,$name,$des,$parentId]);
    }

    public function getDataCategories()
    {
        $sql = 'SELECT * FROM categories';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData();
    }
    public function getDataCategoryById($id)
    {
        $sql = 'SELECT * FROM categories WHERE category_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$id],false);
    }
    public function getDataCategoryByParentCategoryId($parent_category_id)
    {
        $sql = 'SELECT * FROM categories WHERE parent_category_id = ?';
        $this -> connect -> setQuery($sql);
        return $this -> connect -> loadData([$parent_category_id],false);
    }
    public function editCategory($name,$des,$parentId,$id)
    {
        $sql = 'UPDATE `categories` SET `name`= ?,`description`= ?,`parent_category_id`= ? WHERE category_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$name,$des,$parentId,$id]);
    }
    public function deleteCategory($id)
    {
        $sql = 'DELETE FROM `categories` WHERE category_id = ?';
        $this -> connect -> setQuery($sql);
        $this -> connect -> execute([$id]);
    }
}
?>