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
    case 'EditBrand':
    {
        $cBrand -> UpdateBrand();
        break;
    }
    case 'ListBrand':
    {
        $cBrand -> ListBrand();
        break;
    }
    case 'DeleteBrand':
    {
        $cBrand -> DeleteBrand();
        break;
    }
    case 'DeleteSelectedBrand':
    {
        $cBrand -> DeleteSelectedBrand();
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


<script>
    function selectAll()
    {
      let checkboxes = document.querySelectorAll('.checkbox');
      checkboxes.forEach(function(checkbox)
      {
        checkbox.checked = true;
      });
    }

    function deselectAll()
    {
      let checkboxes = document.querySelectorAll('.checkbox');
      checkboxes.forEach(function(checkbox)
      {
        checkbox.checked = false;
      });
    }

    function confirmDeleted(delURL)
    {
      if(confirm('ARE YOU SURE DELETE SELECTED DATA'))
      {
        document.location = delURL;
      }
    }
</script>