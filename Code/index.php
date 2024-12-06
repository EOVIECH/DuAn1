<?php
session_start();
require_once 'Controllers/CBrand.php';
require_once 'Controllers/CCategories.php';
require_once 'Controllers/CProduct.php';
require_once 'Controllers/CProductVariants.php';
require_once 'Controllers/CUserController.php';
require_once 'Controllers/CManage_client.php';
require_once 'Controllers/CChart.php';

const BaseUrl = "http://localhost/DuAn1/Code/";

$cBrand = new CBrand();
$cCategories = new CCategories();
$cProduct = new CProduct();
$cProductVariants = new CProductVariants();
$User = new CUserController();
$manage_client = new CClientController();
$cChart = new CChart();

$options = isset($_GET['act']) ? $_GET['act'] : '/';
switch($options){
  case 'Chart': {
    $cChart->Chart();
    break;
}
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
    case 'DeleteProductVariant':
    {
        $cProductVariants -> DeleteProductVariant();
        break;
    }
    
  // END PRODUCT-VARIANT

  // Home
    case 'Home':
    {
        $cProduct -> Home();
        break;
    }
    case 'ProductDetails':
    {
        $cProduct -> ProductDetails();
        break;
    }
    case 'Shop':
    {
        $cProduct -> Shop();
        break;
    }
    case 'AddCart':
    {
      $cProduct -> AddCart();
      break;
    }
    case 'Cart':
    {
      $cProduct -> Cart();
      break;
    }
    case 'DeleteItemCart':
    {
      $cProduct -> DeleteCart ();
      break;
    }
    case 'Checkout':
    {
      $cProduct -> Checkout();
      break;
    }
    case 'Order':
    {
      $cProduct -> Order();
      break;
    }
    case 'OrderCanceled':
    {
      $cProduct -> OrderCancelled();
      break;
    }
    case 'OrderDetails':
    {
      $cProduct -> OrderDetails();
      break;
    }
    case 'updateOrderStatus':
    {
      $cProduct -> OrderProductCanceled();
      break;
    }
    case 'ListOrder':
    {
      $cProduct -> OrderMangage();
      break;
    }
    case 'OrderDetailsMangage':
    {
      $cProduct -> OrderDetailsMangage();
      break;
    }
    case 'deleteOrder':
    {
      $cProduct -> deleteOrder();
      break;
    }
  // End Home

  // Users
    case 'login':
    {
        $User->inForUser();
        break;
    }
    case 'register':
    {
        $User->insertUser();
        break;
    }
    case 'logout':
    {
        $User->logOut();
        break;
    }
    case 'forgot':
    {
      $User->forgotPasswordUser();
      break;
    }
    case 'change':
    {
      $User->changePassword();
      break;
    }
        
      


  // End Users
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