<?php
session_start();
require_once '../Models/connectDB.php';
$cPro = new ConnectDB();
require_once '../Models/products.php';
require_once '../Models/users.php';

// $inFor = new productController();
$inFors = new userController();

// var_dump($_SESSION['user_id']);

$act = $_GET['act'] ?? 'login';
// debug($act);
$error = "";
$client = new clientController();

switch($act){
    case 'manage_client':
        $client->inForClient();
        break;
}   