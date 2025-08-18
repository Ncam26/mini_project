<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Thêm chuyên mục</h1>
        @csrf  
        <div>
            <input type="text" name="name" placeholder="Nhập tên chuyên mục" required>
        </div>
        <?php echo csrf_field(); ?>
            <input type="submit" value="Submit">
    </form>
</body>
</html>