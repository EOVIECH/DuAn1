<?php
require_once './Models/MCategories.php';

class CCategories{
    public $connect;

    public function __construct()
    {
        $this -> connect = new Categories();
    }

    public function InsertCategories(){
        $mCategories = new Categories();
        $listCategories = $mCategories -> getDataCategories();
        if(isset($_POST['categories_name']) && strlen(trim($_POST['categories_name'])) > 3 
        && isset($_POST['description']) && strlen(trim($_POST['description'])) < 200
        && isset($_POST['parent_category'])){
                if($_POST['parent_category'] === 'null')
                {
                    $mCategories -> addCategories('',$_POST['categories_name'],$_POST['description'],null);
                }else
                {
                    $mCategories -> addCategories('',$_POST['categories_name'],$_POST['description'],$_POST['parent_category']);
                }
                
            }
            include_once 'Views/Admin/Categories/addCategories.php';

        }
}

?>