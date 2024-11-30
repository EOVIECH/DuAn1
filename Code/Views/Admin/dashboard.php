<?php
if($_SESSION['role'] && $_SESSION['role'] === 'user'){
    header('Location: ?act=login');
    var_dump($_SESSION['role']);
    exit;
} else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>ADMIN </h1>
        <h3>Chao: <?php echo $_SESSION['username'] ?></h3>
        <a href="?act=logout">Đăng xuất</a>
       <a href="?act=list-user"><button>list-user</button></a>
       <a href="?act=list-product"><button>list-product</button></a>
       <a href="?act=dataComment"><button>Comment</button></a>
    </body>
    </html>
    <?php
}
?>

