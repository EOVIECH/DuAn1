 <?php

 class index_user{
        public function reder_product(){
                $mPro = new product();
                $listProduct = $mPro->getAllDataProduct();
               //  var_dump($listProduct);
                include_once './trangchu_USER.php';
               }
        }