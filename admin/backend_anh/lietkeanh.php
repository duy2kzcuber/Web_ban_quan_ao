<?php 
include "../slider.php";
?>
<div class="container">
    <h1>DANH SÁCH ẢNH</h1>
    <table class="table table-dark">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm Ảnh
        </button>
        <thead>
            <tr>
                <th>Mã Ảnh</th>
                <th>Mô Tả</th>
                <th>Ngày Tạo</th>
                <th>Hình Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Kết nối
        require_once '../ketnoi.php';
        // Câu lệnh SQL
        $lietke_sql = "SELECT * FROM anhht";
        // Thực thi câu lệnh
        $result = mysqli_query($conn, $lietke_sql);
        // Duyệt kết quả và in ra
        while ($r = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $r['idanhht'];?></td>
                <td><?php echo $r['mota'];?></td>
                <td><?php echo $r['ngaytao'];?></td>
                <td><img src="../backend_anh/imgs/<?php echo $r['anhhienthi'];?>" alt="Hình ảnh" style="width: 100px;"></td>
                <td>
                    <a href="suaanh.php?sid=<?php echo $r['idanhht'];?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa ảnh này không?');" href="xoaanh.php?sid=<?php echo $r['idanhht']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm Ảnh Mới</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form name="form" action="themanh.php" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <h1>Form Thêm Ảnh</h1>
                        <div class="form-group">
                            <label for="anhhienthi">Ảnh hiển thị</label>
                            <input type="file" id="anhhienthi" class="form-control" name="anhhienthi">
                        </div>
                        <div class="form-group">
                            <label for="mota">Mô tả</label>
                            <input type="text" id="mota" class="form-control" name="mota">
                        </div>
                        <div class="form-group">
                            <label for="ngaytao">Ngày tạo</label>
                            <input type="date" id="ngaytao" class="form-control" name="ngaytao">
                        </div>
                        <input type="submit" value="Thêm Ảnh" class="btn btn-primary">
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
