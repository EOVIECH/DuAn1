<?php
class CUserController {

        public function dashboard(){
            if(!isset($_SESSION['username'])&&!isset($_SESSION['role'])&&$_SESSION['username'] != 'admin'){
                echo "<script> 
                alert('Vui long login');
                window.location.href = '?act=login';
                </script>";
                exit;
            }

         include_once './Views/Admin/dashboard.php';
        }

        public function logOut(){
            include_once './logout.php';
        }
        


    public function inForUser() {
        $MUser = new MUser();
        $inFor = $MUser->getAllUser(); 

        $users = (array) $inFor;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $emailInput = trim($_POST['email']);
            $passwordInput = trim(strval($_POST['password']));
               
            foreach ($users as $user) {

                    if (strtolower($user->email) === strtolower($emailInput) ) {

                        // var_dump(password_verify($passwordInput, $user->password));
                        // // var_dump($user->status);
                        // exit;

                        if($user->status === 'inactive'){
       
                            echo "<script> 
                            alert('Tài khoản của bạn đã dừng hoạt động. Vui lòng nhập tài khoản khác');
                            window.location.href = '?act=login';
                            </script>";
                            exit;
                         
                             } else if($user->status === 'active'){
            
                                if(password_verify($passwordInput, $user->password)){
     
                                        if($user->role === 'admin'){
                                            $_SESSION['user_id'] = $user->user_id;
                                            $_SESSION['username'] = $user->username;
                                            $_SESSION['role'] = 'admin';
                                            echo "<script>
                                            alert('Dang nhao vao admin');
                                            window.location.href= '?act=dashboard';
                                        </script>";
                                                exit;
                
                                      } 
        
                                else if($user->role === 'user'){
                                    $_SESSION['user_id'] = $user->user_id;
                                    $_SESSION['role'] = 'user';
                                       if(isset($_POST['remmember'])&&$_POST['remmember']){
        
                                        setcookie("user", $user->username,time()+(86400*2));
                                        setcookie("password", $user->password,time()+(86400*2));
                                        echo "Dang nhap vao user";
                                        header('Location: ?act=trangchu');
                                        exit;
                                       } else{
                                         echo "Dang nhap vao user";
                                        header('Location: ?act=trangchu');
                                        exit;
                                       }
                                      
                                }
                         } 
                        //  else{
                        //     echo "<script> 
                        //     alert('Password sai vui long dang nhap lai');
                        //     window.location.href = '?act=login';
                        //     </script>";
                        //     exit;
                        //  }
                        }
                }   
              
            }
        }
    
        include_once 'login.php';
    }

    public function insertUser(){
        if(isset($_POST['submit'])){

            $MUser = new MUser();

            $emailUser = $MUser->getEmailUser();

            $email = trim($_POST['email']);
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $create_at = date('Y-m-d');
            $user_name = $_POST['user_name'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
            $errors = [];

            if (empty($user_name)) {
                $errors['user_name'] = "Tên đăng nhập không được để trống.";
            } elseif (strlen($user_name) < 5) {
                $errors['user_name'] = "Tên đăng nhập phải có ít nhất 6 ký tự.";
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

            if (!empty($errors)) {
                foreach ($errors as $key => $error) {
                    echo "<p style='color: red;'>$error</p>";
                }
                return; // Dừng lại nếu có lỗi
            }


            foreach($emailUser as $value){
                if(strtolower($email) === strtolower($value->email)){
                    echo "<script> 
                    alert('Email đã tồn tại. Vui long thử lại email khác');
                    window.location.href = '?act=register';
                    </script>";
                    return;
                }
                    $result = $MUser -> setInsertDataUser('',$user_name,$password,$email,$phone,$address,'user','active',$create_at);
                    header('location: ?act=login');

            }
     }
        include_once 'register.php';
}

public function forgotPasswordUser() {
     if (isset($_POST['submit'])) {

    $MUser = new MUser();
    $inFor = $MUser->getAllUser(); 

    $users = (array) $inFor;
   
        $user_name = trim($_POST['username']);
        $emailInput = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        

        $error = null;

        foreach ($users as $user) {
            if (trim(strtolower($user->username)) === strtolower($user_name)) {

                if (strtolower($user->email) === strtolower($emailInput)) {

                    if (trim($user->phone) === $phone) {
                       
                        $_SESSION['id'] = $user->user_id;
                        echo "<script>
                            alert('Xác nhận người dùng thành công!');
                            window.location.href= '?act=change';
                        </script>";
                        exit;
                    } else {
                        $error = 'Số điện thoại sai, vui lòng đăng nhập lại.';
                        break;
                    }
                } else {
                    $error = 'Email sai, vui lòng đăng nhập lại.';
                    break;
                }
            }
        }
        
        if (!$error) {
            $error = 'Không tìm thấy thông tin người dùng. Vui lòng đăng nhập lại tên';
        }
        
        echo "<script>
            alert('$error');
            window.location.href= '?act=forgot';
        </script>";

    }

    // Include the login form
    include_once './Views/Users/forgotPassword.php';
}


    public function changePassword(){
        if(isset($_POST['submit'])){
            if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $MUser = new MUser();
            $getDataId = $MUser->getAllUser();

            if(!$id){
                echo "<script>
            alert('Khong tim thay thong tin nguoi dung');
                </script>";
            }

            if(!$_POST['pass1'] || !$_POST['pass2']){
                echo "<script>
                alert('Thong tin khong duoc de trong');
                    </script>";
                }
            
            if(trim(strtolower($_POST['pass1'])) === trim(strtolower($_POST['pass2']))){
                $password = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
                $change = $MUser->changePass($password,$id);

                echo "<script>
                alert('Sua thong tin thanh cong');
                window.location.href= '?act=login';
                    </script>";
                 exit;
            
            }
        }

        }
        
        include_once './changePass.php';
    }

}


?>