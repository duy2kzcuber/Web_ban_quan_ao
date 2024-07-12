<?php
require_once '../ketnoi.php'; // Đường dẫn tương đối đến file kết nối
include '../slider.php';

// Xử lý cập nhật trạng thái nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['trang_thai'])) {
    $order_id = $_POST['order_id'];
    $trang_thai = $_POST['trang_thai'];

    // Cập nhật trạng thái đơn hàng vào cơ sở dữ liệu
    $update_sql = "UPDATE orders SET trangthai = '$trang_thai' WHERE order_id = $order_id";
    $update_result = mysqli_query($conn, $update_sql);

    if (!$update_result) {
        echo "Lỗi cập nhật trạng thái: " . mysqli_error($conn);
        exit;
    }
}

// Xử lý tìm kiếm và lọc
$where_clauses = [];

if (!empty($_GET['search_ten_khach_hang_order_id'])) {
    $search_ten_khach_hang_order_id = $_GET['search_ten_khach_hang_order_id'];
    $where_clauses[] = "(ten_khach_hang LIKE '%$search_ten_khach_hang_order_id%' OR order_id = '$search_ten_khach_hang_order_id')";
}

if (!empty($_GET['search_ngay_dat_hang'])) {
    $search_ngay_dat_hang = $_GET['search_ngay_dat_hang'];
    $where_clauses[] = "ngay_dat_hang = '$search_ngay_dat_hang'";
}

if (!empty($_GET['search_trang_thai'])) {
    $search_trang_thai =  $_GET['search_trang_thai'];
    $where_clauses[] = "trangthai = '$search_trang_thai'";
}

$where_sql = '';
if (count($where_clauses) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

// Phân trang
$limit = 4; // Số bản ghi trên mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Tính tổng số trang
$total_sql = "SELECT COUNT(*) FROM orders $where_sql";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_row($total_result);
$total_records = $total_row[0];
$total_pages = ceil($total_records / $limit);

// Truy vấn danh sách đơn hàng với phân trang
$lietke_sql = "SELECT * FROM orders $where_sql ORDER BY order_id LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $lietke_sql);

if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
    exit;
}
?>

<div class="container">
    <h1>DANH SÁCH ĐƠN HÀNG</h1>
    <form method="GET" action="">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search_ten_khach_hang_order_id" class="form-control" placeholder="Tìm theo tên KH hoặc mã đơn hàng" value="<?php echo isset($_GET['search_ten_khach_hang_order_id']) ? $_GET['search_ten_khach_hang_order_id'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="search_ngay_dat_hang" class="form-control" value="<?php echo isset($_GET['search_ngay_dat_hang']) ? $_GET['search_ngay_dat_hang'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <select name="search_trang_thai" class="form-control">
                    <option value="">-- Lọc theo trạng thái --</option>
                    <option value="Đang xử lý" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đang xử lý') echo 'selected'; ?>>Đang xử lý</option>
                    <option value="Chờ xác nhận" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Chờ xác nhận') echo 'selected'; ?>>Chờ xác nhận</option>
                    <option value="Đã xác nhận" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                    <option value="Đã giao hàng" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã giao hàng') echo 'selected'; ?>>Đã giao hàng</option>
                    <option value="Đã hoàn hàng" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã hoàn hàng') echo 'selected'; ?>>Đã hoàn hàng</option>
                    <option value="Đã hủy" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                    <option value="Hoàn hàng" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Hoàn hàng') echo 'selected'; ?>>Hoàn hàng</option>
                </select>
            </div>
            <div class="col md-3">
            
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        
        </div>
       
    </form>
    <table class="table table-dark mt-3">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên KH</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt</th>
                <th>Ngày nhận(dự kiến)</th>
                <th>Trạng thái</th>
                <th>Phương thức TT</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
                <th>Tổng tiền đơn hàng </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $r['order_id']; ?></td>
                    <td><?php echo $r['ten_khach_hang']; ?></td>
                    <td><?php echo $r['so_dien_thoai']; ?></td>
                    <td><?php echo $r['dia_chi']; ?></td>
                    <td><?php echo $r['ngay_dat_hang']; ?></td>
                    <td><?php echo $r['ngay_nhan_hang']; ?></td>
                    <td><?php echo $r['trangthai']; ?></td>
                    <td><?php echo $r['pttt']; ?></td>
                    <td><?php echo $r['tongtien']; ?> VNĐ</td>
                    <td>
                        <a href="Chitietdonhang.php?order_id=<?php echo $r['order_id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="hoadon.php?order_id=<?php echo $r['order_id']; ?>" class="btn btn-primary"><i class="fas fa-print"></i></a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit<?php echo $r['order_id']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Chỉnh sửa trạng thái đơn hàng -->
                <div class="modal fade" id="myModalEdit<?php echo $r['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Cập nhật trạng thái đơn hàng #<?php echo $r['order_id']; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>">
                                    <div class="form-group">
                                        <label for="trang_thai">Trạng thái mới:</label>
                                        <select name="trang_thai" id="trang_thai" class="form-control">
                                            <option value="Đang xử lý" <?php if ($r['trangthai'] == 'Đang xử lý') echo 'selected'; ?>>Đang xử lý</option>
                                            <option value="Chưa xác nhận" <?php if ($r['trangthai'] == 'Chưa xác nhận') echo 'selected'; ?>>Chưa xác nhận</option>
                                            <option value="Đã xác nhận" <?php if ($r['trangthai'] == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                                            <option value="Đã giao hàng" <?php if ($r['trangthai'] == 'Đã giao hàng') echo 'selected'; ?>>Đã giao hàng</option>
                                            <option value="Đã hủy" <?php if ($r['trangthai'] == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                                            <option value="Hoàn hàng" <?php if ($r['trangthai'] == 'Hoàn hàng') echo 'selected'; ?>>Hoàn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>

    
    <!-- Hiển thị phân trang -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
