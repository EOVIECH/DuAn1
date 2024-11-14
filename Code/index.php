<?php
require_once 'Controllers/CBrand.php';
require_once 'Controllers/CCategories.php';

const BaseUrl = "http://localhost/DuAn1/Code/";

$cBrand = new CBrand();
$cCategories = new CCategories();
$options = isset($_GET['act']) ? $_GET['act'] : '/';
switch($options){
    case 'AddBrand':
    {
        $cBrand -> InsertBrand();
        break;
    }
    case 'AddCategories':
    {
        $cCategories -> InsertCategories();
        break;
    }
}
?>