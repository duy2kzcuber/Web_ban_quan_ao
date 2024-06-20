
  <?php 
  include "../slider.php";
  ?>
    <div class="container">
        <h1>DANH SÁCH DANH MỤC</h1>
    <table class="table table-dark">
        <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Thêm Danh mục
</button>
    <thead>
      <tr>
        <th>Mã Danh Mục</th>
        <th>Tên Danh Mục</th>
        <th>Thao tác</th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php
//ketnoi
require_once '../ketnoi.php';

//cau lenh
$lietke_sql="SELECT * FROM danhmuc order by madm,tendm";
//thuc thi cau lenh
$result = mysqli_query($conn,$lietke_sql);
//duyet ket qua va in ra
while ($r = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $r['madm'];?></td>
        <td><?php echo $r['tendm'];?></td>
        <td>
            <a href="suadanhmuc.php?sid=<?php echo $r['madm'];?>" class="btn btn-info">Sửa</a>
            <a onclick="return confirm('Bạn có muốn xóa size này không?');" href="xoadanhmuc.php?sid=<?php echo $r['madm']; ?>" class="btn btn-danger">Xóa</a>
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
        <h4 class="modal-title">Thêm danh mục mới</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form name="form" action="themdanhmuc.php" method="post" enctype="multipart/form-data" >
    <div class="container">
        <h1>Form thêm danh mục</h1>
        <form action="themdanhmuc.php" method="post">
            <div class="form-group">
                <label for="madm">Mã danh mục</label>
                <input type="text" id="madm" class="form-control" name="madm">
            </div>
            <div class="form-group">
                <label for="tendm">Tên danh mục</label>
                <input type="text" id="tendm" class="form-control" name="tendm">
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





