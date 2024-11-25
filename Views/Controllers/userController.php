<?php

class userController {
    public function inForUser() {
        $aUser = new user();
        $inFor = $aUser->getAllUser(); 

        $users = (array) $inFor;
    
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $emailInput = trim($_POST['email']);
            $passwordInput = trim($_POST['password']);
    
  
            foreach ($users as $user) {
                
                // var_dump($user->role);
                if (strtolower($user->email) === strtolower($emailInput) ) {
            
                   if(password_verify($passwordInput, $user->password)){
                        
                        if($user->role === 'admin'){

                                header('Location: ?act=listProduct');
                                exit;
                                echo "Dang nhao vao admin";
                        } elseif($user->role === 'user'){
                            $_SESSION['user_id'] = $user->user_id;
                                echo "Dang nhap vao user";
                                header('Location: ?act=comment');
                                exit;
                        }

                        if(isset($user->email)){
                            $_SESSION['idUser'] = $user->user_id;
                            $_SESSION['username'] = $user->username;
                        }

                    } else {

                        echo "NOT FOUND 404";

                    }
                   }
            }
    
            // If no match is found, display an error message
            echo "<script>alert('Mật khẩu hoặc password của bạn sai')</script>";
        }
    
        // Include the login form
        include_once 'login.php';
    }

    public function insertUser(){
        if(isset($_POST['submit'])){

           $user_name = $_POST['user_name'];
           $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

           //PASSWORD_DÈAULT:   đảm bảo mật khẩu mạnh phù hợp với an ninh

           $email = $_POST['email'];
           $phone = $_POST['phone'];
           $address = $_POST['address'];
           $create_at = date('Y-m-d');

           $errors = [];

           // Kiểm tra tên đăng nhập
           if (empty($user_name)) {
               $errors['user_name'] = "Tên đăng nhập không được để trống.";
           } elseif (strlen($user_name) < 12) {
               $errors['user_name'] = "Tên đăng nhập phải có ít nhất 12 ký tự.";
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


        $oPro = new user();
        $result = $oPro -> setInsertDataUser('',$user_name,$password,$email,$phone,$address,'user','active',$create_at);
        //    var_dump($result);
                 echo 'Ban da them thanh cong';
                 if ($result === "") {
                    echo 'Lỗi: Không thể thêm người dùng.';
                } else {
                    header('Location: ?act=login');
                    exit;
                }

                exit;
     
     }
        include_once 'register.php';
}

public function insertComment(){
    if(isset($_POST['submit'])){
        $content = $_POST['comment'];
        $user_id = $_SESSION['user_id'];
        $create_at = date('Y-m-d');

        $oPro = new user();
        $result = $oPro -> setInsertComment('',$user_id,NULL,NULL,$content,$create_at);
        if(!empty($result)){
            echo "<script>alert('Ban them comment thanh cong')</script>";
        }

    }

    include_once './Views/Users/product_detail.php';
}

}
?>