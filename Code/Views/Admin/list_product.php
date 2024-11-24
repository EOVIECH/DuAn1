<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Bảng danh sách sản phẩm</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ID_brand</th>
      <th scope="col">sku</th>
      <th scope="col">name</th>
      <th scope="col">description</th>
      <th scope="col">status</th>
      <th scope="col">created_at</th>
      <th scope="col">action</th>
    </tr>
  </thead>

  <?php
//   var_dump($listProduct);
//   exit;
  foreach($listProduct as $value){
    ?>
    <tbody>
    <tr>
      <th scope="row"><?= $value->product_id ?></th>
      <td><?= $value->brand_id ?></td>
      <td><?= $value->sku ?></td>
      <td><?= $value->name ?></td>
      <td><?= $value->description ?></td>
      <td><?= $value->status ?></td>
      <td><?= $value->created_at ?></td>
      <td>
      <a href=""><button class="btn btn-warning">Sua</button></a>
      <a href=""><button class="btn btn-danger">Xoa</button></a>
      <a href="?act=detail-product&id=<?php echo $value->product_id?>"><button class="btn btn-success">Xem</button></a>
      </td>
    </tr>
  </tbody>
    <?php
  }
  ?>
</table>
</body>
</html>