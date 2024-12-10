<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
  .table{
    max-width: 90%;
    margin: 20px auto;
  }

  h2{
    position: relative;
    left: 300px;
    top: 90px;
  }

  body>a>button {
    position: relative;
    left: 80px;
    top: 10px;
    
  }
  .contents{
    width: 1400px;
  }

 table {
        max-width: 100%;
        padding-left: 70px;
        position: relative;
        left: 220px;
        top: 50px;
  }


</style>
<body>
<?php require_once './Components/Admin/navbar.php' ?>
    <h2>Bang User</h2>
    <a href="?act=AddBrand"><button class="btn btn-secondary">Back</button></a><br>
     <div class="d-flex justify-content-center">
</div>
    <div class="contents">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">role</th>
      <th scope="col">Create_at</th>
      <th scope="col">Status</th>
      <th scope="col">
            Action
      </th>
    </tr>
  </thead>
  <?php
  foreach($in as $index){
?>

  <tbody>
    <tr>
      <th scope="row"><?= $index->user_id ?></th>
      <td><?= $index->username ?></td>
      <td><?= $index->email ?></td>
      <td><?= $index->phone ?></td>
      <td><?= $index->address ?></td>
      <td><?= $index->role ?></td>
      <td><?= $index->created_at ?></td>
      <td><?= $index->status ?></td>
      <td>
        <a href="?act=edit-user&id=<?= $index->user_id ?>"><button class="btn btn-warning">Sua</button></a>
        <a href="?act=del-user&id=<?= $index->user_id ?>"><button class="btn btn-danger" onclick="confirmDelete(<?= $index->user_id ?>)">Xoa</button></a>
      </td>
    </tr>
  </tbody>
  <?php
    }
    ?>
</table>

    </div>
</body>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = "?act=del-user&id=" + id;
        }
    }
</script>
</html>

<!-- $status = "active"; // Giá trị trạng thái có thể là "active" hoặc "inactive"

// Sử dụng toán tử ba ngôi để xác định màu sắc nút
$buttonColor = ($status === "active") ? "green" : "red";

// Xuất ra mã HTML -->
<!-- echo "<button style='background-color: $buttonColor;'>Trạng thái: $status</button>"; -->