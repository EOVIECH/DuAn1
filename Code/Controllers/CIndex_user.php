 <?php

 class CIndex_user{
        public function reder_product(){
                $mPro = new MProduct();
                $listProduct = $mPro->getAllDataProduct();
               //  var_dump($listProduct);
                include_once './trangchu_USER.php';
               }
        }