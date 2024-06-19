<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liệt kê danh sách hình ảnh</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>DANH SÁCH SIZE</h1>
    <table class="table table-dark">
        <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Thêm Size Mới
</button>
    <thead>
      <tr>
        <th>Mã size</th>
        <th>Tên Size</th>
        <th>Thao tác</th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php
//ketnoi
require_once 'ketnoi.php';
//cau lenh
$lietke_sql="SELECT * FROM tensize order by id,tensize";
//thuc thi cau lenh
$result = mysqli_query($conn,$lietke_sql);
//duyet ket qua va in ra
while ($r = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $r['id'];?></td>
        <td><?php echo $r['tensize'];?></td>
        <td>
            <a href="suasize.php?sid=<?php echo $r['id'];?>" class="btn btn-info">Sửa</a>
            <a onclick="return confirm('Bạn có muốn xóa size này không?');" href="xoasize.php?sid=<?php echo $r['id']; ?>" class="btn btn-danger">Xóa</a>
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
        <h4 class="modal-title">Thêm size mới</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form name="form" action="themsize.php" method="post" enctype="multipart/form-data" >
    <div class="container">
        <h1>Form thêm size</h1>
        <form action="themsize.php" method="post">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" id="id" class="form-control" name="id">
            </div>
            <div class="form-group">
                <label for="id">Tên Size</label>
                <input type="text" id="size" class="form-control" name="size">
            </div>

            
            

            <input type="submit" value="Them thong tin"/>
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



</html>

