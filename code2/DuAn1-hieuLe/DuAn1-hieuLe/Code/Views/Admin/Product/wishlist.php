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
                    <th>STT</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Img</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            
                if (!empty($wishlist)){ 
                    // var_dump($listWishList);
                    // exit;
                   foreach ($wishlist as $index => $item){
                    if($item->statuss === '1'){
                            ?>
                    
                            <tr>
                            <td>
                                <?= $index+1 ?></td>
                                <td><?= $item->names ?></td>
                                <td><?= $item->brands ?></td>
                                <td style="width: 200px; height:auto;"><img src="<?= $item->images ?>" alt=""></td>
                                
                                <td>
                                   <form action="" method="post" enctype="multipart/form-data">
                                   <button name="submit" class="btn btn-danger" value="<?=$item->wishlistid?>">Xoa</button>
                                    <button  class="btn btn-primary"><a href="?act=ProductDetails&id=<?= $item->id ?>" style="color: #f4f4f4;">Chi tiet</a></button>
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