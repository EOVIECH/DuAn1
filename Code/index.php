<?php
session_start();
// require_once 'Models/connectDB.php';
// $cPro = new ConnectDB();
require_once 'Models/MProducts.php';
require_once 'Models/MUsers.php';
require_once 'Controllers/CProductController.php';
require_once 'Controllers/CUserController.php';

// $inFor = new productController();
$inFors = new userController();

// var_dump($_SESSION['user_id']);

$act = $_GET['act'] ?? 'login';
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

    case 'trangchu':
        header('location: ./trangchu.php');
        break;

    case 'comment':
        $inFors->insertComment();
        break;
             
};
?>
