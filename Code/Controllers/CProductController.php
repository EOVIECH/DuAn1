<?php
class CProductController{
 public function listProduct(){
    $mPro = new MProduct();
    $listProduct = $mPro->getAllDataProduct();
   //  var_dump($listProduct);
    include_once './Views/Admin/list_product.php';
   }

   public function detailProduct(){
      $MProduct = new MProduct();
      $listProduct = $MProduct->getAllDataProduct();

      if(isset($_GET['id'])){

         $mReview = new MReview();
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
   
           $error = [];
   
             if(empty($content)){
               $error['comment'] = "<script>
               alert('Nội dung không được để trống.')
               window.location.href = '?act=detail-product';
               </script>";
               exit;
             }
   
             if(empty($user_id)){
               $error['user_id'] = "<script>
               alert('Không tim thấy thông tin của người dùng.')
               window.location.href = '?act=detail-product';
               </script>";
               exit;
             }
   
             if(empty($product_id)){
               $error['id'] = "<script>
               alert('Không tìm thấy thông tin của sản phẩm.')
               window.location.href = '?act=detail-product';
               </script>";
               exit;
             }
   
             if (!empty($error)) {
               foreach ($error as $key => $errors) {
                   echo "
                   <p style='color: red;'>$errors</p>
                   ";  
               }
               return; 
           }
           
           $result = $mReview -> setInsertComment('',$user_id,$product_id,$rating,$content,$create_at,0);

               echo "<script>
               alert('Bạn đã thêm bình luận thành công!')
               </script>";
       }
   }
     //  var_dump($listProduct);
      include_once './Views/Admin/detail_product.php';
     }

   public function addProduct(){
      if(isset($_POST['submit'])){

         $sku = $_POST['sku'];
         $name = $_POST['name'];
         $description = $_POST['description'];
         $status = $_POST['status'];
         $create_at = $_POST['create_at'];

         $nPro = new MProduct();
         $nPro -> setInsertDataProduct(NULL,NULL,$sku,$name,$description,$status,$create_at);
         var_dump($nPro);
      }

      include_once 'Views/Admin/add_admin.php';
   }

   public function editProduct(){
      if(isset($_GET['id'])){
         // echo $_GET['id'];
         $bPro = new MProduct();
         $idPro = $bPro -> getIdDataProduct($_GET['id']);
         if(isset($_POST['submit'])){
            var_dump([$_FILES['img']]);
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            //  echo $_POST['name'];
            //upload anh lấy link đường dẫn thư mục ảnh
            $target_dir = 'img/';
            //b2: lay ten file da upload 
            $name_img = $_FILES['img']['name'];
            //b3:ghep ten file upload vowis dg dan thu muc chua anh
            $target_path = $target_dir.$name_img;
            //b4: upload vao thu muc 
            move_uploaded_file($_FILES['img']['tmp_name'],$target_path);
            $nPro = new MProduct();
            $nPro -> updateProduct($name,$price,1,$quantity,$target_path,$_GET['id']);
         }
   
         var_dump($idPro);
      }
         include_once 'view/edit.php';

   }
}
?>
