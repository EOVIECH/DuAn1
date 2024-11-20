<?php
require_once 'Controllers/CBrand.php';
require_once 'Controllers/CCategories.php';
require_once 'Controllers/CProduct.php';
require_once 'Controllers/CProductVariants.php';

const BaseUrl = "http://localhost/DuAn1/Code/";

$cBrand = new CBrand();
$cCategories = new CCategories();
$cProduct = new CProduct();
$cProductVariants = new CProductVariants();
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
    case 'AddProducts':
    {
        $cProduct -> InsertProducts();
        break;
    }
    case 'AddProductVariants':
    {
        $cProductVariants -> InsertProductVariants();
        break;
    }
}
?>