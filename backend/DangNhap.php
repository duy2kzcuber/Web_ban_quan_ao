<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
        margin: 30px auto;
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

    .form-group input {
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

    .options, .links {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
    }

    .options a, .links a {
        color: #000;
        text-decoration: none;
    }

    .options a, .links a {
        text-decoration: underline;
    }
</style>
<body>
<div class="cartegory-top rowe">
            <p><a href="Trangchu.php">Trang chủ</a><span>&#10230;</span>Thông tin </p>
        </div>
    <div class="form-container">
        <h1>ĐĂNG NHẬP</h1>
        <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'ketnoi.php';

            $sdt = $_POST['sdt'];
            $mk = $_POST['mk'];
            

            // Kiểm tra xem tài khoản có tồn tại không
            $sql_check = "SELECT * FROM TaiKhoan WHERE sdt = '$sdt' ";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                $row = mysqli_fetch_assoc($result_check);
                if (password_verify($mk, $row['mk'])) {
                    // Tạo session cho người dùng
                    
                    $_SESSION['loggedin'] = true;
                    $_SESSION['matk'] = $row['matk'];
              
                    if (isset($_POST['remember'])) {
                        // Đặt cookie cho session với thời hạn 30 ngày
                        setcookie(session_name(), session_id(), time() + (30 * 24 * 60 * 60), "/");
                    }
                    // Chuyển hướng đến trang khác sau khi đăng nhập thành công (ví dụ: trang chủ)
                    header("Location:TrangChu.php");
                    exit;
                } else {
                    $message = "Mật khẩu không đúng!";
                }
            } else {
                $message = "Tài khoản không tồn tại!";
            }

            // Đóng kết nối
            mysqli_close($conn);
        }
        ?>
        <form id="login-form" method="post" action="">
            <div class="form-group">
                <label for="sdt">SĐT<span>*</span></label>
                <input type="text" id="sdt" name="sdt" required>
            </div>
            <div class="form-group">
                <label for="mat-khau">Mật khẩu:<span>*</span></label>
                <input type="password" id="mk" name="mk" required>
            </div>
            <div class="options">
                <label>
                    <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
                <a href="#">Quên mật khẩu?</a>
            </div>
            
            <button type="submit">Đăng nhập</button>
        </form>
        <div  id="message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            var emailSdt = document.getElementById('sdt').value.trim();
            var matkhau = document.getElementById('mk').value.trim();
            var messageElement = document.getElementById('message');

            if (!emailSdt || !matkhau) {
                event.preventDefault();
                messageElement.textContent = "Vui lòng điền đầy đủ thông tin!";
                return;
            }
        });
    </script>

<div class="form-container " >
            <h2>Khách hàng mới của VHTDT</h2>
            
            <button><a style="color:rgb(245, 247, 247);" href="DangKy.php">Đăng Ký</a></button>
        </div>
</body>
</html>
