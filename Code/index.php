<?php
require_once 'Controllers/CBrand.php';
const BaseUrl = "http://localhost/DuAn1/Code/";

$cBrand = new CBrand();
$options = isset($_GET['act']) ? $_GET['act'] : '/';
switch($options){
    case 'AddBrand':
    {
        $cBrand -> InsertBrand();
        break;
    }
}
?>