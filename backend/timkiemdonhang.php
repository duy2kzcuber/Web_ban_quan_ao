<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tìm kiếm đơn hàng theo số điện thoại</title>
<style>
    /* CSS để tạo giao diện đơn giản */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
    }
    .search-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .search-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-group input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .form-group input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<?php include '../headertrangchu.php'; 
require_once 'ketnoi.php';

?>
<br><br><br>
<div class="search-container">
    <h2>Tìm kiếm đơn hàng theo số điện thoại</h2>
    <form action="search_orders.php" method="POST">
        <div class="form-group">
            <label for="phone_number">Nhập số điện thoại:</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại..." required>
        </div>
        <div class="form-group">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>
</div>
<br><br><br><br>
<?php include '../footertrangchu.php'; ?>
</body>
</html>
