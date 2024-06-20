<?php 
include "../slider.php";
?>
    
    <div class="container">
        <h1>DANH SÁCH NHÂN VIÊN </h1>
        <table class="table table-dark">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
                Thêm Nhân Viên Mới
            </button>
            <thead>
                <tr>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày vào làm</th>
                    <th>Lương</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //ketnoi
                require_once '../ketnoi.php';
                //cau lenh
                $lietke_sql="SELECT * FROM nhanvien order by manv,tennv";
                //thuc thi cau lenh
                $result = mysqli_query($conn,$lietke_sql);
                //duyet ket qua va in ra
                while ($r = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $r['manv'];?></td>
                    <td><?php echo $r['tennv'];?></td>
                    <td><?php echo $r['ngaysinh'];?></td>
                    <td><?php echo $r['gioitinh'];?></td>
                    <td><?php echo $r['diachi'];?></td>
                    <td><?php echo $r['sdt'];?></td>
                    <td><?php echo $r['email'];?></td>
                    <td><?php echo $r['ngayvaolam'];?></td>
                    <td><?php echo $r['luong'];?></td>
                    <td><?php echo $r['ghichu'];?></td>
                    <td>
                        <a href="suanhanvien.php?sid=<?php echo $r['manv'];?>" class="btn btn-info">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa nhân viên này không?');" href="xoanhanvien.php?sid=<?php echo $r['manv']; ?>" class="btn btn-danger">Xóa</a>
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
                    <h4 class="modal-title">Thêm nhân viên mới</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="themnhanvien.php" method="post">
                        <div class="form-group">
                            <label for="manv">Mã nhân viên</label>
                            <input type="text" id="manv" class="form-control" name="manv" required>
                        </div>
                        <div class="form-group">
                            <label for="tennv">Tên nhân viên</label>
                            <input type="text" id="tennv" class="form-control" name="tennv" required>
                        </div>
                        <div class="form-group">
                            <label for="ngaysinh">Ngày sinh</label>
                            <input type="date" id="ngaysinh" class="form-control" name="ngaysinh" required>
                        </div>
                        <div class="form-group">
                            <label for="gioitinh">Giới tính</label>
                            <select id="gioitinh" class="form-control" name="gioitinh" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" id="diachi" class="form-control" name="diachi" required>
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" id="sdt" class="form-control" name="sdt" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="ngayvaolam">Ngày vào làm</label>
                            <input type="date" id="ngayvaolam" class="form-control" name="ngayvaolam" required>
                        </div>
                        <div class="form-group">
                            <label for="luong">Lương</label>
                            <input type="number" id="luong" class="form-control" name="luong" required>
                        </div>
                        <div class="form-group">
                            <label for="ghichu">Ghi chú</label>
                            <textarea id="ghichu" class="form-control" name="ghichu"></textarea>
                        </div>
                        <input type="submit" value="Thêm thông tin" class="btn btn-success">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
