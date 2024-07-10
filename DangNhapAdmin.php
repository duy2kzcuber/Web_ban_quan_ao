<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-container input {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: auto;
            margin-right: auto;
        }

        .login-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .login-container button:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            display: none;
        }
    </style>
</head>

<body>
    <form action="" method="post" id="login">
        <div class="login-container">
            <h2>Admin Login</h2>
            <input type="text" id="username" placeholder="Username" name="username">
            <input type="password" id="password" placeholder="Password" name="password">
            <button type="submit">Login</button>
            <p class="error-message" id="error-message">Invalid username or password</p>
        </div>
    </form>
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
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $errorMessage = '';

        if ($username === 'quanli' && $password === '111') {
            // Redirect to admin page
            header('Location: /Thoitrang_VHTDT/admin/slider.php');
            exit();
        } else {
            // Set error message
            $errorMessage = 'Invalid username or password.';
        }
    }
    ?>
</body>

</html>