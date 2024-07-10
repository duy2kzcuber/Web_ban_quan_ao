<?php
require_once 'ketnoi.php';
$sql = "SELECT * FROM tintuc";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .news-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .news-image {
            max-width: 100%;
            height: auto;
        }
        .news-content {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
<div class="cartegory-top rowe">
            <p><a href="Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p>Tin tức</p>
        </div>
    <div class="container mt-5">
        <h2 class="text-center"> TIN TỨC</h2>
        <hr style="width: 30%; border-top: 2px solid #000;">
        <?php while ($row = mysqli_fetch_array($query)) { ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="news-title text-secondary"><?php echo $row['tieude']; ?></h5>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <img src="../admin/backend_tintuc/imgs/<?php echo $row['hinhanh']; ?>" class="news-image rounded img-hover" alt="Hình ảnh">
                        </div>
                        <div class="col-md-9 mt-3">
                            <p class="news-content"><?php echo nl2br($row['noidung']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
