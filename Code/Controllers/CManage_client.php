<?php

class clientController {
    public function inForClient(){
        $aUser = new user();
        $in = $aUser->getAllUser();

        // var_dump($in);

        include_once './Views/Admin/list_user.php';
    }


    public function addClient(){
        if(isset($_POST['submit'])){

                     $name = $_POST['name'];
                     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                     $email = $_POST['email'];
                     $phone = $_POST['phone'];
                     $address = $_POST['address'];

                     $created_at = date('Y-m-d');

                     $errors = [];

                     // Kiểm tra tên đăng nhập
                     if (empty($name)) {
                         $errors['user_name'] = "<script>alert('Tên đăng nhập không được để trống.')</script>";
                     } elseif (strlen($name) < 5) {
                         $errors['user_name'] = "<script>alert('Tên đăng nhập phải có ít nhất 12 ký tự.')</script>";
                     }
             
                     // Kiểm tra mật khẩu
                     if (empty($password)) {
                         $errors['password'] = "Mật khẩu không được để trống.";
                     } elseif (strlen($password) < 12) {
                         $errors['password'] = "Mật khẩu phải có ít nhất 12 ký tự.";
                     }
             
                     // Kiểm tra email
                     if (empty($email)) {
                         $errors['email'] = "Email không được để trống.";
                     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      //FILTER_VALIDATE_EMAIL: Là một hằng số trong PHP, đại diện cho bộ lọc để kiểm tra tính hợp lệ của một địa chỉ email.
                      //Hàm filter_var() sẽ kiểm tra xem giá trị trong biến $email có tuân theo định dạng của một địa chỉ email tiêu chuẩn hay không (ví dụ: có dấu @, có tên miền, ...).
                         $errors['email'] = "Định dạng email không hợp lệ.";
                     }
          
             
                     // Kiểm tra số điện thoại
                     if (empty($phone)) {
                         $errors['phone'] = "Số điện thoại không được để trống.";
                     } elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) {
                         $errors['phone'] = "Số điện thoại phải từ 10-11 chữ số.";
                     }
             
                     // Kiểm tra địa chỉ
                     if (empty($address)) {
                         $errors['address'] = "Địa chỉ không được để trống.";
                     }
             
                     // Nếu có lỗi, trả về thông báo lỗi
                     if (!empty($errors)) {
                         foreach ($errors as $key => $error) {
                             echo "<p style='color: red;'>$error</p>";
                         }
                         return; // Dừng lại nếu có lỗi
                     }
            
                     $nPro = new user();
                     $nPro -> setInsertDataUser('',$name,$password,$email,$phone,$address,'user','active', $created_at);
                     if (isset($nPro) && $nPro != '') {
                        echo "<script>
                                alert('Thêm thông tin thành công!');
                                window.location.href = '?act=list-user';
                              </script>";
                        exit;
                    }
                    //  var_dump($nPro);
                  }
                  include_once './Views/Admin/add_user.php';   
    }


    public function updateClient(){
            if(isset($_GET['id'])){
                $nPro = new user(); 
                $getID = $nPro->getIdDataUser($_GET['id']);
                // var_dump($getID);

            if(isset($_POST['submit'])){

                    $user_name = $_POST['username'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $status = $_POST['status'];
                    $created_at = date('Y-m-d');
                
                  
                    $nPro -> updateUser($user_name,$password,$email,$phone,$address,'user',$status, $created_at,$_GET['id']);
                    if (isset($nPro) && $nPro != '') {
                        echo "<script>
                                alert('Cập nhật thành công!');
                                window.location.href = '?act=list-user';
                              </script>";
                        exit;
                    }
                    
                    
                    // exit;
                    var_dump($nPro);
                    // exit;
                 }
            }
            include_once './Views/Admin/edit_user.php';
 }


    public function delUser(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $nPro = new user();
            $delReview = $nPro -> deleteReview($id);
            $del = $nPro -> deleteUser($id);
    
            header('location: ?act=list-user');
        }
       
    }
} 
        ?>

