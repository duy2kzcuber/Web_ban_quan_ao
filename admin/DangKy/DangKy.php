<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../ketnoi.php';

    $tenkh = trim($_POST['tenkh']);
    $sdt = trim($_POST['sdt']);
    $ns = trim($_POST['ns']);
    $gt = trim($_POST['gt']);
    $em = trim($_POST['em']);
    $dc = trim($_POST['dc']);
    $mk = trim($_POST['mk']);

    // Mã hóa mật khẩu
    $mk = password_hash($mk, PASSWORD_DEFAULT);

    // Kiểm tra xem số điện thoại đã tồn tại chưa
    $sql_check = "SELECT * FROM khachhang WHERE sdt = '$sdt'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Số điện thoại đã được đăng ký!";
    } else {
        // Đếm số lượng tài khoản hiện có
        $sql_count = "SELECT COUNT(*) AS total FROM khachhang";
        $result = mysqli_query($conn, $sql_count);
        $row = mysqli_fetch_assoc($result); 
       // $matk = 'TK' . ($row['total'] + 1);

        // Tạo câu lệnh SQL để chèn dữ liệu vào bảng bao gồm cả matk
        $sql = "INSERT INTO khachhang ( tenkh, sdt, ns, gioitinh, diachi, mk, email) VALUES ( '$tenkh', '$sdt', '$ns', '$gt', '$dc', '$mk', '$em')";

        // Thực thi câu lệnh SQL
        if (mysqli_query($conn, $sql)) {
            // Chuyển hướng sau khi đăng ký thành công
            header("Location: ../DangNhap/DangNhap.php");
            exit;
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .form-group input[type="checkbox"] {
        width: auto;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #333;
    }

    #message {
        margin-top: 20px;
        text-align: center;
        color: red;
    }
</style>
<body>
    <div class="form-container">
        <h1>ĐĂNG KÝ</h1>
        <form id="registration-form" method="post" action="">
            <div class="form-group">
                <label for="hoten">Họ tên<span>*</span></label>
                <input type="text" id="hoten" name="tenkh" required>
            </div>
            
            <div class="form-group">
                <label for="dien-thoai">Điện thoại:<span>*</span></label>
                <input type="text" id="dien-thoai" name="sdt" required>
            </div>
            <div class="form-group">
                <label for="ngay-sinh">Ngày sinh:<span>*</span></label>
                <input type="date" id="ngay-sinh" name="ns" required>
            </div>
            <div class="form-group">
                <label for="gioi-tinh">Giới tính:<span>*</span></label>
                <select id="gioi-tinh" name="gt" required>
                    <option value="Nữ">Nữ</option>
                    <option value="Nam">Nam</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="dia-chi">Địa chỉ:<span>*</span></label>
                <input type="text" id="dia-chi" name="dc" required>
            </div>
            <div class="form-group">
                <label for="email">Email<span>*</span></label>
                <input type="text" id="email" name="em" required>
            </div>
            <div class="form-group">
                <label for="mat-khau">Mật khẩu:<span>*</span></label>
                <input type="password" id="mat-khau" name="mk" required>
            </div>
            <div class="form-group">
                <label for="nhap-lai-mat-khau">Nhập lại mật khẩu:<span>*</span></label>
                <input type="password" id="nhap-lai-mat-khau" name="nhap-lai-mat-khau" required>
            </div>
            
            <div class="form-group">
                <input type="checkbox" id="dong-y-dieu-khoan" name="dong-y-dieu-khoan" required>
                <label for="dong-y-dieu-khoan">Đồng ý với các <a href="#">điều khoản</a> của IVY</label>
            </div>

            <button type="submit">ĐĂNG KÝ</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            var hoten = document.getElementById('hoten').value.trim();
            var dienthoai = document.getElementById('dien-thoai').value.trim();
            var ngaysinh = document.getElementById('ngay-sinh').value;
            var diachi = document.getElementById('dia-chi').value.trim();
            var matkhau = document.getElementById('mat-khau').value.trim();
            var nhaplaimatkhau = document.getElementById('nhap-lai-mat-khau').value.trim();
            var dongydieukhoan = document.getElementById('dong-y-dieu-khoan').checked;
            var messageElement = document.getElementById('message');

            if (!hoten || !dienthoai || !ngaysinh || !diachi || !matkhau || !nhaplaimatkhau) {
                event.preventDefault();
                messageElement.textContent = "Vui lòng điền đầy đủ thông tin!";
                return;
            }

            if (matkhau !== nhaplaimatkhau) {
                event.preventDefault();
                messageElement.textContent = "Mật khẩu nhập lại không khớp!";
                return;
            }

            if (!dongydieukhoan) {
                event.preventDefault();
                messageElement.textContent = "Bạn phải đồng ý với các điều khoản!";
                return;
            }
        });
    </script>
</body>
</html>
