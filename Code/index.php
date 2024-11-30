<?php
session_start();
// require_once 'Models/connectDB.php';
// $cPro = new ConnectDB();
require_once './Models/MProducts.php';
require_once './Models/MUsers.php';
require_once './Models/MReviews.php';
require_once './Controllers/CProductController.php';
require_once './Controllers/CUserController.php';
require_once './Controllers/CManage_client.php';
require_once './Controllers/CIndex_user.php';
require_once './Controllers/CReview.php';

$Product = new CProductController();
$User = new CUserController();
$manage_client = new CClientController();
$main = new CIndex_user();
$Review = new CReviewController();


// exit;

//   var_dump('ahihihi');
//   exit;
// var_dump($_SESSION['user_id']);
// var_dump($_SESSION['username']);
// var_dump($_SESSION['average']);
// exit;


$act = $_GET['act'] ?? 'trangchu';


// debug($act);
$error = "";
switch ($act) {
    case 'login':
        $User->inForUser();
        break;

    case 'register':
        $User->insertUser();
        break;

    case 'logout':
        $User->logOut();
        break;

    case 'trangchu':
        $main->reder_product();
        break;

    case 'dashboard':
        $User->dashboard();
        break;

    case 'list-user':
        $manage_client->inForClient();
        break;
    
    case 'add-user':
        $manage_client->addClient();
        break;

    case 'edit-user':
        $manage_client->updateClient();
        break;

    case 'del-user':
        $manage_client->delUser();
        break;

    case 'list-product':
        $Product->listProduct();
        break;
    
    case 'detail-product':
        $Product->detailProduct();
        break; 
        
    case 'forgot':
        $User->forgotPasswordUser();
        break;

    case 'change':
        $User->changePassword();
        break;

    case 'dataComment':
        $Review->getDataComment();
        break;
    
    case 'detail_comment':
        $Review->detail_comment();
        break;

    case 'feedBack':
        $Review->feedBack();
        break;
        
};
?>
