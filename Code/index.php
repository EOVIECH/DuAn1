<?php

require_once 'Controllers/CChart.php';

const BaseUrl = "http://localhost/DuAn1/Code/";

$id = $_GET['id'] ?? false;
$cChart = new CChart();


$options = isset($_GET['act']) ? $_GET['act'] : '/';

switch ($options) {
    // Chart case
    case 'Chart': {
        $cChart->Chart();
        break;
    }

    
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