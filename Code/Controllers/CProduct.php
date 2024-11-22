<?php
require_once './Models/MProduct.php';
require_once './Models/MBrand.php';
require_once './Models/MCategories.php';
require_once './Models/MProductCategories.php';

class CProduct{
    public $connect;

    public function __construct()
    {
        $this -> connect = new Products();
    }

    public function InsertProducts(){
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mBrand = new Brands();
        $mCategories = new Categories();
        $currentDate = date("Y-m-d H:i:s");
        $listBrand = $mBrand -> getDataBrands();
        $listCategories = $mCategories -> getDataCategories();
        if(isset($_POST['add_Product']))
        {
            if(isset($_POST['product_name'])
            && isset($_POST['description'])
            && isset($_POST['brand_id'])
            && isset($_POST['category_id']))
            {
                $amount = $_POST['totalProducts'];
                for($i = 0; $i < $_POST['totalProducts']; $i++){
                    // Thêm sản phẩm vào bảng product
                    $lastInsertId = $mProduct -> addProduct('',$_POST['brand_id'][$i],$_POST['product_name'][$i],$_POST['description'][$i],'active',$currentDate);
                    // Thêm sản phẩm vào bảng product_categories
                    $mProductCategories->addProductCategories((int)$lastInsertId, $_POST['category_id'][$i]);
                }
            }
        }
        include_once 'Views/Admin/Product/addProduct.php';
    }

    public function UpdateProduct()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProduct = new Products();
            $mProductCategories = new ProductCategories();
            $mBrand = new Brands();
            $mCategories = new Categories();
            $currentDate = date("Y-m-d H:i:s");
            $listBrand = $mBrand -> getDataBrands();
            $listCategories = $mCategories -> getDataCategories();
            $listProById = $mProduct -> getDataProductById($id);
            $listProductCategoryById = $mProductCategories -> getProductCategoryById($id);
            if(isset($_POST['edit_Product']))
            {
                if(isset($_POST['product_name'])
                && isset($_POST['description'])
                && isset($_POST['brand_id'])
                && isset($_POST['category_id']))
                {
                        $mProduct -> editProduct($_POST['brand_id'],$_POST['product_name'],$_POST['description'],'active',$currentDate,$id);
                        $mProductCategories->editProductCategories($_POST['category_id'],$id);
                    }
            }
        }
        include_once 'Views/Admin/Product/editProduct.php';

    }

    public function ListProduct()
    {
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mBrand = new Brands();
        $mCategories = new Categories();
        $currentDate = date("Y-m-d H:i:s");
        $listBrand = $mBrand -> getDataBrands();
        $listCategories = $mCategories -> getDataCategories();
        $listProduct = $mProduct -> getDataProduct();

        include_once 'Views/Admin/Product/listProduct.php';
    }
        
    public function DeleteSelectedProduct()
    {
        if(isset($_POST['btn-delSelected']))
        {
            // echo '1';
            // die();
            $mProductCategories = new ProductCategories();
            $mProduct = new Products();
            $deletedItems = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            foreach ($deletedItems as $deletedItem)
            {
                $mProductCategories -> deleteProductCategories($deletedItem);
                $mProduct -> deleteProduct($deletedItem);
                // header('Location: index.PHP?act=ListProduct');
                // echo 'success';
            }
        }
    }

    public function DeleteProduct()
    {
        if(isset($_GET['id']))
        {
            $mProduct = new Products();
            $mProductCategories = new ProductCategories();
            $id = $_GET['id'];
            $mProductCategories -> deleteProductCategories($id);
            $mProduct -> deleteProduct($id);
            header('Location: index.PHP?act=ListProduct');
        }
        include_once 'Views/Admin/Brand/listProduct.php';
    }
}
?>  