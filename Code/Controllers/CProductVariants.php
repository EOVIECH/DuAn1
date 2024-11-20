<?php
require_once './Models/MProduct.php';
require_once './Models/MProductVariants.php';
require_once './Models/MProductVariantSize.php';
require_once './Models/MColor.php';
require_once './Models/MSize.php';
require_once './Models/MImages.php';


class CProductVariants{
    public $connect;

    public function __construct()
    {
        $this -> connect = new ProductsVariants();
    }

    public function InsertProductVariants(){
        $mProductVariantSize = new ProductsVariantSize();
        $mProductVariants = new ProductsVariants();
        $mProduct = new Products();
        $mColor = new Color();
        $mSize = new Size();
        $mImage = new Image();
        $allDataProduct = $mProduct -> getDataProduct();
        $allDataColor = $mColor -> getDataColor();
        $allDataSize = $mSize -> getDataSize();

        $isValid = true;

        if(isset($_POST['addProductVariants']))
        {
            // Validate dữ liệu kiểm tra đầu vào
            for($i=0;$i<$_POST['totalVariants'];$i++) 
            {
                if(empty($_POST['product_id']) || !is_numeric($_POST['product_id']))
                {
                    die('Sản phẩm không hợp lệ.');
                }
                if(empty($_POST['variant_price'][$i]) ||  $_POST['variant_price'][$i] <= 0)
                {
                    $isValid = false;
                    // echo "Giá của biến thể " . ($i) . " không hợp lệ.<br>";
                }
                if (empty($_POST['variant_sku'][$i])) {
                    $isValid = false;
                    // echo "SKU của biến thể " . ($i) . " không được để trống.<br>";
                }
        
                if (empty($_POST['variant_quantity'][$i]) || $_POST['variant_quantity'][$i] <= 0) {
                    $isValid = false;
                    // echo "Số lượng của biến thể " . ($i) . " không hợp lệ.<br>";
                }
            }
            if($isValid)
            {
                // Thêm sản phẩm biến thể
                for($i=0;$i<$_POST['totalVariants'];$i++)
                {
                    $lastInsertId =  $mProductVariants -> addProductVariants('',$_POST['product_id'],
                                                                $_POST['variant_price'][$i],
                                                                $_POST['variant_priceCoupon'][$i],
                                                                $_POST['variant_start_date'][$i],
                                                                $_POST['variant_end_date'][$i],
                                                                $_POST['variant_quantity'][$i],
                                                                $_POST['variant_color'][$i],
                                                                $_POST['variant_sku'][$i]);
                }

                 // Thêm size sản phẩm
                foreach($_POST['variant_size'] as $index => $size)
                {
                    $mProductVariantSize -> addProductVariantsSize($lastInsertId,$size);
                }
                

                 // Thêm image album
                $validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                $target_dir = 'Images/';
 
                foreach ($_FILES['variant_album_images']['name'] as $index1 => $filesGroup) {
                    foreach ($filesGroup as $index2 => $fileName) {
                        $imageType = $_FILES['variant_album_images']['type'][$index1][$index2];
                        $tmpPath = $_FILES['variant_album_images']['tmp_name'][$index1][$index2];
                        $error = $_FILES['variant_album_images']['error'][$index1][$index2];

                        // Kiểm tra lỗi upload
                        if ($error !== UPLOAD_ERR_OK) {
                            echo "Error uploading file $fileName. Error code: $error";
                            continue;
                        }

                        // Kiểm tra loại file
                        if (!in_array($imageType, $validImageTypes)) {
                            echo "File type for $fileName is not allowed. Only JPEG, PNG, and GIF are accepted.";
                            continue;
                        }

                        // Đặt tên file và lưu vào thư mục
                        $newFileName = time() . '_' . $fileName;
                        $target_path = $target_dir . $newFileName;

                        if (move_uploaded_file($tmpPath, $target_path)) {
                            $mImage -> addImages(null,(int)$lastInsertId,$target_path,0,'active');
                            // echo "File $fileName uploaded successfully to $target_path.<br>";
                        } else {
                            echo "Failed to move file $fileName to $target_path.<br>";
                        }
                    }
                }

                 // Thêm image main
                 
                 foreach ($_FILES['variant_main_image']['name'] as $index1 => $filesName) {
                    $imageType = $_FILES['variant_main_image']['type'][$index1];
                    $tmpPath = $_FILES['variant_main_image']['tmp_name'][$index1];
                    $error = $_FILES['variant_main_image']['error'][$index1];

                    // Kiểm tra lỗi upload
                    if ($error !== UPLOAD_ERR_OK) {
                        echo "Error uploading file $fileName. Error code: $error";
                        continue;
                    }

                    // Kiểm tra loại file
                    if (!in_array($imageType, $validImageTypes)) {
                        echo "File type for $fileName is not allowed. Only JPEG, PNG, and GIF are accepted.";
                        continue;
                    }

                    // Đặt tên file và lưu vào thư mục
                    $newFileName = time() . '_' . $fileName;
                    $target_path = $target_dir . $newFileName;

                    if (move_uploaded_file($tmpPath, $target_path)) {
                        $mImage -> addImages(null,(int)$lastInsertId,$target_path,1,'active');
                        // echo "File $fileName uploaded successfully to $target_path.<br>";
                    } else {
                        echo "Failed to move file $fileName to $target_path.<br>";
                    }
                }

            }
        }
        include_once 'Views/Admin/Product/addProductVariants.php';
    }
}
?>