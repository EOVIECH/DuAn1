<?php
session_start();
// require_once 'Models/connectDB.php';
// $cPro = new ConnectDB();
require_once './Models/MProducts.php';
require_once './Models/MUsers.php';
require_once './Controllers/CProductController.php';
require_once './Controllers/CUserController.php';
require_once './Controllers/CManage_client.php';
require_once './Controllers/CIndex_user.php';

$inFor = new productController();
$inFors = new userController();
$manage_client = new clientController();
$main = new index_user();

// var_dump($_SESSION['user_id']);
// var_dump($_SESSION['username']);


$act = $_GET['act'] ?? 'trangchu';
// debug($act);
$error = "";
switch ($act) {

    // case 'listProduct':
    //     $inFor->listProduct();
    //     break;

    case 'login':
        $inFors->inForUser();
        break;

    case 'register':
        $inFors->insertUser();
        break;

    case 'logout':
        $infors->logOut();
        break;

    case 'trangchu':
        $main->reder_product();
        break;

        case 'dashboard':
            $inFors->dashboard();
            break;

    case 'comment':
        $inFors->insertComment();
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
        $inFor->listProduct();
        break;
    
    case 'detail-product':
        $inFor->detailProduct();
        break; 
        
        case 'forgot':
            $inFors->forgotPasswordUser();
            break;

            case 'change':
                $inFors->changePassword();
                break;

                case 'dataComment':
                    $inFors->getDataComment();
                    break;
        
};
?>
