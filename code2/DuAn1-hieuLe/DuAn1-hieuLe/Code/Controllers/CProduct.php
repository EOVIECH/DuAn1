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
        $err = false;
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
                    $err = true;
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
            $err = false;
            if(isset($_POST['edit_Product']))
            {
                if(isset($_POST['product_name'])
                && isset($_POST['description'])
                && isset($_POST['brand_id'])
                && isset($_POST['category_id'])
                && isset($_POST['status_id']))
                {
                        $mProduct -> editProduct($_POST['brand_id'],$_POST['product_name'],$_POST['description'],$_POST['status_id'],$currentDate,$id);
                        $mProductCategories->editProductCategories($_POST['category_id'],$id);
                        $err = true;
                        header('Location: index.PHP?act=ListProduct');
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

        $listCategories = $mCategories->getDataCategories();

        
        // Phân trang
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 10;
        $offset =  ($currentPage - 1) * $perPage;
        // Xử lý logic tìm kiếm
        // if(isset($_POST['search']))
        // {
            $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
            $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
            if (!empty($_POST['product_name']) && !empty($_POST['category_id'])) {
                // Tìm kiếm theo tên sản phẩm và danh mục
                $totalProducts = $mProduct->countAllProductsByNameAndCategoryId($categoryId,$categoryId);
                $listProduct = $mProduct->getDataProductByCategoryIdAndNameWithPagination($categoryId, $product_name, $offset, $perPage);
            }elseif (!empty($product_name)) {
                // Tìm kiếm theo tên sản phẩm
                $totalProducts = $mProduct->countAllProductsByName($product_name);
                $listProduct = $mProduct->getDataProductWithPaginationAndName($product_name, $offset, $perPage);
            } elseif (!empty($categoryId)) {
                // Lọc theo danh mục
                $totalProducts = $mProduct->countProductsByCategoryId($categoryId);
                $listProduct = $mProduct->getDataProductByCategoryIdWithPagination($categoryId, $offset, $perPage);
            } else {
                // Hiển thị tất cả sản phẩm
                $totalProducts = $mProduct->countAllProducts();
                $listProduct = $mProduct->getDataProductWithPagination($offset, $perPage);
            }
        // }

        // Tính tổng số trang
        $totalPages = ceil(($totalProducts -> total) / $perPage);
        // Hiển thị danh sách sản phẩm
        // var_dump($totalPages);
        include_once 'Views/Admin/Product/listProduct.php';
    }
        
    public function DeleteSelectedProduct()
    {
        if(isset($_POST['btn-delSelected']))
        {
            $mProduct = new Products();
            $deletedItems = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            foreach ($deletedItems as $deletedItem)
            {
                $mProduct -> deleteProduct($deletedItem);
                header('Location: index.PHP?act=ListProduct');
            }
        }
    }

    public function DeleteProduct()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProduct = new Products();
            $mProductVariant = new ProductsVariants();
            $mProduct -> deleteProduct($id);
            $mProductVariant -> deleteProductVariant($id);
            header('Location: index.PHP?act=ListProduct');
        }
        include_once 'Views/Admin/Brand/listProduct.php';
    }

    public function Home()
    {
        $mProduct = new Products();
        $listProductNewest = $mProduct -> getProductNewest();
        
        include_once './Views/Users/home.php';
    }

    public function Shop()
    {
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mCategories = new Categories();

        $listCategories = $mCategories->getDataCategories();
        
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 20;
        $offset =  ($currentPage - 1) * $perPage;
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
        $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
        // var_dump($product_name);
        // var_dump($categoryId);
        // die();
            if (!empty($_POST['product_name']) && !empty($_POST['category_id'])) {
                // Tìm kiếm theo tên sản phẩm và danh mục
                echo '1';
                $totalProducts = $mProduct->countAllShopByNameAndCategoryId($categoryId,$product_name);
                $listProduct = $mProduct->getDataShopByCategoryIdAndNameWithPagination($categoryId, $product_name, $offset, $perPage);
            }elseif (!empty($product_name)) {
                // Tìm kiếm theo tên sản phẩm
                echo '2';
                $totalProducts = $mProduct->countAllShopByName($product_name);
                $listProduct = $mProduct->getDataShopWithPaginationAndName($product_name, $offset, $perPage);
            } elseif (!empty($categoryId)) {
                // Lọc theo danh mục
                echo '3';
                $totalProducts = $mProduct->countShopByCategoryId($categoryId);
                $listProduct = $mProduct->getDataShopByCategoryIdWithPagination($categoryId, $offset, $perPage);
                var_dump($mProduct->getDataShopByCategoryIdWithPagination(18, 0, 20));

            } else {
                // Hiển thị tất cả sản phẩm
                echo '4';
                $totalProducts = $mProduct->countAllShop();
                $listProduct = $mProduct->getDataShopWithPagination($offset, $perPage);
            }

        // Tính tổng số trang
        $totalPages = ceil(($totalProducts -> total) / $perPage);
        // Hiển thị danh sách sản phẩm
        // var_dump($totalPages);

        include_once './Views/Users/shop.php';
    }

    public function ProductDetails()
    {
        $mProduct = new Products();
        $mReview = new MReview();
        $MSize = new Size();
       
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $product_id = $_GET['id'];
            $listColor = $mProduct -> getColorAvailableInProduct($product_id);
            $relatedProduct = $mProduct -> getRelatedProduct($product_id,$product_id);
            $sizes = $MSize-> getDataSize();
            if(isset($_GET['color']))
            {
                $listProductDetails = $mProduct -> getDataProductDetailsWithColorId($product_id,$_GET['color']);
            }else
            {
                $listProductDetails = $mProduct -> getDataProductDetails($product_id);
            }

            $rating = $mReview->getRatingComment($_GET['id']);
   
            $arrayRating = (array) $rating;
   
            $count = count($arrayRating);
   
            $sum = 0;
            $average = 0;
            foreach($arrayRating as $value){
             $sum += $value->rating;
              $average = $sum/$count;   
            }
   
            $_SESSION['average'] = number_format($average,1);
    
              if (isset($_POST['rating'])) {
                  $rating = intval($_POST['rating']);
                 
              } else {
                  $rating = null;
              }
   
         if(isset($_POST['submit'])){
      
              $content = $_POST['comment'];
              $user_id = $_SESSION['user_id'];
              $product_id = $_GET['id'];
              $create_at = date('Y-m-d');

            //   var_dump($content);
            //   exit;
      
              $error = [];
      
                if(empty($content)){
                    $id = isset($_GET['id']) ? $_GET['id'] : 0;
                  echo "<script>
                  alert('Nội dung không được để trống.')
                  window.location.href = '?act=ProductDetails&id='+ $id;
                  </script>";
                  exit;
                }
      
                if(empty($user_id)){
                    echo "<script>
                  alert('Không tim thấy thông tin của người dùng.')
                  window.location.href = '?act=Home';
                  </script>";
                  exit;
                }
      
                if(empty($product_id)){
                    echo "<script>
                  alert('Không tìm thấy thông tin của sản phẩm.')
                  window.location.href = '?act=Home';
                  </script>";
                  exit;
                }
      
                if (!empty($error)) {
                  foreach ($error as $key => $errors) {
                      echo "
                      <p style='color: red;'>$errors</p>
                      ";  
                  }
                exit; 
              }
              
              $result = $mReview -> setInsertComment('',$user_id,$product_id,$rating,$content,$create_at,0);
            //   $feedBack = $mReview->feedBack();
   
                  echo "<script>
                  alert('Bạn đã thêm bình luận thành công!')
                  </script>";
          }

        
        }
        include_once './Views/Users/detailProduct.php';
    }

    public function wishlist() {
        if(isset($_GET['id'], $_GET['act']) && $_GET['act'] = 'wishlist'){
            $id = $_GET['id'];
        $mProduct = new Products();
        if(isset($_SESSION['color'],$_SESSION['size'])){
            $color = $_SESSION['color'];
            $size = $_SESSION['size'];
            $variant_id = $mProduct->getVariant($size,$id,$color);
            foreach($variant_id as $index){
                $product_variant = $index->variant_id;
            }
            // var_dump($product_variant);
            // exit;
           
        $wishlist = $mProduct->addWishlist('', $_SESSION['user_id'], $product_variant, 1,$id);
            echo "<script>
            alert('Bạn đã yêu thích sản phẩm này');
            window.location.href = '?act=ProductDetails&id=' + $id;
            </script>";
            exit;
            
        }
        }
    }

    public function getDataWishlist(){
        $mProduct = new Products();
        $wishlist = $mProduct -> getAllDataProduct();
        if(isset($_POST['submit'])){

            $id = $_POST['submit'];
           $del = $mProduct -> delWishList(0,$id);
            echo "<script>
            alert('Xoa du lieu thanh cong');
            window.location.href = '?act=dataWishlist';
            </script>";
            exit;
        }

        include_once './Views/Admin/Product/wishlist.php';
    }

    
        }
    

    

    // public function addWishlist(){
    //     if(isset($_GET['id'])){
    //         if(isset($_SESSION['user_id'])){

    //             $user_id = $_SESSION['user_id'];
    //             // $product_variant_id = ;
    //             $mProduct = new Products();
    //             $addWishList = $mProduct->addWishlist();
    //         }
    //     }
    // }
?>  