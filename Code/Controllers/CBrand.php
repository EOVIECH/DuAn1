<?php
require_once './Models/MBrand.php';

class CBrand{
    public $connect;

    public function __construct()
    {
        $this -> connect = new Brands();
    }

    public function InsertBrand(){
        $mBrand = new Brands();
        if(isset($_POST['add_Brand'])){
            if(isset($_POST['brand_name'])
             && isset($_POST['description'])
             && isset($_POST['brand_status'])){
                if(isset($_FILES['brand_images']) && $_FILES['brand_images']['error'] == UPLOAD_ERR_OK){
                    $validImageTypes = ['image/jpg','image/png','image/gif'];
                    $images_type = $_FILES['brand_image']['type'];
                    // Function in_array() : searches an array for a specific value
                    if(!in_array($images_type,$validImageTypes))
                    {
                        echo "File type is not allowed. Only JPEG, PNG, and GIF are accepted.";
                        exit;
                    }else
                    {
                        $target_dir = 'Images/';
                        $name_img = time().$_FILES['brand_image']['name'];
                        $target_path = $target_dir . $name_img;
                        move_uploaded_file($_FILES['brand_image']['tmp_name'], $target_path);
                        $mBrand -> addBrand('',$_POST['brand_name'],$_POST['description'],$target_path,$_POST['brand_status']);
                    }
                }
            }
        }

        include_once 'Views/Admin/Brand/addBrand.php';
    }
    
}
?>