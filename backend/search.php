<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="styles.css"> <!-- Đảm bảo rằng bạn có file styles.css chứa các CSS cần thiết -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
        }
        ul li a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        ul li a:hover {
            color: #0056b3;
        }
        .no-results {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Bắt đầu session nếu chưa tồn tại
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Kết nối CSDL
        require_once 'ketnoi.php';

        // Kiểm tra xem đã gửi từ khóa tìm kiếm chưa
        if (isset($_GET['tendm'])) {
            // Lấy từ khóa tìm kiếm từ URL
            $tendm = $_GET['tendm'];

            // Truy vấn SQL để lấy danh sách sản phẩm theo tên danh mục với sử dụng prepared statements
            $query = "
                SELECT sp.masp, sp.tensp 
                FROM product sp 
                INNER JOIN danhmuc dm ON sp.madm = dm.madm 
                WHERE dm.tendm LIKE ?
            ";

            // Chuẩn bị câu lệnh SQL
            $stmt = mysqli_prepare($conn, $query);

            // Kiểm tra và bind tham số
            if ($stmt) {
                $tendm_param = '%' . $tendm . '%';
                mysqli_stmt_bind_param($stmt, "s", $tendm_param);

                // Thực thi câu lệnh SQL
                mysqli_stmt_execute($stmt);

                // Lấy kết quả
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    echo '<h2>Kết quả tìm kiếm cho: ' . htmlspecialchars($tendm) . '</h2>';
                    echo '<ul>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a href="product.php?masp=' . htmlspecialchars($row['masp']) . '">' . htmlspecialchars($row['tensp']) . '</a></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p class="no-results">Không tìm thấy sản phẩm nào phù hợp với từ khóa: ' . htmlspecialchars($tendm) . '</p>';
                }

                // Giải phóng kết quả
                mysqli_stmt_close($stmt);
            } else {
                echo "Lỗi trong quá trình chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
            }

            // Đóng kết nối
            mysqli_close($conn);
        } else {
            // Nếu không có từ khóa tìm kiếm được gửi đến, hiển thị thông báo lỗi
            echo '<p class="no-results">Vui lòng nhập từ khóa tìm kiếm.</p>';
        }
        ?>
    </div>
</body>
</html>
