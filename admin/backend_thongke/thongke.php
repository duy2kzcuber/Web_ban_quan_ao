<?php 
  include "../slider.php";
// Kết nối đến cơ sở dữ liệu
require_once '../ketnoi.php';
// Lấy filter ngày tháng năm từ request (nếu có)
$filter_date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
$filter_date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';
$filter_year = isset($_POST['year']) ? $_POST['year'] : date('Y');

// Khởi tạo các biến thống kê với giá trị 0
$total_orders = 0;
$delivered_orders = 0;
$cancelled_orders = 0;
$total_revenue = 0;
$new_customers = 0;

// Chỉ thực hiện truy vấn nếu có giá trị filter ngày
if ($filter_date_from || $filter_date_to) {
    // Xây dựng câu truy vấn SQL cho đơn hàng
    $sql = "SELECT 
                COUNT(*) AS total_orders, 
                SUM(CASE WHEN trangthai = 'Đã giao hàng' THEN 1 ELSE 0 END) AS delivered_orders,
                SUM(CASE WHEN trangthai = 'Đã hủy' THEN 1 ELSE 0 END) AS cancelled_orders,
                SUM(CASE WHEN trangthai = 'Đã giao hàng' THEN tongtien ELSE 0 END) AS total_revenue
            FROM orders
            WHERE 1=1";

    if ($filter_date_from) {
        $sql .= " AND ngay_dat_hang >= '$filter_date_from'";
    }

    if ($filter_date_to) {
        $sql .= " AND ngay_dat_hang <= '$filter_date_to'";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_orders = $row['total_orders'];
        $delivered_orders = $row['delivered_orders'];
        $cancelled_orders = $row['cancelled_orders'];
        $total_revenue = $row['total_revenue'];
    }

    // Xây dựng câu truy vấn SQL cho khách hàng mới
    $sql_new_customers = "SELECT COUNT(*) AS new_customers FROM taikhoan WHERE 1=1";
    if ($filter_date_from) {
        $sql_new_customers .= " AND tgtao >= '$filter_date_from'";
    }
    if ($filter_date_to) {
        $sql_new_customers .= " AND tgtao <= '$filter_date_to'";
    }

    $result_new_customers = $conn->query($sql_new_customers);

    if ($result_new_customers && $result_new_customers->num_rows > 0) {
        $row = $result_new_customers->fetch_assoc();
        $new_customers = $row['new_customers'];
    }

    // Lấy danh sách sản phẩm đã bán theo filter ngày
    $sql_product_sales = "SELECT 
                            p.masp, 
                            p.tensp, 
                            p.anh, 
                            SUM(od.sl) AS total_sold, 
                            SUM(od.sl * od.dongia) AS total_revenue
                          FROM orderdetails od
                          INNER JOIN orders o ON od.order_id = o.order_id
                          INNER JOIN product p ON od.masp = p.masp
                          WHERE o.trangthai = 'Đã giao hàng'";

    if ($filter_date_from) {
        $sql_product_sales .= " AND o.ngay_dat_hang >= '$filter_date_from'";
    }

    if ($filter_date_to) {
        $sql_product_sales .= " AND o.ngay_dat_hang <= '$filter_date_to'";
    }

    $sql_product_sales .= " GROUP BY p.masp, p.tensp, p.anh";
    $result_product_sales = $conn->query($sql_product_sales);
} else {
    $result_product_sales = false;
}

// Lấy dữ liệu doanh thu theo tháng cho năm được chọn
$sql_revenue_by_month = "SELECT 
                            MONTH(ngay_dat_hang) AS month, 
                            SUM(CASE WHEN trangthai = 'Đã giao hàng' THEN tongtien ELSE 0 END) AS monthly_revenue
                        FROM orders
                        WHERE YEAR(ngay_dat_hang) = '$filter_year'
                        GROUP BY MONTH(ngay_dat_hang)";
$result_revenue_by_month = $conn->query($sql_revenue_by_month);

$revenues = array_fill(1, 12, 0); // Tạo mảng 12 tháng với giá trị mặc định là 0

if ($result_revenue_by_month && $result_revenue_by_month->num_rows > 0) {
    while ($row = $result_revenue_by_month->fetch_assoc()) {
        $revenues[$row['month']] = $row['monthly_revenue'];
    }
}

// Tính tổng doanh thu của năm
$total_year_revenue = array_sum($revenues);

// Thống kê tổng số đơn hàng của năm
$sql_year_orders = "SELECT 
                        COUNT(*) AS total_year_orders,
                        SUM(CASE WHEN trangthai = 'Đã giao hàng' THEN 1 ELSE 0 END) AS delivered_year_orders,
                        SUM(CASE WHEN trangthai = 'Đã hủy' THEN 1 ELSE 0 END) AS cancelled_year_orders
                    FROM orders
                    WHERE YEAR(ngay_dat_hang) = '$filter_year'";
$result_year_orders = $conn->query($sql_year_orders);

$total_year_orders = 0;
$delivered_year_orders = 0;
$cancelled_year_orders = 0;

if ($result_year_orders && $result_year_orders->num_rows > 0) {
    $row = $result_year_orders->fetch_assoc();
    $total_year_orders = $row['total_year_orders'];
    $delivered_year_orders = $row['delivered_year_orders'];
    $cancelled_year_orders = $row['cancelled_year_orders'];
}

// Thống kê số khách hàng mới của năm
$sql_year_new_customers = "SELECT COUNT(*) AS new_year_customers FROM taikhoan WHERE YEAR(tgtao) = '$filter_year'";
$result_year_new_customers = $conn->query($sql_year_new_customers);

$new_year_customers = 0;

if ($result_year_new_customers && $result_year_new_customers->num_rows > 0) {
    $row = $result_year_new_customers->fetch_assoc();
    $new_year_customers = $row['new_year_customers'];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thống kê</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: red;
        }
        form {
            display: flex;
            margin-bottom: 20px;
        }
        form label {
            margin-right: 10px;
        }
        form input[type="date"],
        form input[type="text"] {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        form input[type="submit"] {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .stats div {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 18%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .stats div p {
            margin: 5px 0;
            font-size: 1.2em;
        }
        h2 {
            color: #007BFF;
        }
        #revenueChart {
            max-height: 300px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thống kê</h1>
        <form method="post" action="">
            <label for="date_from">Từ ngày:</label>
            <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($filter_date_from); ?>">
            <label for="date_to">Đến ngày:</label>
            <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($filter_date_to); ?>">
            <input type="submit" value="Lọc">
        </form>

        <div class="stats">
            <div>
                <p>Tổng số đơn hàng</p>
                <p style="color: red;"><?php echo $total_orders; ?></p>
            </div>
            <div>
                <p>Số đơn hàng đã giao</p>
                <p style="color: red;"><?php echo $delivered_orders; ?></p>
            </div>
            <div>
                <p>Số đơn hàng đã hủy</p>
                <p style="color: red;"><?php echo $cancelled_orders; ?></p>
            </div>
            <div>
                <p>Tổng doanh thu</p>
                <p style="color: red;"><?php echo number_format($total_revenue); ?> VND</p>
            </div>
            <div>
                <p>Số khách hàng mới</p>
                <p style="color: red;"><?php echo $new_customers; ?></p>
            </div>
        </div>

        <h2>Danh sách sản phẩm bán ra</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Số lượng đã bán</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_product_sales && $result_product_sales->num_rows > 0): ?>
                    <?php while ($row = $result_product_sales->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['masp']; ?></td>
                            <td><?php echo $row['tensp']; ?></td>
                            <td><img src="../backend_sanpham/img/<?php echo $row['anh']; ?>" alt="<?php echo $row['tensp']; ?>"></td>
                            <td><?php echo $row['total_sold']; ?></td>
                            <td><?php echo number_format($row['total_revenue']); ?> VND</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Không có sản phẩm nào được bán trong khoảng thời gian này.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Thống kê theo năm</h2>
        <form method="post" action="">
            <label for="year">Năm:</label>
            <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($filter_year); ?>">
            <input type="submit" value="Lọc">
        </form>
        <div class="stats">
            <div>
                <p>Tổng số đơn hàng của năm <?php echo $filter_year; ?></p>
                <p style="color: red;"><?php echo $total_year_orders; ?></p>
            </div>
            <div>
                <p>Số đơn hàng đã giao của năm <?php echo $filter_year; ?></p>
                <p style="color: red;"><?php echo $delivered_year_orders; ?></p>
            </div>
            <div>
                <p>Số đơn hàng đã hủy của năm <?php echo $filter_year; ?></p>
                <p style="color: red;"><?php echo $cancelled_year_orders; ?></p>
            </div>
            <div>
                <p>Số khách hàng mới của năm <?php echo $filter_year; ?></p>
                <p style="color: red;"><?php echo $new_year_customers; ?></p>
            </div>
            <div>
                <p>Tổng doanh thu năm <?php echo $filter_year; ?></p>
                <p style="color: red;"><?php echo number_format($total_year_revenue); ?> VND</p>
            </div>
        </div>
        <canvas id="revenueChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu',
                    data: <?php echo json_encode(array_values($revenues)); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value) {
                            return new Intl.NumberFormat().format(value) + ' VND';
                        },
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });
    </script>
</body>
</html>
