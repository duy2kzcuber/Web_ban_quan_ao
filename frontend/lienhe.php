<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact IVY moda - Get in touch with us for any queries or support.">
    <title>Liên Hệ IVY moda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .contact-info, .contact-form {
            flex: 1;
        }
        .contact-info div, .contact-form div {
            margin-bottom: 20px;
        }
        .contact-info div p, .contact-form div p {
            margin: 5px 0;
        }
        .contact-form {
            padding: 45px; /* Increased padding */
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px 10px 10px 40px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #555;
        }
        .contact-form label {
            position: relative;
            display: block;
        }
        .contact-form label .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="cartegory-top rowe">
            <p><a href="../backend/Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p>Liên hệ</p>
        </div>
    <div class="container">
        <div class="contact-info">
            <div>
                <h3>Địa chỉ</h3>
                <p>Tầng 14, Tòa nhà Hapulico Complex 24T-85 Vũ Trọng Phụng - Quận Thanh Xuân, HN</p>
            </div>
            <div>
                <h3>Email</h3>
                <p>saleadmin@vhtdt.com.vn</p>
            </div>
            <div>
                <h3>Mua hàng online</h3>
                <p>+ (84) 24 6662 3434</p>
            </div>
            <div>
                <h3>Chăm sóc khách hàng</h3>
                <p>Email: cskh@vhtdt.com.vn</p>
                <p>Hotline: 0905 89 86 83</p>
                <p>Thứ Hai đến Thứ Bảy, từ 8:00 đến 17:30</p>
            </div>
        </div>
        <div class="contact-form">
            <h3>Email to VHTDT</h3>
            <p>We are here to help and answer any question you might have. Tell us about your issue so we can help you more quickly. We look forward to hearing from you.</p>
            <form>
                <div>
                    <label for="name">
                        <i class="fas fa-user icon"></i>
                        <input type="text" id="name" name="name" placeholder="Họ và tên" required>
                    </label>
                </div>
                <div>
                    <label for="phone">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" id="phone" name="phone" placeholder="Điện thoại" required>
                    </label>
                </div>
                <div>
                    <label for="email">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" id="email" name="email" placeholder="Địa chỉ email" required>
                    </label>
                </div>
                <div>
                    <label for="subject">
                        <i class="fas fa-tag icon"></i>
                        <input type="text" id="subject" name="subject" placeholder="Chủ đề" required>
                    </label>
                </div>
                <div>
                    <label for="message">
                        <i class="fas fa-comment icon"></i>
                        <textarea id="message" name="message" rows="4" placeholder="Nội dung" required></textarea>
                    </label>
                </div>
                <div>
                    <label for="captcha">
                        <i class="fas fa-lock icon"></i>
                        <input type="text" id="captcha" name="captcha" placeholder="Nhập mã captcha" required>
                    </label>
                </div>
                <div>
                    <button type="submit">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
