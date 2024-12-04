<?php
require_once './Models/MProduct.php';
require_once './Models/MBrand.php';
require_once './Models/MCategories.php';
require_once './Models/MProductCategories.php';
require_once './Models/MCart.php';
require_once './Models/MOrders.php';
require_once './Models/MDiscount.php';

class CProduct{
    public $connect;

    public function __construct()
    {
        $this -> connect = new Products();
    }

    public function InsertProducts(){
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mBrand = new Brands();
        $mCategories = new Categories();
        $currentDate = date("Y-m-d H:i:s");
        $listBrand = $mBrand -> getDataBrands();
        $listCategories = $mCategories -> getDataCategories();
        $err = false;
        if(isset($_POST['add_Product']))
        {
            if(isset($_POST['product_name'])
            && isset($_POST['description'])
            && isset($_POST['brand_id'])
            && isset($_POST['category_id']))
            {
                $amount = $_POST['totalProducts'];
                for($i = 0; $i < $_POST['totalProducts']; $i++){
                    // Thêm sản phẩm vào bảng product
                    $lastInsertId = $mProduct -> addProduct('',$_POST['brand_id'][$i],$_POST['product_name'][$i],$_POST['description'][$i],'active',$currentDate);
                    // Thêm sản phẩm vào bảng product_categories
                    $mProductCategories->addProductCategories((int)$lastInsertId, $_POST['category_id'][$i]);
                    $err = true;
                }
            }
        }
        include_once 'Views/Admin/Product/addProduct.php';
    }

    public function UpdateProduct()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProduct = new Products();
            $mProductCategories = new ProductCategories();
            $mBrand = new Brands();
            $mCategories = new Categories();
            $currentDate = date("Y-m-d H:i:s");
            $listBrand = $mBrand -> getDataBrands();
            $listCategories = $mCategories -> getDataCategories();
            $listProById = $mProduct -> getDataProductById($id);
            $listProductCategoryById = $mProductCategories -> getProductCategoryById($id);
            $err = false;
            if(isset($_POST['edit_Product']))
            {
                if(isset($_POST['product_name'])
                && isset($_POST['description'])
                && isset($_POST['brand_id'])
                && isset($_POST['category_id'])
                && isset($_POST['status_id']))
                {
                        $mProduct -> editProduct($_POST['brand_id'],$_POST['product_name'],$_POST['description'],$_POST['status_id'],$currentDate,$id);
                        $mProductCategories->editProductCategories($_POST['category_id'],$id);
                        $err = true;
                        header('Location: index.PHP?act=ListProduct');
                    }
            }
        }
        include_once 'Views/Admin/Product/editProduct.php';

    }

    public function ListProduct()
    {
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mBrand = new Brands();
        $mCategories = new Categories();

        $listCategories = $mCategories->getDataCategories();

        
        // Phân trang
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 10;
        $offset =  ($currentPage - 1) * $perPage;
        // Xử lý logic tìm kiếm
        // if(isset($_POST['search']))
        // {
            $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
            $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
            if (!empty($_POST['product_name']) && !empty($_POST['category_id'])) {
                // Tìm kiếm theo tên sản phẩm và danh mục
                $totalProducts = $mProduct->countAllProductsByNameAndCategoryId($categoryId,$categoryId);
                $listProduct = $mProduct->getDataProductByCategoryIdAndNameWithPagination($categoryId, $product_name, $offset, $perPage);
            }elseif (!empty($product_name)) {
                // Tìm kiếm theo tên sản phẩm
                $totalProducts = $mProduct->countAllProductsByName($product_name);
                $listProduct = $mProduct->getDataProductWithPaginationAndName($product_name, $offset, $perPage);
            } elseif (!empty($categoryId)) {
                // Lọc theo danh mục
                $totalProducts = $mProduct->countProductsByCategoryId($categoryId);
                $listProduct = $mProduct->getDataProductByCategoryIdWithPagination($categoryId, $offset, $perPage);
            } else {
                // Hiển thị tất cả sản phẩm
                $totalProducts = $mProduct->countAllProducts();
                $listProduct = $mProduct->getDataProductWithPagination($offset, $perPage);
            }
        // }

        // Tính tổng số trang
        $totalPages = ceil(($totalProducts -> total) / $perPage);
        // Hiển thị danh sách sản phẩm
        // var_dump($totalPages);
        include_once 'Views/Admin/Product/listProduct.php';
    }
        
    public function DeleteSelectedProduct()
    {
        if(isset($_POST['btn-delSelected']))
        {
            $mProduct = new Products();
            $deletedItems = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            foreach ($deletedItems as $deletedItem)
            {
                $mProduct -> deleteProduct($deletedItem);
                header('Location: index.PHP?act=ListProduct');
            }
        }
    }

    public function DeleteProduct()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $mProduct = new Products();
            $mProductVariant = new ProductsVariants();
            $mProduct -> deleteProduct($id);
            $mProductVariant -> deleteProductVariant($id);
            header('Location: index.PHP?act=ListProduct');
        }
        include_once 'Views/Admin/Brand/listProduct.php';
    }

    public function Home()
    {
        $mProduct = new Products();
        $listProductNewest = $mProduct -> getProductNewest();
        
        include_once 'Views/Users/home.php';
    }

    public function Shop()
    {
        $mProduct = new Products();
        $mProductCategories = new ProductCategories();
        $mCategories = new Categories();

        $listCategories = $mCategories->getDataCategories();
        
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 20;
        $offset =  ($currentPage - 1) * $perPage;
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
        $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
        // var_dump($product_name);
        // var_dump($categoryId);
        // die();
            if (!empty($_POST['product_name']) && !empty($_POST['category_id'])) {
                // Tìm kiếm theo tên sản phẩm và danh mục
                echo '1';
                $totalProducts = $mProduct->countAllShopByNameAndCategoryId($categoryId,$product_name);
                $listProduct = $mProduct->getDataShopByCategoryIdAndNameWithPagination($categoryId, $product_name, $offset, $perPage);
            }elseif (!empty($product_name)) {
                // Tìm kiếm theo tên sản phẩm
                echo '2';
                $totalProducts = $mProduct->countAllShopByName($product_name);
                $listProduct = $mProduct->getDataShopWithPaginationAndName($product_name, $offset, $perPage);
            } elseif (!empty($categoryId)) {
                // Lọc theo danh mục
                echo '3';
                $totalProducts = $mProduct->countShopByCategoryId($categoryId);
                $listProduct = $mProduct->getDataShopByCategoryIdWithPagination($categoryId, $offset, $perPage);
            }elseif(isset($_GET['category']) && !empty($_GET['category']))
            {
                echo '5';
                $totalProducts = $mProduct->countShopByCategoryId($_GET['category']);
                $listProduct = $mProduct->getDataShopByCategoryIdWithPagination($_GET['category'], $offset, $perPage);
            }
            else {
                // Hiển thị tất cả sản phẩm
                echo '4';
                $totalProducts = $mProduct->countAllShop();
                $listProduct = $mProduct->getDataShopWithPagination($offset, $perPage);
            }

        // Tính tổng số trang
        $totalPages = ceil(($totalProducts -> total) / $perPage);
        // Hiển thị danh sách sản phẩm
        // var_dump($totalPages);

        include_once 'Views/Users/shop.php';
    }

    public function ProductDetails()
    {
        $mProduct = new Products();
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $product_id = $_GET['id'];
            $color_id = isset($_GET['color']) ? $_GET['color'] : null; // Mặc định null nếu không có màu được chọn
            $listColor = $mProduct -> getColorAvailableInProduct($product_id);
            $relatedProduct = $mProduct -> getRelatedProduct($product_id,$product_id);

            if (!$color_id && !empty($listColor)) {
                $color_id = $listColor[0]->color_id; // Chọn màu đầu tiên từ danh sách
            }
            $listProductDetails = $mProduct -> getDataProductDetailsWithColorId($product_id,$color_id);
            // Nếu là yêu cầu AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                $response = [
                    'price' => $listProductDetails->price,
                    'secondary_images' => explode(',', $listProductDetails->secondary_images),
                    'primary_image' => $listProductDetails->primary_image,
                    'sizes' => explode(',', $listProductDetails->available_sizes),
                ];

                header('Content-Type: application/json');
                echo json_encode($response);
                exit; 
            }
        }
        include_once 'Views/Users/detailProduct.php';
    }

    public function AddCart()
    {
        $mCart = new Carts();
        $err = '';
        if(isset($_SESSION['user_id']) && isset($_POST['product_variant_id']) && isset($_POST['selected_size']))
        {
            $listCartById = $mCart -> listCartById($_POST['product_variant_id'],$_POST['selected_color'], $_POST['selected_size']);
            if(empty($listCartById))
            {
                $mCart -> addCart('',$_SESSION['user_id'],(int)$_POST['product_variant_id'],(int)$_POST['quantity'],$_POST['selected_color'],$_POST['selected_size']);
                header('Location: index.php?act=Cart');
                exit;
            }else
            {
                header('Location: index.php?act=Cart');
                exit;
            }
        }
    }

    public function Cart()
    {
        $mCart = new Carts();
        $mDiscount = new Discounts();
        $totalPrice = 0;
        if(isset($_SESSION['user_id']))
        {
            $listCart = $mCart -> listCart($_SESSION['user_id']);
        }

        // Tính tổng giá trị giỏ hàng
        foreach ($listCart as $cart) {
            $totalPrice += $cart->quantity * $cart->price;
        }

        // Kiểm tra mã giảm giá nếu có
        if (isset($_POST['apply_discount'])) {
            $discountCode = $_POST['discount_code'];

            // Truy vấn kiểm tra mã giảm giá
            $discount = $mDiscount->getDiscountByCode($discountCode); // Phương thức này cần được viết trong model

            if ($discount) {
                // Kiểm tra trạng thái và thời gian hết hạn
                $currentDate = date("Y-m-d H:i:s");
                if ($discount->is_active == 1 && strtotime($discount->end_date) > strtotime($currentDate)) {
                    // Kiểm tra điều kiện đơn hàng tối thiểu
                    if ($totalPrice >= $discount->min_order_value) {
                        // Áp dụng giảm giá
                        if ($discount->discount_type === 'percentage') {
                            $discountAmount = $totalPrice * ($discount->discount_value / 100);
                        } else if ($discount->discount_type === 'fixed') {
                            $discountAmount = $discount->discount_value;
                        }

                        // Kiểm tra giới hạn giảm giá tối đa
                        if (!empty($discount->max_discount)) {
                            $discountAmount = min($discountAmount, $discount->max_discount);
                        }

                        // Giảm giá trị usage_limit
                        if ($discount) {
                            // Kiểm tra usage_limit và used_count
                            if ($discount -> usage_limit> 0 && $discount -> used_count < $discount -> usage_limit) {
                                // Giảm usage_limit và tăng used_count
                                $mDiscount->decreaseUsageLimit($discountCode);
                                $mDiscount->increaseUsedCount($discountCode);
                            } else {
                                echo "This discount code has been used up.";
                                return;
                            }
                        }

                        // Tính giá cuối cùng sau giảm giá
                        $finalPrice = $totalPrice - $discountAmount;

                        // Lưu thông tin giảm giá vào session
                        $_SESSION['discount_code'] = $discountCode;
                        $_SESSION['discount_amount'] = $discountAmount;
                        $_SESSION['final_price'] = $finalPrice;

                        echo "Discount applied successfully! You saved $discountAmount.";
                    } else {
                        echo "Your order does not meet the minimum value requirement for this discount.";
                    }
                } else {
                    echo "The discount code is either expired or inactive.";
                }
            } else {
                echo "Invalid discount code.";
            }
        }
        include_once 'Views/Users/cart.php';
    }

    public function DeleteCart()
    {
        $mCart = new Carts();
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && isset($_GET['cartId']) && !empty($_GET['cartId']))
        {
            $mCart -> deleteCartById($_GET['cartId']);
            header('Location: ?act=Cart');
            exit;
        }
    }

    public function Checkout()
    {
        $mOrder = new Orders();
        $mCart = new Carts();
        $mUser = new MUser();

        if (isset($_SESSION['user_id'])) {
            // Lấy thông tin user và giỏ hàng
            $listUser = $mUser->getIdDataUser($_SESSION['user_id']);
            $listCart = $mCart->listCart($_SESSION['user_id']);

            // Nếu giỏ hàng không rỗng
            if (isset($listCart) && !empty($listCart)) {
                if(isset($_POST['order']))
                {
                    // 1. Thêm vào bảng `orders`
                    $order_id = uniqid(); // Tạo order_id (có thể dùng UUID hoặc auto_increment trong DB)
                    $user_id = $_SESSION['user_id'];
                    $order_date = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
                    $status = 'pending'; // Trạng thái mặc định
                    $total = $_SESSION['final_price'] ?? $_POST['total'];
                    $total = (float) $total; // Tổng giá trị đơn hàng
                    $updated_at = $order_date;

                    // Thêm dữ liệu vào bảng `orders` và lấy ID vừa thêm
                    $lastInsertId = $mOrder->addOrders('', $user_id, $order_date, $status, $total, $updated_at);

                    // 2. Thêm vào bảng `orderdetails`
                    // Lấy danh sách sản phẩm từ giỏ hàng
                    $product_variant_ids = $_POST['product_variant_id']; // Mảng ID sản phẩm
                    $quantities = $_POST['quantity'];                   // Mảng số lượng
                    $prices = $_POST['price'];                          // Mảng giá sản phẩm
                    $colors = $_POST['color'];                          // Mảng giá sản phẩm
                    $sizes = $_POST['size'];                          // Mảng giá sản phẩm

                    foreach ($product_variant_ids as $key => $product_variant_id) {
                        $order_detail_id = uniqid(); // Tạo ID cho chi tiết đơn hàng
                        $quantity = $quantities[$key];
                        $price = $prices[$key];
                        $size = $sizes[$key];
                        $color = $colors[$key];
                        // Thêm từng sản phẩm vào bảng `orderdetails`
                        $mOrder->addOrderDetails('', $lastInsertId, $product_variant_id, $quantity, $price,$size,$color);
                    }

                    // 3. Thêm vào bảng `payments`
                    $payment_id = uniqid(); // Tạo payment_id
                    $payment_method = $_POST['payment_method']; // Phương thức thanh toán (VNPay hoặc COD)
                    $payment_date = $order_date;
                    $amount = $total; // Số tiền thanh toán
                    $transaction_id = null; // Giao dịch online (nếu có)
                    $payment_status = 'pending'; // Trạng thái mặc định

                    // Thêm dữ liệu thanh toán vào bảng `payments`
                    $mOrder->addPayments('', $lastInsertId, $payment_date, $amount, $payment_method, $transaction_id, $payment_status);

                    // Xóa giỏ hàng sau khi đặt hàng thành công
                    $mCart->clearCart($user_id);
                    unset($_SESSION['discount_code']);
                    unset($_SESSION['discount_amount']);
                    unset($_SESSION['final_price']);
                    header('Location: index.php?act=Order');
                    // exit();
                    // Hiển thị thông báo
                    echo "Order has been placed successfully!";
                }
                
            } else {
                echo "Your cart is empty.";
            }
        } else {
            echo "You must log in to place an order.";
        }

        // Hiển thị trang checkout
        include_once 'Views/Users/checkout.php';
    }

    public function Order()
    {
        $mOrder = new Orders();
        if(isset($_SESSION['user_id']))
        {
            $listOrders = $mOrder -> listOrders($_SESSION['user_id']);
        }
        include_once 'Views/Users/order.php';
    }
    public function OrderDetails()
    {
        $mOrder = new Orders();
        if(isset($_SESSION['user_id']) && isset($_GET['order_id']))
        {
            $orderDetails = $mOrder -> listOrderDetails($_GET['order_id']);
            $total = 0;
            $total +=  $mOrder -> totalOrder($_GET['order_id']) -> total;
        }
        include_once 'Views/Users/orderDetails.php';
    }

    public function OrderMangage()
    {
        $mOrder = new Orders();
        $orders = $mOrder->getAllOrders();
        if(isset($_POST['updateStatus']))
        {
            if(isset($_POST['status']) && !empty($_POST['status']))
            {
                $mOrder -> updateOrderStatus($_POST['status'],$_POST['order_id']);
                header('Location: ?act=ListOrder');
            }
        }
        include_once 'Views/Admin/Order/listOrder.php';
    }

    public function OrderDetailsMangage()
    {
        $mOrder = new Orders();
        if(isset($_GET['order_id']))
        {
            $orderDetails = $mOrder -> listOrderDetails($_GET['order_id']);
            $total = 0;
            $total +=  $mOrder -> totalOrder($_GET['order_id']) -> total;
        }
        include_once 'Views/Admin/Order/detailOrder.php';
    }

}
?>  