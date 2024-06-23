<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đơn hàng của khách</title>
<style>
  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  /* CSS cho form và các mục đơn hàng */
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .order-container {
    width: 100%;
    max-width: 800px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    overflow: hidden; /* Tránh nội dung rò rỉ */
    padding: 20px;
  }

  .order-item {
    display: flex;
    padding: 15px;
    border-bottom: 1px solid #eee;
  }

  .order-item:last-child {
    border-bottom: none; /* Không có đường viền dưới cùng */
  }

  .image-container {
    flex: 0 0 100px; /* Kích thước cố định cho hình ảnh */
    margin-right: 15px;
    overflow: hidden; /* Giữ cho hình ảnh không tràn ra */
  }

  .image-container img {
    width: 100%;
    height: auto;
    border-radius: 4px;
  }

  .details {
    flex: 1; /* Phần còn lại của đơn hàng */
  }

  .details h3 {
    margin-bottom: 5px;
    font-size: 18px;
    color: #333;
  }

  .details p {
    margin-bottom: 8px;
    color: #666;
  }

  .status {
    display: flex;
    align-items: center;
  }

  .status-text {
    font-weight: bold;
    margin-right: 10px;
    color: #333;
  }

  .cancel-btn {
    background-color: #ff5252;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .cancel-btn:hover {
    background-color: #e04141; /* Màu khi di chuột qua */
  }
</style>
</head>
<body>


<div class="order-container">
  <form id="order-form">
    <div class="order-item">
      <div class="image-container">
        <img src="product1.jpg" alt="Product 1">
      </div>
      <div class="details">
        <h3>Sản phẩm 1</h3>
        <p>Kích thước: M</p>
        <p>Giá: $50</p>
      </div>
      <div class="status">
        <span class="status-text">Đang chờ xác nhận</span>
        <button type="button" class="cancel-btn">Hủy đơn hàng</button>
      </div>
    </div>

    <div class="order-item">
      <div class="image-container">
        <img src="product2.jpg" alt="Product 2">
      </div>
      <div class="details">
        <h3>Sản phẩm 2</h3>
        <p>Kích thước: L</p>
        <p>Giá: $70</p>
      </div>
      <div class="status">
        <span class="status-text">Đang giao</span>
      </div>
    </div>

    <div class="order-item">
      <div class="image-container">
        <img src="product3.jpg" alt="Product 3">
      </div>
      <div class="details">
        <h3>Sản phẩm 3</h3>
        <p>Kích thước: S</p>
        <p>Giá: $30</p>
      </div>
      <div class="status">
        <span class="status-text">Đã giao hàng</span>
      </div>
    </div>

    <!-- Các đơn hàng khác nếu có -->

  </form>
</div>

<script>
  // Lắng nghe sự kiện click trên nút "Hủy đơn hàng"
  document.querySelectorAll('.cancel-btn').forEach(item => {
    item.addEventListener('click', event => {
      const orderItem = event.target.closest('.order-item');
      if (orderItem) {
        const statusText = orderItem.querySelector('.status-text');
        if (!statusText.textContent.includes('Đã hủy')) {
          statusText.textContent = 'Đã hủy đơn hàng';
          statusText.style.color = '#ff5252'; // Màu đỏ cho trạng thái đã hủy
          item.disabled = true; // Vô hiệu hóa nút "Hủy đơn hàng" sau khi đã hủy
        }
      }
    });
  });

  // Ẩn nút "Hủy đơn hàng" cho các đơn hàng có trạng thái "Đang giao" và "Đã giao"
  document.querySelectorAll('.status-text').forEach(statusText => {
    if (statusText.textContent === 'Đang giao' || statusText.textContent === 'Đã giao hàng') {
      const cancelBtn = statusText.closest('.order-item').querySelector('.cancel-btn');
      if (cancelBtn) {
        cancelBtn.style.display = 'none';
      }
    }
  });
</script>

</body>
</html>
