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
  // CASE BRAND

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

  // END BRAND

  // CASE CATEGORY

    case 'AddCategories':
    {
        $cCategories -> InsertCategories();
        break;
    }
     case 'EditCategory':
    {
        $cCategories -> UpdateCategory();
        break;
    }
    case 'ListCategory':
    {
        $cCategories -> ListCategories();
        break;
    }
    case 'DeleteCategory':
    {
        $cCategories -> DeleteCategory();
        break;
    }
    case 'DeleteSelectedCategory':
    {
        $cCategories -> DeleteSelectedCategory();
        break;
    }

  // END CATEGORY
  
  // CASE PRODUCT

    case 'AddProducts':
    {
        $cProduct -> InsertProducts();
        break;
    }
    case 'EditProduct':
    {
        $cProduct -> UpdateProduct();
        break;
    }
    case 'ListProduct':
    {
        $cProduct -> ListProduct();
        break;
    }
    case 'DeleteProduct':
    {
        $cProduct -> DeleteProduct();
        break;
    }
    case 'DeleteSelectedProduct':
    {
        $cProduct -> DeleteSelectedProduct();
        break;
    }

  // END PRODUCT

  // CASE PRODUCT-VARIANT

    case 'AddProductVariants':
    {
        $cProductVariants -> InsertProductVariants();
        break;
    }

    case 'ListProductVariant':
    {
        $cProductVariants -> ListProductVariant();
        break;
    }

    case 'EditProductVariant':
    {
        $cProductVariants -> UpdateProductVariant();
        break;
    }
    
  // END PRODUCT-VARIANT
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