<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php require_once './Components/Admin/navbar.php' ?>
    <h2>Bang User</h2>
    <a href="?act=AddBrand"><button class="btn btn-secondary">Back</button></a><br>
     <div class="d-flex justify-content-center">
</div>

<div class="content-page">
<div class="container-fluid">
<form action="?act=DeleteSelectedProduct" method="post">
                <div class="table-responsive border rounded shadow-sm">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-success">
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
                        <tbody>
                            <?php foreach ($in as $index): ?>
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
                                      <a href="?act=edit-user&id=<?= $index->user_id ?>"><button class="btn btn-danger btn-sm">Sua</button></a>
                                      <a href="?act=del-user&id=<?= $index->user_id ?>"><button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $index->user_id ?>)">Xoa</button></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
</div>
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