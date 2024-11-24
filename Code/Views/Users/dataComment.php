<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    body{
        max-width: 70%;
       position: relative;
       left: 100px;
       top: 30px;
       height: 2000px;
    }

</style>
<body>
    <h1> Theo dõi bình luận</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">San Pham</th>
      <th scope="col">Noi dung</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php
// var_dump($data);
foreach($data as $index){
    ?>
            <tbody>
                <tr>
                <th scope="row"><?php echo $index->review_id ?></th>
                <td><?php echo $index->username ?></td>
                <td><?php echo $index->name  ?></td>
                <td><?php echo $index->comment  ?></td>
                <td>
        <a href=""><button class="btn btn-danger">Xoa</button></a>
      </td>
                </tr>
            </tbody>
    <?php
}
  ?>

</table>
</body>
</html>