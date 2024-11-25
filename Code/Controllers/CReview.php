<?php

class CReviewController{

    public function insertComment(){
        if(isset($_POST['submit'])){
    
            if (isset($_POST['rating'])) {
                $rating = intval($_POST['rating']);
               
            } else {
                // echo "Bạn chưa chọn đánh giá nào!";
                $rating = null;
            }
    
    
            $content = $_POST['comment'];
            $user_id = $_SESSION['user_id'];
            $product_id = $_GET['id'];
            $create_at = date('Y-m-d');
    
            $error = [];
    
              if(empty($content)){
                $error['comment'] = "<script>alert('Nội dung không được để trống.')</script>";
              }
    
              if(empty($user_id)){
                $error['user_id'] = "<script>alert('Không tim thấy thông tin của người dùng.')</script>";
              }
    
              if(empty($product_id)){
                $error['id'] = "<script>alert('Không tìm thấy thông tin của sản phẩm.')</script>";
              }
    
              if (!empty($error)) {
                foreach ($error as $key => $errors) {
                    echo "
                    <p style='color: red;'>$errors</p>
                    ";
                }
                return; 
            }
    
            $oPro = new MReview();
            $result = $oPro -> setInsertComment('',$user_id,$product_id,$rating,$content,$create_at);

                echo "<script>
                alert('Bạn đã thêm bình luận thành công!')
                </script>";
        }
    
        include_once './Views/Users/comment.php';
    }

    public function getDataComment(){

        $cPro = new MReview();
        $result = $cPro->getDataComment();
        
        include_once './Views/Users/dataComment.php';
    }
}
?>