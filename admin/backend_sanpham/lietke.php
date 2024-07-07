<?php include "../slider.php"; 

?>
    
    <div class="container">
        <h1>DANH SÁCH SẢN PHẨM</h1>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
            Thêm sản phẩm mới
        </button>
        <a href="productsize/lietkesoluong.php">
        <button type="button" class="btn btn-success mb-3">
            Thêm số lượng hàng 
        </button> </a>


        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên danh mục cha </th>
                    <th>Tên danh mục con</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Giá nhập</th>
                    <th>Màu sắc</th>
                    <th>Ngày tạo</th>
                    <th>Giới thiệu</th>
                    <th>Chi tiết sản phẩm</th>
                    <th>Bảo quản</th>
                    <th>Ảnh chính</th>
                    <th>Ảnh mô tả 1</th>
                    <th>Ảnh mô tả 2</th>
                    <th>Ảnh mô tả 3</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php
// Kết nối CSDL
require_once '../ketnoi.php';

// Câu lệnh SQL để lấy danh sách sản phẩm kèm tên danh mục
$lietke_sql = "SELECT p.*, d.tendm ,d.danhmuccha
               FROM product p
               INNER JOIN danhmuc d ON p.madm = d.madm 
               ORDER BY p.masp, p.tensp";

// Thực thi câu lệnh SQL
$result = mysqli_query($conn, $lietke_sql);

// Duyệt kết quả và in ra từng sản phẩm
while ($r = mysqli_fetch_assoc($result)) {
?>
                <tr>
                    <td><?php echo $r['masp']; ?></td>
                    <td><?php echo $r['danhmuccha']; ?></td>
                    <td><?php echo $r['tendm']; ?></td>
                    <td><?php echo $r['tensp']; ?></td>
                    <td><?php echo $r['gia']; ?></td>
                    <td><?php echo $r['gianhap']; ?></td>
                    <td><?php echo $r['mausac']; ?></td>
                    
                    <td><?php echo $r['ngaytao']; ?></td>
                    <td><?php echo $r['gioithieu']; ?></td>
                    <td><?php echo $r['ctsp']; ?></td>
                    <td><?php echo $r['baoquan']; ?></td>
                    <td><img src="../backend_sanpham/img/<?php echo $r['anh']; ?>" style="width: 100px; height: auto;"></td>
                    <td><img src="../backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" style="width: 100px; height: auto;"></td>
                    <td><img src="../backend_sanpham/anhmota/<?php echo $r['anhmt2']; ?>" style="width: 100px; height: auto;"></td>
                    <td><img src="../backend_sanpham/anhmota/<?php echo $r['anhmt3']; ?>" style="width: 100px; height: auto;"></td>
                    
                    <td>
                        <a href="sua.php?sid=<?php echo $r['masp']; ?>" class="btn btn-info">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?');" href="xoa.php?sid=<?php echo $r['masp']; ?>" class="btn btn-danger">Xóa</a>
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
                    <h4 class="modal-title">Thêm sản phẩm mới</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form name="form" action="them.php" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <h1>Form thêm thông tin sản phẩm</h1>
                            <div class="form-group">
                                <label for="masp">Mã sản phẩm</label>
                                <input type="text" id="masp" class="form-control" name="masp">
                            </div>
                            <div class="form-group">
    <label for="danhmuccha">Tên danh mục cha </label>
    <select name="danhmuccha" id="danhmuccha" class="form-control" required onchange="filterSubcategories()">
        <option value="">-----Vui lòng chọn danh mục------</option>
        <?php
        // Truy vấn tất cả các danh mục cha duy nhất
        $query = "SELECT DISTINCT danhmuccha FROM danhmuc";
        $result = mysqli_query($conn, $query);
        
        // Hiển thị các danh mục cha trong thẻ select
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['danhmuccha'] . '">' . $row['danhmuccha'] . '</option>';
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="madm">Tên danh mục con </label>
    <select name="madm" id="madm" class="form-control" required>
        <option value="">-----Vui lòng chọn danh mục------</option>
        <?php
        // Truy vấn tất cả các danh mục
        $query = "SELECT madm, tendm, danhmuccha FROM danhmuc";
        $result = mysqli_query($conn, $query);
        
        // Hiển thị các danh mục trong thẻ select
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['madm'] . '" data-danhmuccha="' . $row['danhmuccha'] . '">' . $row['tendm'] . '</option>';
        }
        ?>
    </select>
</div>

<script>
    function filterSubcategories() {
        var selectedDanhMucCha = document.getElementById('danhmuccha').value;
        var subcategories = document.getElementById('madm').getElementsByTagName('option');
        
        for (var i = 0; i < subcategories.length; i++) {
            var danhMucCha = subcategories[i].getAttribute('data-danhmuccha');
            if (selectedDanhMucCha === '' || danhMucCha === selectedDanhMucCha) {
                subcategories[i].style.display = '';
            } else {
                subcategories[i].style.display = 'none';
            }
        }
        
        // Đặt lại giá trị mặc định cho danh mục con khi thay đổi danh mục cha
        document.getElementById('madm').value = '';
    }
</script>

                            <div class="form-group">
                                <label for="tensp">Tên sản phẩm</label>
                                <input type="text" id="tensp" class="form-control" name="tensp">
                            </div>
                            <div class="form-group">
                                <label for="gia">Giá bán </label>
                                <input type="text" id="gia" name="gia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gianhap">Giá nhập </label>
                                <input type="text" id="gianhap" name="gianhap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mausac">Màu sắc</label>
                                <input type="text" id="mausac" name="mausac" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="ngaytao">Ngày tạo</label>
                                <input type="date" id="ngaytao" name="ngaytao" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gioithieu">Giới thiệu</label>
                                <input type="text" id="gioithieu" name="gioithieu" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ctsp">Chi tiết sản phẩm</label>
                                <input type="text" id="ctsp" name="ctsp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="baoquan">Bảo quản</label>
                                <input type="text" id="baoquan" name="baoquan" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="upload">Upload ảnh chính</label>
                                <input type="file" id="upload" name="upload" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="upload1">Upload ảnh mô tả 1</label>
                                <input type="file" id="upload1" name="upload1" class="form-control" multiple>
                            </div>
                            <div class="form-group">
                                <label for="upload2">Upload ảnh mô tả 2</label>
                                <input type="file" id="upload2" name="upload2" class="form-control" multiple>
                            </div>
                            <div class="form-group">
                                <label for="upload3">Upload ảnh mô tả 3</label>
                                <input type="file" id="upload3" name="upload3" class="form-control" multiple>
                            </div>

                            <input type="submit" value="Thêm thông tin" class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
    </div>
</div>