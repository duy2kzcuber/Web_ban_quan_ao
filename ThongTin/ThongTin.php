<?php
session_start();

// Handle logout request
if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../other/TrangChu.php"); // Redirect to the home page
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: Dangnhap.html");
    exit;
}

// Check if matk is provided in the session
if (!isset($_SESSION['matk'])) {
    echo "Mã tài khoản không được cung cấp.";
    exit;
}

$matk = $_SESSION['matk'];

// Fetch user information from the database using the provided matk
require_once 'ketnoi.php';

// Handle the password change request
$change_password_message = '';
if (isset($_POST['verify_password'])) {
    $old_password = $_POST['old_password'];

    // Fetch the current password from the database
    $password_sql = "SELECT mk FROM TaiKhoan WHERE matk = '$matk'";
    $result = mysqli_query($conn, $password_sql);
    $user = mysqli_fetch_assoc($result);

    // Verify the old password
    if (password_verify($old_password, $user['mk'])) {
        $_SESSION['password_verified'] = true;
    } else {
        $change_password_message = "Mật khẩu cũ không đúng.";
    }
}

if (isset($_POST['change_password']) && isset($_SESSION['password_verified']) && $_SESSION['password_verified']) {
    $new_password = $_POST['new_password'];
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_password_sql = "UPDATE TaiKhoan SET mk='$hashed_new_password' WHERE matk='$matk'";
    if (mysqli_query($conn, $update_password_sql)) {
        $change_password_message = "Mật khẩu đã được thay đổi.";
        unset($_SESSION['password_verified']);
        echo "<script>document.getElementById('change-password-button').classList.remove('hidden');</script>";
    } else {
        $change_password_message = "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}

// Handle the save request
if (isset($_POST['save'])) {
    $tenkh = $_POST['tenkh'];
    $sdt = $_POST['sdt'];
    $ns = $_POST['ns'];
    $gt = $_POST['gt'];
    $dc = $_POST['dc'];

    $update_sql = "UPDATE TaiKhoan SET tenkh='$tenkh', sdt='$sdt', ns='$ns', gt='$gt', dc='$dc' WHERE matk='$matk'";
    if (mysqli_query($conn, $update_sql)) {
        echo "Thông tin đã được cập nhật.";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}

// Fetch the updated user information
$sql = "SELECT tenkh, sdt, ns, gt, dc FROM TaiKhoan WHERE matk = '$matk'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy thông tin người dùng.";
    exit;
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
        }
        p {
            margin: 10px 0;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #333;
        }
        .hidden {
            display: none;
        }
        .message {
            color: red;
            text-align: center;
        }
    </style>
    <script>
        function enableEditing() {
            var inputs = document.querySelectorAll('input, select');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].removeAttribute('readonly');
                inputs[i].removeAttribute('disabled');
            }
            document.getElementById('edit-button').classList.add('hidden');
            document.getElementById('save-button').classList.remove('hidden');
        }

        function enablePasswordChange() {
            document.getElementById('verify-password-form').classList.remove('hidden');
            document.getElementById('change-password-button').classList.add('hidden');
        }

        function showNewPasswordField() {
            document.getElementById('new-password-form').classList.remove('hidden');
            document.getElementById('verify-password-form').classList.add('hidden');
        }

        function hideChangePasswordButton() {
            document.getElementById('change-password-button').classList.add('hidden');
        }

        function showChangePasswordButton() {
            document.getElementById('change-password-button').classList.remove('hidden');
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Thông tin người dùng</h1>
        <form id="user-form" method="post" action="">
            <p>Họ tên: <input type="text" name="tenkh" value="<?php echo htmlspecialchars($user['tenkh']); ?>" readonly></p>
            <p>SĐT: <input type="text" name="sdt" value="<?php echo htmlspecialchars($user['sdt']); ?>" readonly></p>
            <p>Ngày sinh: <input type="date" name="ns" value="<?php echo htmlspecialchars($user['ns']); ?>" readonly></p>
            <p>Giới tính: 
                <select name="gt" disabled>
                    <option value="Nam" <?php if($user['gt'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if($user['gt'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    <option value="Khác" <?php if($user['gt'] == 'Khác') echo 'selected'; ?>>Khác</option>
                </select>
            </p>
            <p>Địa chỉ: <input type="text" name="dc" value="<?php echo htmlspecialchars($user['dc']); ?>" readonly></p>
            <button type="button" id="edit-button" class="button" onclick="enableEditing()">Sửa</button>
            <button type="submit" id="save-button" class="button hidden" name="save">Lưu</button>
        </form>

        <form id="verify-password-form" method="post" action="" class="hidden">
            <p>Mật khẩu cũ: <input type="password" name="old_password"></p>
            <button type="submit" class="button" name="verify_password" onclick="hideChangePasswordButton()">Xác nhận mật khẩu cũ</button>
        </form>

        <form id="new-password-form" method="post" action="" class="<?php echo isset($_SESSION['password_verified']) && $_SESSION['password_verified'] ? '' : 'hidden'; ?>">
            <p>Mật khẩu mới: <input type="password" name="new_password"></p>
            <button type="submit" class="button" name="change_password" onclick="showChangePasswordButton()">Lưu</button>
        </form>
        
        <button type="button" id="change-password-button" class="button <?php echo isset($_SESSION['password_verified']) && $_SESSION['password_verified'] ? 'hidden' : ''; ?>" onclick="enablePasswordChange()">Đổi mật khẩu</button>

        <form method="post" action="">
            <button class="button" type="submit" name="logout">Đăng xuất</button>
        </form>
        
        <div class="message"><?php echo $change_password_message; ?></div>
    </div>
</body>
</html>
