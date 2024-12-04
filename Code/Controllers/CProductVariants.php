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
        $err = '';
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
                                                                $_POST['variant_sku'][$i],
                                                                'active');
                    $productVariantIds[] = $lastInsertId;
                    
                    if (!empty($_POST['variant_size'][$i])) 
                    {
                        foreach ($_POST['variant_size'][$i] as $size) 
                        {
                            if (!empty($size)) 
                            {
                                // Thêm từng kích thước cho biến thể vào bảng
                                $mProductVariantSize->addProductVariantsSize($lastInsertId, $size);
                            }
                        }
                    }

                        // Thêm image album
                    $validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                    $target_dir = 'Images/';
 
                    if (isset($_FILES['variant_album_images']['name'][$i])) {
                        foreach ($_FILES['variant_album_images']['name'][$i] as $key => $fileName) {
                            $imageType = $_FILES['variant_album_images']['type'][$i][$key];
                            $tmpPath = $_FILES['variant_album_images']['tmp_name'][$i][$key];
                            $error = $_FILES['variant_album_images']['error'][$i][$key];
                    
                            // Kiểm tra lỗi upload
                            if ($error !== UPLOAD_ERR_OK) {
                                echo "Error uploading file $fileName. Error code: $error<br>";
                                continue;
                            }
                    
                            // Kiểm tra loại file
                            if (!in_array($imageType, $validImageTypes)) {
                                echo "File type for $fileName is not allowed.<br>";
                                continue;
                            }
                    
                            // Đặt tên file và lưu vào thư mục
                            $newFileName = time() . '_' . $fileName;
                            $target_path = $target_dir . $newFileName;
                    
                            if (move_uploaded_file($tmpPath, $target_path)) {
                                $mImage->addImages(null, (int)$lastInsertId, $target_path, 0, 'active');
                            } else {
                                echo "Failed to move file $fileName to $target_path.<br>";
                            }
                        }
                    }

                 // Thêm image main
                    if (isset($_FILES['variant_main_image']['name'][$i]) && !empty($_FILES['variant_main_image']['name'][$i])) {
                        $fileName = $_FILES['variant_main_image']['name'][$i];
                        $imageType = $_FILES['variant_main_image']['type'][$i];
                        $tmpPath = $_FILES['variant_main_image']['tmp_name'][$i];
                        $error = $_FILES['variant_main_image']['error'][$i];
                    
                        // Kiểm tra lỗi upload
                        if ($error !== UPLOAD_ERR_OK) {
                            echo "Error uploading file $fileName. Error code: $error<br>";
                            continue;
                        }
                    
                        // Kiểm tra loại file
                        if (!in_array($imageType, $validImageTypes)) {
                            echo "File type for $fileName is not allowed.<br>";
                            continue;
                        }
                    
                        // Đặt tên file và lưu vào thư mục
                        $newFileName = time() . '_' . $fileName;
                        $target_path = $target_dir . $newFileName;
                    
                        if (move_uploaded_file($tmpPath, $target_path)) {
                            $mImage->addImages(null, (int)$lastInsertId, $target_path, 1, 'active');
                        } else {
                            echo "Failed to move file $fileName to $target_path.<br>";
                        }
                    }
                }
            }
        }
        include_once 'Views/Admin/Product/addProductVariants.php';
    }

    public function ListProductVariant()
    {
        $mProductVariants = new ProductsVariants();
        $mProductVariantSize = new ProductsVariantSize();
        $mProduct = new Products();
        $listProduct = $mProduct -> getDataProduct();
        $listProductVariantSize = $mProductVariantSize -> ListProductVariantsSize();
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
     
        // Phân trang
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 10; // Số sản phẩm trên mỗi trang
        $offset = ($currentPage - 1) * $perPage;
        // Lấy product_id nếu có
        $productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;
        // var_dump($listProductVariants);

        if ($product_name) {
            // Lọc sản phẩm theo category_id
            $totalProductVariants = $mProductVariants->countProductVariantByName($product_name); // Tổng số sản phẩm theo danh mục
            $listProductVariants = $mProductVariants->getDataProductVariantByProductNameWithPagination($product_name,$offset,$perPage);
           
        } else {
            // Hiển thị tất cả sản phẩm 
            $totalProductVariants = $mProductVariants->countAllProductVariants(); // Tổng số sản phẩm 
            $listProductVariants = $mProductVariants->getDataProductVariantWithPagination($offset,$perPage);
        }

        // Tính tổng số trang
        $totalPages = ceil(($totalProductVariants -> total) / $perPage);

        include_once 'Views/Admin/Product/listProductVariants.php';
    }

    public function UpdateProductVariant()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProductVariantSize = new ProductsVariantSize();
            $mProductVariants = new ProductsVariants();
            $mProduct = new Products();
            $mColor = new Color();
            $mSize = new Size();
            $mImage = new Image();
            $allDataProduct = $mProduct -> getDataProduct();
            $listProductVariantById = $mProductVariants -> listProductVariantById($id);
            $listProductVariantSizeById = $mProductVariantSize -> ListProductVariantsSizeById($id);
            $allDataColor = $mColor -> getDataColor();
            $allDataSize = $mSize -> getDataSize();
            $mainImageById = $mImage -> getMainImageById($id);
            $albumImageById = $mImage -> getAlbumImageById($id);
            $isValid = true;

            if(isset($_POST['editProductVariants']))
            {
                // var_dump($_FILES);
                // die();
                // Validate dữ liệu kiểm tra đầu vào

                // var_dump($_POST['variant_size']);
                // die();
                
                if(empty($_POST['product_id']) || !is_numeric($_POST['product_id']))
                {
                    die('Sản phẩm không hợp lệ.');
                }
                if(empty($_POST['variant_price']) ||  $_POST['variant_price'] <= 0)
                {
                    $isValid = false;
                    // echo "Giá của biến thể " . ($i) . " không hợp lệ.<br>";
                }
                if (empty($_POST['variant_sku'])) {
                    $isValid = false;
                    // echo "SKU của biến thể " . ($i) . " không được để trống.<br>";
                }
        
                if (empty($_POST['variant_quantity']) || $_POST['variant_quantity'] <= 0) {
                    $isValid = false;
                    // echo "Số lượng của biến thể " . ($i) . " không hợp lệ.<br>";
                }

                if($isValid)
                {
                    // Sửa sản phẩm biến thể
                    $mProductVariants -> editProductVariants($_POST['product_id'],
                                                                    $_POST['variant_price'],
                                                                    $_POST['variant_priceCoupon'],
                                                                    $_POST['variant_start_date'],
                                                                    $_POST['variant_end_date'],
                                                                    $_POST['variant_quantity'],
                                                                    $_POST['variant_color'],
                                                                    $_POST['variant_sku'],
                                                                    $_POST['variant_status'],$id);

                    // Sửa size sản phẩm

                    if (isset($_POST['variant_size'])) 
                    {
                        // Lấy danh sách kích thước được chọn
                        $selectedSizes = array_keys($_POST['variant_size']);
                        
                        // Xóa các kích thước cũ trong bảng liên kết
                        $mProductVariantSize -> deleteProductVariantsSize($id);
                    
                        // Thêm lại các kích thước mới được chọn
                        foreach ($selectedSizes as $sizeId) {
                            $mProductVariantSize -> addProductVariantsSize($id, $sizeId);
                        }
                    }

                    // Sửa image album
                    $validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                    $target_dir = 'Images/';
                    
                    $product_variant_id = $id;
                    
                    if (isset($_FILES['variant_album_images']['name'][0]) && !empty($_FILES['variant_album_images']['name'][0])) 
                    {
                        // Xóa toàn bộ ảnh album hiện tại trong cơ sở dữ liệu
                        $mImage->deleteAlbumImagesByVariantId($product_variant_id); // Viết hàm xóa bên dưới

                        // Duyệt qua từng file album images
                        foreach ($_FILES['variant_album_images']['name'] as $index => $fileName) {
                            $imageType = $_FILES['variant_album_images']['type'][$index];
                            $tmpPath = $_FILES['variant_album_images']['tmp_name'][$index];
                            $error = $_FILES['variant_album_images']['error'][$index];

                            // Kiểm tra lỗi upload
                            if ($error !== UPLOAD_ERR_OK) {
                                echo "Error uploading file $fileName. Error code: $error<br>";
                                continue;
                            }

                            // Kiểm tra loại file
                            if (!in_array($imageType, $validImageTypes)) {
                                echo "File type for $fileName is not allowed. Only JPEG, PNG, and GIF are accepted.<br>";
                                continue;
                            }

                            // Đặt tên file và lưu vào thư mục
                            $newFileName = time() . '_' . $fileName;
                            $target_path = $target_dir . $newFileName;

                            if (move_uploaded_file($tmpPath, $target_path)) {
                                // Thêm ảnh vào cơ sở dữ liệu với album = 0 (ảnh album)
                                $mImage->addImages(null, $product_variant_id, $target_path, 0, 'active');
                            } else {
                                echo "Failed to move file $fileName to $target_path.<br>";
                            }
                        }
                    }

                    // Cập nhật ảnh chính
                    if (isset($_FILES['variant_main_image']['name']) && $_FILES['variant_main_image']['error'] == UPLOAD_ERR_OK && !empty($_FILES['variant_main_image']['name'])) {
                        $imageType = $_FILES['variant_main_image']['type'];
                        $tmpPath = $_FILES['variant_main_image']['tmp_name'];
                    
                        // Kiểm tra loại file
                        if (!in_array($imageType, $validImageTypes)) {
                            echo "Main image type is not allowed. Only JPEG, PNG, and GIF are accepted.<br>";
                        } else {
                            $newFileName = time() . '_main_' . $_FILES['variant_main_image']['name'];
                            $target_path = $target_dir . $newFileName;
                    
                            if (move_uploaded_file($tmpPath, $target_path)) {
                                // Kiểm tra xem ảnh chính đã tồn tại trong DB hay chưa
                                $existingMainImage = $mImage->getMainImageById($product_variant_id); // Hàm này cần được viết trong model của bạn
                    
                                if ($existingMainImage) {
                                    // Nếu đã có ảnh chính, thực hiện UPDATE
                                    $mImage->editMainImage($target_path, $product_variant_id);
                                } else {
                                    // Nếu chưa có, thực hiện INSERT
                                    $mImage->addImages(null, $product_variant_id, $target_path, 1, 'active');
                                }
                            } else {
                                echo "Failed to move main image to $target_path.<br>";
                            }
                        }
                    }
                }
            }


            include_once 'Views/Admin/Product/editProductVariants.php';
        }
        
    }

    public function DeleteProductVariant()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProductVariants = new ProductsVariants();
            $mProductVariants -> deleteProductVariant($id);
            header('Location: index.PHP?act=ListProductVariant');
        }
        include_once 'Views/Admin/Brand/listProduct.php';
    }
}
?>