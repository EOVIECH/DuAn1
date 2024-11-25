<?php
// class productController{
//  public function listProduct(){
//     $mPro = new product();
//     $listProduct = $mPro->getAllDataProduct();
//     include_once './Views/Admin/list_admin.php';
//    }

//    public function addProduct(){
//       if(isset($_POST['submit'])){
//         //  var_dump([$_FILES['img']]);
//          $sku = $_POST['sku'];
//          $name = $_POST['name'];
//          $description = $_POST['description'];
//          $status = $_POST['status'];
//          $create_at = $_POST['create_at'];

//          $nPro = new product();
//          $nPro -> setInsertDataProduct(NULL,NULL,$sku,$name,$description,$status,$create_at);
//          var_dump($nPro);
//       }

//       include_once 'Views/Admin/add_admin.php';
//    }

//    public function editProduct(){
//       if(isset($_GET['id'])){
//          // echo $_GET['id'];
//          $bPro = new product();
//          $idPro = $bPro -> getIdDataProduct($_GET['id']);
//          if(isset($_POST['submit'])){
//             var_dump([$_FILES['img']]);
//             $name = $_POST['name'];
//             $price = $_POST['price'];
//             $quantity = $_POST['quantity'];
//             //  echo $_POST['name'];
//             //upload anh lấy link đường dẫn thư mục ảnh
//             $target_dir = 'img/';
//             //b2: lay ten file da upload 
//             $name_img = $_FILES['img']['name'];
//             //b3:ghep ten file upload vowis dg dan thu muc chua anh
//             $target_path = $target_dir.$name_img;
//             //b4: upload vao thu muc 
//             move_uploaded_file($_FILES['img']['tmp_name'],$target_path);
//             $nPro = new product();
//             $nPro -> updateProduct($name,$price,1,$quantity,$target_path,$_GET['id']);
//          }
   
//          var_dump($idPro);
//       }
//          include_once 'view/edit.php';

//    }
// }
?>
