<?php  
session_start();
require_once '../admin/ketnoi.php';

if (isset($_POST['add_to_cart'])) {
    // Tạo mảng sản phẩm mới từ dữ liệu POST
    $new_product = array(
        'masp' => $_POST['masp'],
        'tensp' => $_POST['tensp'],
        'gia' => $_POST['gia'],
        'soluong' => $_POST['soluong']
    );

    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "masp");
        if (in_array($_POST['masp'], $session_array_id)) {
            // TH1: Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['masp'] == $_POST['masp']) {
                    $_SESSION['cart'][$key]['soluong'] += $_POST['soluong'];
                    break; // Thoát vòng lặp sau khi tìm thấy và cập nhật sản phẩm
                }
            }
        } 
        else {
            // TH2: Sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
            $_SESSION['cart'][] = $new_product;
        }
    } else {
        // Giỏ hàng chưa tồn tại, tạo giỏ hàng mới và thêm sản phẩm
        $_SESSION['cart'] = array($new_product);
    }
}


function hienThi(){
    $sum = 0;
    $output = "";
    $output .= "
        <table class = 'table table-bordered table-striped'>
            <tr>
                <th>Mã</th>
                 <th>Tên sản phẩm</th>
                 <th>Giá</th>
                 <th>Số lượng</th>
                 <th>Tổng giá tiền</th>
                <th>Trạng thái</th>
             </tr>
        
    ";
    if(!empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $value){
             $output .= "
            <tr>
                <td>".$value['masp']."</td>
                <td>".$value['tensp']."</td>
                <td>".number_format($value['gia'])."</td>
                <td>".$value['soluong']."</td>
                <td>".number_format($value['gia'] * $value['soluong']). " VND</td>
                <td> 
                     <a href='test_cart.php?action=remove&masp=".$value['masp']."'>
                        <button class = 'btn btn-danger btn-block'>Xóa</button>
                    </a>
                </td>
             </tr>
             ";
             $sum += $value['gia'] * $value['soluong'] ;
        }
    }
    $output .= "
        <tr>
            <td colspan '4'> <td>
            <td> </b> Tổng giá tiền</b> </td>
            <td>".number_format($sum)."</td>
            <td>
                <a href ='test_cart.php?action=clearall'>
                <button class ='btn btn-warning' '> Xóa toàn bộ giỏ hàng</button>
                </a>
            </td>
        </tr>
    ";
    $output .= "</table>";
    echo $output;

}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Shopping cart</title>
    <link rel="stylesheet" type = "text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Shopping cart date</h2>
                    <div class="col-md-12">
                        <div class="row">
                     
                    <?php
                        $query = "SELECT * FROM product";
                        $res = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_array($res)){?>
                            <div class="col-md-4">
                                <form method="post" action="test_cart.php">
                                    <img src="admin/backend_sanpham/img/<?= $row['anh'] ?>" style="height: 150px;">
                                    <h5 class="text-center"><?= $row['tensp'] ?></h5>
                                    <h5 class="text-center"><?= $row['gia'] ?></h5>
                                    <input type="hidden" name="masp" value="<?= $row['masp'] ?>">
                                    <input type="hidden" name="tensp" value="<?= $row['tensp'] ?>">
                                    <input type="hidden" name="gia" value="<?= $row['gia'] ?>">
                                    <input type="number" name="soluong" value="1" class="form-control">
                                    <input type="submit" name="add_to_cart" class="btn btn-warning btn-block my-2" value="add to cart">
                                </form>
                            </div>
                        <?php } ?>
                       </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Item Selected</h2>
                 
                    <?php hienThi(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_GET['action'])){
        if($_GET['action'] == "clearall"){
            unset($_SESSION['cart']);
            
        }
        if($_GET['action'] == "remove"){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['masp'] == $_GET['masp']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
         header('Location: cart.php');
    }
    ?>
</body>
</html>
