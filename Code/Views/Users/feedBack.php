<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 20px;
}

.img img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px solid #007bff;
    object-fit: cover;
}

.content {
    flex: 1;
}

.content h4 {
    margin: 5px 0;
    font-size: 18px;
    color: #333;
}

.content p {
    margin: 10px 0;
    font-size: 16px;
    line-height: 1.5;
    color: #555;
    text-align: justify;
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
        text-align: center;
    }
    .img img {
        margin-bottom: 15px;
    }
}


</style>
<body>
    <?php
    foreach($feedBack as $index){
        // var_dump($index->username);
        // exit;
    ?>
    <div class="container">
    <div class="img">
            <img src="https://tse3.mm.bing.net/th?id=OIP.njDZuvc46_VmiKUoWJ0z7wHaEK&pid=Api&P=0&h=220" alt="">
        </div>
        <div class="content">
            <h4><?php echo $index->username ?></h4>
            <p><?php echo $index->comment ?></p>
        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>