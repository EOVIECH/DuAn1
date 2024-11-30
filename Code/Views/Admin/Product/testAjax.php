<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<h1>Quản lý sản phẩm biến thể</h1>
    <form id="variantForm">
        <div id="variantsContainer">
        <!-- Dòng mẫu sản phẩm -->
        <div class="variantRow">
            <input type="text" name="size[]" placeholder="Size" required>
            <input type="text" name="color[]" placeholder="Color" required>
            <input type="number" name="price[]" placeholder="Price" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
            <button type="button" onclick="removeRow(this)">Xóa</button>
        </div>
        </div>
        <button type="button" id="addVariant">Thêm biến thể</button>
        <button type="submit">Lưu</button>
    </form>
  <div id="message"></div>
</body>
<script>
    $(document).ready(function () 
    {
        let variantIndex = 1;

        $('#addVariant').click(function () {
            const newRow = `
                <div class="variantRow">
                    <input type="text" name="size[]" placeholder="Size" required>
                    <input type="text" name="color[]" placeholder="Color" required>
                    <input type="number" name="price[]" placeholder="Price" required>
                    <input type="number" name="quantity[]" placeholder="Quantity" required>
                    <button type="button" onclick="removeRow(this)">Xóa</button>
                </div>
                `;
            $('#variantsContainer').append(newRow);
            variantIndex++;
        })
        // Xóa dòng biến thể
        window.removeRow = function (button) 
        {
            $(button).closest('.variantRow').remove();
        };

        // Xử lý form qua Ajax
        $('#variantForm').submit(function (e) {
            e.preventDefault();
            
            const formData = $(this).serialize();

            $.ajax({
                url: '../../../Controllers/Test.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#message').html('<p style="color: green;">' + response + '</p>');
                },
                error: function () {
                    $('#message').html('<p style="color: red;">Đã xảy ra lỗi!</p>');
                }
            })
        })
    })
</script>
</html>