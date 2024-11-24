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
                if(isset($_FILES['brand_image']) && $_FILES['brand_image']['error'] == UPLOAD_ERR_OK){
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
                        $name_img = time() . '_' .$_FILES['brand_image']['name'];
                        $target_path = $target_dir . $name_img;
                        move_uploaded_file($_FILES['brand_image']['tmp_name'], $target_path);
                        $mBrand -> addBrand('',$_POST['brand_name'],$_POST['description'],$target_path,$_POST['brand_status']);
                    }
                }
            }
        }

        include_once 'Views/Admin/Brand/addBrand.php';
    }

    public function UpdateBrand(){
        $id = $_GET['id'];
        if(isset($id))
        {
            $mBrand = new Brands();
            $listBrandById = $mBrand -> getDataBrandsById($id);
            if (isset($_POST['edit_Brand'])) 
            {
                if (isset($_POST['brand_name']) && isset($_POST['description']) && isset($_POST['brand_status'])) 
                {
                    // Kiểm tra và xử lý ảnh
                    if (isset($_FILES['brand_image']) && $_FILES['brand_image']['error'] == UPLOAD_ERR_OK) 
                    {
                        $validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                        $image_type = $_FILES['brand_image']['type'];
                        if (!in_array($image_type, $validImageTypes)) {
                            echo "File type is not allowed. Only JPEG, PNG, and GIF are accepted.";
                            exit;
                        } else {
                            $target_dir = 'Images/';
                            $name_img = time() . '_' . $_FILES['brand_image']['name'];
                            $target_path = $target_dir . $name_img;
                            move_uploaded_file($_FILES['brand_image']['tmp_name'], $target_path);
                        }
                    } else 
                    {
                        $target_path = $listBrandById->image; // Sử dụng ảnh cũ nếu không tải ảnh mới
                    }
            
                    // Gọi hàm cập nhật
                    $mBrand->editBrand($_POST['brand_name'], $_POST['description'], $target_path, $_POST['brand_status'], $id);
                }
            }
            include_once 'Views/Admin/Brand/editBrand.php'; 
        }
    }

    public function ListBrand(){
        $mBrand = new Brands();
        $listBrand = $mBrand -> getDataBrands();

        include_once 'Views/Admin/Brand/listBrand.php';
    }

    public function DeleteSelectedBrand()
    {
        $mBrand = new Brands();
        if(isset($_POST['btn-delSelected']))
        {
            $deletedItems = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            foreach ($deletedItems as $deletedItem)
            {
                $mBrand -> deleteBrand($deletedItem);
                header('Location: index.PHP?act=ListBrand');
                // echo 'success';
            }
        }
        include_once 'Views/Admin/Brand/listBrand.php';
    }

        public function DeleteBrand()
        {
            if(isset($_GET['id']))
            {
                $mBrand = new Brands();
                $id = $_GET['id'];
                $mBrand -> deleteBrand($id);
                header('Location: index.PHP?act=ListBrand');
            }
            include_once 'Views/Admin/Brand/listBrand.php';
        }
}
?>