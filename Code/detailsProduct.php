<?php
require_once 'Models/MProduct.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $color_id = isset($_GET['color']) ? $_GET['color'] : null;

    $mProduct = new Products();
    $listColor = $mProduct->getColorAvailableInProduct($product_id);

    if (!$color_id && !empty($listColor)) {
        $color_id = $listColor[0]->color_id;
    }

    $listProductDetails = $mProduct->getDataProductDetailsWithColorId($product_id, $color_id);

    if ($listProductDetails) {
        $response = [
            'price' => $listProductDetails->price,
            'primary_image' => $listProductDetails->primary_image,
            'secondary_images' => explode(',', $listProductDetails->secondary_images),
            'sizes' => explode(',', $listProductDetails->available_sizes),
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Trả về lỗi nếu không tìm thấy dữ liệu sản phẩm
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Product details not found']);
    }
} else {
    // Trả về lỗi nếu thiếu product_id
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Product ID is required']);
}
?>