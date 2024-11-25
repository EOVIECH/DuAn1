
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Comment</title>
    <script src="https://kit.fontawesome.com/e2b0b931b4.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .comment-container {
            width: 50%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comment-container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .comment-button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #ccc;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment-button:hover {
            background-color: #2980b9;
        }

        .rating {
            direction: rtl; /* Đảo chiều để chọn sao từ phải sang trái */
            unicode-bidi: bidi-override;
            display: inline-flex;
        }
        .rating input {
            display: none; /* Ẩn input radio */
        }
        .rating label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #f5a623; /* Màu vàng cho sao được chọn */
        }
    </style>
</head>

<body>
    <div class="comment-container">
        <h2>Để lại bình luận</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="comment">Bình luận</label>
                <textarea id="comment" name="comment" placeholder="Nhập nội dung bình luận" ></textarea>
                <br> <br>

                <div class="rating">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">&#9733;</label>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Gửi đánh giá</button>
            </div>
</form>
    </div>
</body>
</html>






