<?php include "../slider.php"; 

?>
    <style>
        .image-container {
            display: flex;
            gap: 10px; /* Khoảng cách giữa các ảnh */
        }

        .product-image {
            width: 75px;
            height: auto;
        }
    </style>
    <div class="container">
        <h1>DANH SÁCH SẢN PHẨM</h1>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
            Thêm sản phẩm mới
        </button>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Màu sắc</th>
                    <th>Số lượng kho</th>
                    <th>Ngày tạo</th>
                    <th>Giới thiệu</th>
                    <th>Chi tiết sản phẩm</th>
                    <th>Bảo quản</th>
                    <th>Ảnh chính</th>
                    <th>Ảnh mô tả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ket noi
                require_once '../ketnoi.php';
                // Cau lenh SQL
                $lietke_sql = "SELECT * FROM product ORDER BY masp, tensp";
                // Thuc thi cau lenh SQL
                $result = mysqli_query($conn, $lietke_sql);
                // Duyet ket qua va in ra
                while ($r = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $r['masp']; ?></td>
                    <td><?php 
                       // $dm_sql =  "SELECT * FROM danhmuc WHERE madm = $r[madm] ";
                    ?></td>
                    <td><?php echo $r['tensp']; ?></td>
                    <td><?php echo $r['gia']; ?></td>
                    <td><?php echo $r['mausac']; ?></td>
                    <td><?php echo $r['soluong']; ?></td>
                    <td><?php echo $r['ngaytao']; ?></td>
                    <td><?php echo $r['gioithieu']; ?></td>
                    <td><?php echo $r['ctsp']; ?></td>
                    <td><?php echo $r['baoquan']; ?></td>
                    <td><img src="../html_backend/img/<?php echo $r['anh']; ?>" style="width: 100px; height: auto;"></td>
                    <td>
                        <div class="image-container">
                            <?php
                            $fileanhArray = explode(",", $r['fileanh']); // Tach chuoi thanh mang cac ten file
                            foreach ($fileanhArray as $fileName) {
                                echo '<img src="../backend_sanpham/img/' . $fileName . '" class="product-image">';
                            }
                            ?>
                           
                        </div>
                    </td>
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
                                <label for="madm">Tên danh mục</label>
                                <select name="madm" id="madm" class="form-control" required>
                                    <option value="">-----Vui lòng chọn danh mục------</option>
                                    <?php
                                    // Truy vấn tất cả các danh mục
                                    $query = "SELECT madm, tendm FROM danhmuc";
                                    $result = mysqli_query($conn, $query);
                                    // Hiển thị các danh mục trong thẻ select
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['madm'] . '">' . $row['tendm'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tensp">Tên sản phẩm</label>
                                <input type="text" id="tensp" class="form-control" name="tensp">
                            </div>
                            <div class="form-group">
                                <label for="gia">Giá</label>
                                <input type="text" id="gia" name="gia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mausac">Màu sắc</label>
                                <input type="text" id="mausac" name="mausac" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="soluong">Số lượng kho</label>
                                <input type="text" id="soluong" name="soluong" class="form-control">
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
                                <label for="uploads">Upload ảnh mô tả</label>
                                <input type="file" id="uploads" name="uploads[]" class="form-control" multiple>
                            </div>

                            <input type="submit" value="Thêm thông tin" class="btn btn-primary">
                        </div>a
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


