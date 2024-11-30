<?php

class CReviewController{

    public function getDataComment(){
      //Lấy tất cả dữ liệu của comment ra bảng
        $mReview = new MReview();
        $result = $mReview->getDataComment();

      // Duyệt các comment

        if(isset($_POST['submit'])){
        
          $id = $_POST['submit'];

          $duyet = $mReview->updateStatus(1, $id);
          echo "
          <script>
          alert('Dữ liệu được duyệt thành công');
          window.location.href = '?act=dataComment';
          </script>";
          exit;
                }

        // chức năng tìm kiếm

        if(isset($_POST['search'])){

          $content = isset($_POST['input']) ? '%'.trim($_POST['input']).'%' : '';
          // var_dump($content);
         
          if ($content === '%%' || $content === '') {
            echo "<script>
          alert('Vui lòng nhập dữ liệu!');
          window.location.href = '?act=dataComment';
          </script>";
            exit;
        }
            $search = $mReview->searchDataComment($content,$content);
            
        }

     if(isset($_POST['filter'])){

    $created_at = isset($_POST['filter_input']) ? $_POST['filter_input'] : '';
    // var_dump( $created_at);
    // exit;
    // $index = $created_at;
    // var_dump($index);
    // exit;
    $time = date('Y-m-d H:i:s');

    if ($created_at > $time) {
        echo "<script>
            alert('Ngày bạn nhập vượt quá ngày hiện tại. Vui lòng nhập lại');
            window.location.href = '?act=dataComment';
        </script>";
        exit;
    }

    if ($created_at === '') {
        echo "<script>
            alert('Vui lòng nhập dữ liệu!');
            window.location.href = '?act=dataComment';
        </script>";
        exit;
    }

    // var_dump( $created_at);
    // exit;
    $filter = $mReview->filterDataComment($created_at);
    // var_dump($mReview->filterDataComment($created_at));
    // exit;
    
}
  
        include_once './Views/Admin/dataComment.php';
    }

    public function detail_comment(){

        if(isset($_GET['id'])){
          // var_dump('result');
          // exit;
          $mReview = new MReview();
          $result = $mReview->getIdDataJoin($_GET['id']);
        } else{
          echo "
          <script>
          alert('Không tìm thấy thông tin của comment');
          window.location.href = '?act=dataComment';
          </script>";
          exit;
        }
      include_once './Views/Admin/detail_comment.php';
    }

    public function feedBack(){

        $mReview = new MReview();
        $feedBack = $mReview->feedBack();

      include_once './Views/Users/feedBack.php';
    }

}
?>