<?php
if(isset($_GET['id']) && $_GET['color'] !== '' && $_GET['size'] !== ''){
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>Sản phẩm yêu thích</title>
        <style>
            table {
                width: 80%;
                height: auto;
                margin: 20px auto;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }
            th {
                background-color: #f4f4f4;
            }
        </style>
    </head>
    <body>
        <?php
        require_once './components/User/header.php';
        ?>
        <h1 style="text-align: center;">Sản phẩm yêu thích</h1>
        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Color</th>
                    <th>size</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            
                if (!empty($listWishList)){ 
                    // var_dump($listWishList);
                    // exit;
                   foreach ($listWishList as $item){
                    if($item->statuss === '1'){
                    ?>
                            <tr>
                                <td><?= $item->product ?></td>
                                <td><?= $item->color ?></td>
                                <td><?= $item->sizez ?></td>
                                <td><?= $item->price ?></td>
                                <td>
                                   <form action="" method="post" enctype="multipart/form-data">
                                   <button name="submit" class="btn btn-danger" value="<?= $item->id ?>">Xoa</button>
                                   <button class="btn btn-primary">Mua</button>
                                   </form>
                                </td>
                            </tr>
                        <?php
                           } 
                    } 
                }

                        ?>
            
            </tbody>
        </table>
    </body>

    <?php
        require_once './components/User/footer.php';
        ?>
    </html>
    <?php
}
else if(empty($_SESSION['user_id'])){
    echo "<script>
    alert('Bạn không chưa đăng nhập');
    window.location.href = '?act=login';
    </script>";
    exit;
} else{
    echo "<script>
    alert('NOT FOUND 404');
    window.location.href = '?act=Home';
    </script>";
    exit;
}
?>