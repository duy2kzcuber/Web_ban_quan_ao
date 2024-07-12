<?php 
  include "../../slider.php";
?>
<div class="container">
    <h1>DANH SÁCH SỐ LƯỢNG SIZE</h1>
    <!-- Button to update inventory -->
    <button type="button" class="btn btn-primary" onclick="window.location.href='capnhatsoluong.php'">Cập nhật số lượng sản phẩm</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='/Thoitrang_VHTDT/admin/backend_size/lietke.php'">Thêm size</button>
    <table class="table table-dark">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm Số Lượng Size
        </button>
        <thead>
            <tr>
                <th>Mã Product</th>
                <th>Mã Sản Phẩm</th>
                <th>Tên Size</th>
                <th>Số Lượng Size</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Kết nối
        require_once '../../ketnoi.php';
        // Câu lệnh JOIN để lấy tensize
        $lietke_sql = "SELECT productsize.masp, tensize.tensize, productsize.soluongsize, productsize.idprd 
               FROM productsize 
               JOIN tensize ON productsize.id = tensize.id 
               ORDER BY productsize.masp, productsize.idprd, productsize.soluongsize";

// Thực hiện truy vấn và xử lý kết quả ở đây

        // Thực thi câu lệnh
        $result = mysqli_query($conn, $lietke_sql);
        // Duyệt kết quả và in ra
        while ($r = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $r['idprd']; ?></td>
                <td><?php echo $r['masp']; ?></td>
                <td><?php echo $r['tensize']; ?></td>
                <td><?php echo $r['soluongsize']; ?></td>
                <td>
                    <a href="suasoluong.php?sid=<?php echo $r['idprd']; ?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa này không?');" href="xoasoluong.php?sid=<?php echo $r['idprd']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Thêm số lượng mới</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form name="form" action="themsoluong.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <h1>Form thêm số lượng size</h1>
            <form action="themsoluong.php" method="post">
                <div class="form-group">
                    <label for="masp">Tên sản phẩm</label>
                    <select id="masp" class="form-control" name="masp">
                        <?php
                        $product_sql = "SELECT masp, tensp FROM Product";
                        $product_result = mysqli_query($conn, $product_sql);
                        while ($product_row = mysqli_fetch_assoc($product_result)) {
                            echo "<option value='{$product_row['masp']}'>{$product_row['tensp']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id">Tên size</label>
                    <select id="id" class="form-control" name="id">
                        <?php
                        $size_sql = "SELECT id, tensize FROM tensize";
                        $size_result = mysqli_query($conn, $size_sql);
                        while ($size_row = mysqli_fetch_assoc($size_result)) {
                            echo "<option value='{$size_row['id']}'>{$size_row['tensize']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="soluongsize">Số lượng size</label>
                    <input type="text" id="soluongsize" class="form-control" name="soluongsize">
                </div>
                <input type="submit" value="Thêm thông tin" class="btn btn-primary"/>
            </form>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
