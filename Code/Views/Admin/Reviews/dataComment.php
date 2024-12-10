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
    <?php require_once 'Components/Admin/navbar.php' ?>

    <div class="content-page">
        <div class="container-fluid">

            <div class="comments">
                <h1> Theo dõi bình luận</h1>
                <!-- <a href="?act=AddBrand"><button class="btn btn-secondary">Back</button></a>
    <br> -->
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    $searchs = isset($filter) ? '' : '<input type="text" name="input" placeholder="tim kiem" require>
                                <button type="submit" name="search">tim</button>';
                    // echo $searchs;
                    ?>

                    <?php
                    $filters = isset($search) ? '' : '<input type="date" name="filter_input" placeholder="lọc ngày đăng">
                                <button type="submit" name="filter">filter</button>';

                    // echo $filters;
                    ?>
                </form>
                <form action="" method="post">
                    <div class="table-responsive border rounded shadow-sm">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($search)) {
                                    foreach ($search as $index) {
                                        $status = ($index->status == 'active') ? 'active' : 'Inactive';
                                ?>

                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $index->review_id ?></th>
                                    <td><?php echo $index->username ?></td>
                                    <td><?php echo $index->name ?></td>
                                    <td><?php echo $index->comment ?></td>
                                    <td><?php echo $index->created_at ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <a href=""><button class="btn btn-danger btn-sm">Xoa</button></a>
                                            <?php
                                            $duyet = ($index->status == 'active') ? null : '<button name="submit" class="btn btn-danger btn-sm" value="' . $index->review_id . '">Duyet</button>';
                                            echo $duyet;
                                            ?>
                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                        <?php
                                    }
                                } elseif (!empty($filter)) {
                                    foreach ($filter as $index) {

                                        $status = ($index->status == 'active') ? 'active' : 'Inactive';
                        ?>

                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $index->review_id ?></th>
                                    <td><?php echo $index->username ?></td>
                                    <td><?php echo $index->name ?></td>
                                    <td><?php echo $index->comment ?></td>
                                    <td><?php echo $index->created_at ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <a href=""><button class="btn btn-danger btn-sm">Xoa</button></a>
                                            <?php
                                            $duyet = ($index->status == 'active') ? null : '<button name="submit" class="btn btn-danger btn-sm" value="' . $index->review_id . '">Duyet</button>';
                                            echo $duyet;
                                            ?>
                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                        <?php
                                    }
                                } else {
                                    foreach ($result as $index) {
                                        $status = ($index->status == 'active') ? 'active' : 'Inactive';
                        ?>

                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $index->review_id ?></th>
                                    <td><?php echo $index->username ?></td>
                                    <td><?php echo $index->name ?></td>
                                    <td><?php echo $index->comment ?></td>
                                    <td><?php echo $index->created_at ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <a href=""><button class="btn btn-danger btn-sm">Xoa</button></a>
                                            <?php
                                            $duyet = ($index->status == 'active') ? null : '<button name="submit" class="btn btn-danger btn-sm" value="' . $index->review_id . '">Duyet</button>';
                                            echo $duyet;
                                            ?>
                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                    <?php
                                    }
                                }

                    ?>
                    </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>
</body>

</html>