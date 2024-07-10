<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .order {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .order h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }
        .order-info {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }
        .order-info ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        .order-info ul li {
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }
        .details {
            display: flex;
            margin-top: 10px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .details .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 20px;
        }
        .details .product-details {
            flex: 1;
        }
        .details .product-details ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        .details .product-details ul li {
            margin-bottom: 5px;
            font-size: 14px;
            color: #888;
        }
        .cancel-btn {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 10px 15px; /* Cập nhật padding để nút lớn hơn */
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Thêm hiệu ứng chuyển đổi màu */
        }
        .cancel-btn:hover {
            background-color: #e5533d; /* Thay đổi màu khi hover */
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .search-form input[type="submit"], .search-form .reload-btn {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 5px; /* Khoảng cách giữa nút Tìm kiếm và Reload */
            transition: background-color 0.3s ease; /* Thêm hiệu ứng chuyển đổi màu */
        }
        .search-form input[type="submit"]:hover, .search-form .reload-btn:hover {
            background-color: #45a049; /* Thay đổi màu khi hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Danh sách đơn hàng</h2>

    <!-- Form tìm kiếm đơn hàng -->
    <form class="search-form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="search_keyword" placeholder="Nhập từ khóa tìm kiếm...">
        <input type="submit" value="Tìm kiếm">
        <input type="button" value="Reload" class="reload-btn" onclick="window.location.href='lichsudonhang.php';">
    </form>
    
    <?php
    require_once('ketnoi.php'); // Đảm bảo rằng file kết nối đến database được bao gồm
    session_start();
    // neu chua dang nhap thi chuyen huong den trang tim kiem theo so dien thoai
    if($_SESSION['loggedin'] == false){
        header("Location: timkiemdonhang.php");
        exit;
    }
    // Hàm cập nhật trạng thái đơn hàng thành "Đã hủy"
    function cancelOrder($order_id, $conn) {
        $update_query = "UPDATE Orders SET trangthai = 'Đã hủy' WHERE order_id = $order_id";
        if (mysqli_query($conn, $update_query)) {
            echo "<p>Đơn hàng số $order_id đã được hủy.</p>";
        } else {
            echo "<p>Xảy ra lỗi khi hủy đơn hàng số $order_id: " . mysqli_error($conn) . "</p>";
        }
    }

    // Xử lý khi click vào nút hủy đơn hàng
    if (isset($_POST['cancel_order'])) {
        $order_id_to_cancel = $_POST['order_id'];
        cancelOrder($order_id_to_cancel, $conn);
    }

    // Xử lý tìm kiếm
    $search_keyword = '';
    if (isset($_GET['search_keyword'])) {
        $search_keyword = $_GET['search_keyword'];
    }

    if(isset($_SESSION['matk']))
    $user_id = $_SESSION['matk'];
    else
    
    $user_id=0;
    

    // Truy vấn để lấy danh sách đơn hàng và chi tiết của chúng
    $query = "SELECT o.order_id, o.ten_khach_hang, o.so_dien_thoai, o.dia_chi, o.ngay_dat_hang, o.ngay_nhan_hang, o.trangthai,o.tongtien,
                     od.masp, od.tensp, od.sl, od.dongia, od.size, p.anh
              FROM Orders o
              JOIN OrderDetails od ON o.order_id = od.order_id
              JOIN Product p ON od.masp = p.masp
              WHERE o.user_id = $user_id";

    // Thêm điều kiện tìm kiếm nếu có
    if (!empty($search_keyword)) {
        $query .= " AND (o.ten_khach_hang LIKE '%$search_keyword%' OR o.so_dien_thoai LIKE '%$search_keyword%')";
    }

    $query .= " ORDER BY o.ngay_dat_hang DESC";

    $result = mysqli_query($conn, $query);

    $current_order_id = null;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['order_id'] !== $current_order_id) {
                if ($current_order_id !== null) {
                    echo '</div>';
                }

                echo '<div class="order">';
                echo '<div class="order-info">';
                echo '<h3>Đơn hàng số: ' . $row['order_id'] . '</h3>';
                echo '<ul>';
                echo '<li><strong>Khách hàng:</strong> ' . $row['ten_khach_hang'] . '</li>';
                echo '<li><strong>Số điện thoại:</strong> ' . $row['so_dien_thoai'] . '</li>';
                echo '<li><strong>Địa chỉ nhận hàng:</strong> ' . $row['dia_chi'] . '</li>';
                echo '<li><strong>Ngày đặt hàng:</strong> ' . $row['ngay_dat_hang'] . '</li>';
                echo '<li><strong>Ngày nhận hàng:</strong> ' . $row['ngay_nhan_hang'] . '</li>';
                echo '<li><strong>Trạng thái:</strong> ' . $row['trangthai'] . '</li>';
                echo '<li><strong>Tổng tiền hàng:</strong> ' . $row['tongtien'] . '</li>';
                
                if ($row['trangthai'] === 'Chưa xác nhận') {
                    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="order_id" value="' . $row['order_id'] . '">';
                    echo '<button type="submit" class="cancel-btn" name="cancel_order">Hủy đơn hàng</button>';
                    echo '</form>';
                }
                
                echo '</ul>';
                echo '</div>';

                $current_order_id = $row['order_id'];
            }

            echo '<div class="details">';
            echo '<img class="product-image" src="../admin/backend_sanpham/img/' . $row['anh'] . '" alt="Product Image">';
            echo '<div class="product-details">';
            echo '<h4>Chi tiết đơn hàng:</h4>';
            echo '<ul>';
            echo '<li><strong>Sản phẩm:</strong> ' . $row['tensp'] . '</li>';
            echo '<li><strong>Số lượng:</strong> ' . $row['sl'] . '</li>';
            echo '<li><strong>Đơn giá:</strong> ' . number_format($row['dongia'], 0, ',', '.') . ' VNĐ</li>';
            echo '<li><strong>Size:</strong> ' . $row['size'] . '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<p>Không tìm thấy đơn hàng nào.</p>';
    }

    // Đóng kết nối đến database
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
