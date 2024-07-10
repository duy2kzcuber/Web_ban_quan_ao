<?php 
include "../slider.php";
?>
<div class="container">
    <h1>DANH SÁCH TIN TỨC</h1>
    <table class="table table-dark">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm Tin Tức
        </button>
        <thead>
            <tr>
                <th>Mã Tin Tức</th>
                <th>Tiêu Đề</th>
                <th>Nội Dung</th>
                <th>Ngày Tạo</th>
                <th>Hình Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Kết nối
        require_once '../ketnoi.php';
        // Câu lệnh
        $lietke_sql = "SELECT * FROM tintuc ORDER BY idtintuc, tieude";
        // Thực thi câu lệnh
        $result = mysqli_query($conn, $lietke_sql);
        // Duyệt kết quả và in ra
        while ($r = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $r['idtintuc'];?></td>
                <td><?php echo $r['tieude'];?></td>
                <td><?php echo $r['noidung'];?></td>
                <td><?php echo $r['ngaytao'];?></td>
                <td><img src="../backend_tintuc/imgs/<?php echo $r['hinhanh'];?>" alt="Hình ảnh" style="width: 100px;"></td>
                <td>
                    <a href="suatintuc.php?sid=<?php echo $r['idtintuc'];?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa tin tức này không?');" href="xoatintuc.php?sid=<?php echo $r['idtintuc']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm tin tức mới</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form name="form" action="themtintuc.php" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <h1>Form thêm tin tức</h1>
                        <div class="form-group">
                            <label for="tieude">Tiêu đề</label>
                            <input type="text" id="tieude" class="form-control" name="tieude">
                        </div>
                        <div class="form-group">
                            <label for="noidung">Nội dung</label>
                            <textarea id="noidung" class="form-control" name="noidung"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ngaytao">Ngày tạo</label>
                            <input type="date" id="ngaytao" class="form-control" name="ngaytao">
                        </div>
                        <div class="form-group">
                            <label for="upload">Hình ảnh</label>
                            <input type="file" id="upload" class="form-control" name="upload">
                        </div>
                        <input type="submit" value="Thêm thông tin" class="btn btn-primary"/>
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
