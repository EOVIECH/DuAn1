<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ AJAX
    $sizes = $_POST['size'];
    $colors = $_POST['color'];
    $prices = $_POST['price'];
    $quantities = $_POST['quantity'];

    var_dump($sizes);
    var_dump($colors);
    var_dump($prices);
    var_dump($quantities);
} else {
    echo "Yêu cầu không hợp lệ!";
}
?>