<?php
session_start();
require_once './Models/MUsers.php';
require_once './Models/MReviews.php';
require_once 'Controllers/CBrand.php';
require_once 'Controllers/CCategories.php';
require_once 'Controllers/CProduct.php';
require_once 'Controllers/CProductVariants.php';
require_once './Controllers/CUserController.php';
require_once './Controllers/CManage_client.php';
require_once './Controllers/CReview.php';

const BaseUrl = "http://localhost/DuAn1/Code/";

// var_dump($_SESSION['user_id']);
// exit;

$cBrand = new CBrand();
$cCategories = new CCategories();
$cProduct = new CProduct();
$cProductVariants = new CProductVariants();
$User = new CUserController();
$manage_client = new CClientController();
$Review = new CReviewController();
$options = isset($_GET['act']) ? $_GET['act'] : 'Home';
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

    case 'wishlist':
        {
            $cProduct -> wishlist();
            break;
        }

        case 'dataWishlist':
            {
                $cProduct -> getDataWishlist();
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
  // End Home

  //cua Hai
  case 'login':
    $User->inForUser();
    break;

    case 'logout':
        $User->logOut();
        break;
    

case 'register':
    $User->insertUser();
    break;

case 'admin-index':
    $User->admin();
    break;

case 'logout':
    $User->logOut();
    break;

case 'trangchu':
    $main->reder_product();
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
    $Product->listProduct();
    break;

case 'detail-product':
    $Product->detailProduct();
    break; 
    
case 'forgot':
    $User->forgotPasswordUser();
    break;

case 'change':
    $User->changePassword();
    break;

case 'dataComment':
    $Review->getDataComment();
    break;

case 'detail_comment':
    $Review->detail_comment();
    break;

case 'feedBack':
    $Review->feedBack();
    break;
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