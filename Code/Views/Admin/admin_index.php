<?php
if(isset($_SESSION['role']) && $_SESSION['role']==='user'){
    header('location: ?act=login');
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
    <h1> admin </h1>
    <?php
require_once './Components/Admin/navbar.php';
    ?>
</body>
</html>
<?php
}
?>