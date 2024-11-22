<?php
require_once './Models/MCategories.php';

class CCategories{
    public $connect;

    public function __construct()
    {
        $this -> connect = new Categories();
    }

    public function InsertCategories()
    {
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


    public function UpdateCategory()
    {
        $id = $_GET['id'];
        if(isset($id))
        {
            $mCategories = new Categories();
            $listCategories = $mCategories -> getDataCategories();
            $listCategoryById = $mCategories -> getDataCategoryById($id);
            $listCategoryByParentId = $mCategories -> getDataCategoryByParentCategoryId($listCategoryById -> parent_category_id);
            if (isset($_POST['edit_Category'])) 
            {
                if (isset($_POST['category_name']) && isset($_POST['description']) && isset($_POST['parent_category_id'])) 
                {
                    if($_POST['parent_category_id'] === 'null')
                    {
                        $mCategories->editCategory($_POST['category_name'], $_POST['description'],null, $id);
                    }else
                    {
                        $mCategories->editCategory($_POST['category_name'], $_POST['description'],$_POST['parent_category_id'], $id);
                    }
                    
                }
            }
            include_once 'Views/Admin/Categories/editCategory.php'; 
        }
    }

    public function ListCategories()
    {
        $mCategories = new Categories();
        $listCategories = $mCategories -> getDataCategories();

        include_once 'Views/Admin/Categories/listCategory.php';
    }

    public function DeleteSelectedCategory()
    {
        $mCategories = new Categories();
        if(isset($_POST['btn-delSelected']))
        {
            $deletedItems = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            foreach ($deletedItems as $deletedItem)
            {
                $mCategories -> deleteCategory($deletedItem);
                header('Location: index.PHP?act=ListCategory');
                // echo 'success';
            }
        }
        include_once 'Views/Admin/Categories/listCategory.php';
    }

    public function DeleteCategory()
    {
        if(isset($_GET['id']))
        {
            $mCategories = new Categories();
            $id = $_GET['id'];
            $mCategories -> deleteCategory($id);
            header('Location: index.PHP?act=ListCategory');
        }
        include_once 'Views/Admin/Categories/listCategory.php';
    }
}
?>