<?php
require_once '../admin/ketnoi.php';
include '../admin/slider.php';

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

if (!empty($_GET['search_ten_khach_hang'])) {
    $search_ten_khach_hang = mysqli_real_escape_string($conn, $_GET['search_ten_khach_hang']);
    $where_clauses[] = "ten_khach_hang LIKE '%$search_ten_khach_hang%'";
}

if (!empty($_GET['search_order_id'])) {
    $search_order_id = mysqli_real_escape_string($conn, $_GET['search_order_id']);
    $where_clauses[] = "order_id = '$search_order_id'";
}

if (!empty($_GET['search_ngay_dat_hang'])) {
    $search_ngay_dat_hang = mysqli_real_escape_string($conn, $_GET['search_ngay_dat_hang']);
    $where_clauses[] = "ngay_dat_hang = '$search_ngay_dat_hang'";
}

if (!empty($_GET['search_trang_thai'])) {
    $search_trang_thai = mysqli_real_escape_string($conn, $_GET['search_trang_thai']);
    $where_clauses[] = "trangthai = '$search_trang_thai'";
}

$where_sql = '';
if (count($where_clauses) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

// Truy vấn danh sách đơn hàng
$lietke_sql = "SELECT * FROM orders $where_sql ORDER BY order_id";
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
                <input type="text" name="search_ten_khach_hang" class="form-control" placeholder="Tìm theo tên KH" value="<?php echo isset($_GET['search_ten_khach_hang']) ? $_GET['search_ten_khach_hang'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="search_order_id" class="form-control" placeholder="Tìm theo mã đơn hàng" value="<?php echo isset($_GET['search_order_id']) ? $_GET['search_order_id'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="search_ngay_dat_hang" class="form-control" value="<?php echo isset($_GET['search_ngay_dat_hang']) ? $_GET['search_ngay_dat_hang'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <select name="search_trang_thai" class="form-control">
                    <option value="">-- Lọc theo trạng thái --</option>
                    <option value="Đang xử lý" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đang xử lý') echo 'selected'; ?>>Đang xử lý</option>
                    <option value="Chưa xác nhận" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Chưa xác nhận') echo 'selected'; ?>>Chưa xác nhận</option>
                    <option value="Đã xác nhận" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                    <option value="Đã giao hàng" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã giao hàng') echo 'selected'; ?>>Đã giao hàng</option>
                    <option value="Đã hủy" <?php if (isset($_GET['search_trang_thai']) && $_GET['search_trang_thai'] == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
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
                        <a href="in_hoa_don.php?order_id=<?php echo $r['order_id']; ?>" class="btn btn-primary"><i class="fas fa-print"></i></a>
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
</div>
