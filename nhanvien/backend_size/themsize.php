<?php
$id = $_POST['id'];
$size=$_POST['size'];



require_once '../ketnoi.php';
$themsql = "INSERT INTO `tensize` (`id`, `tensize`) VALUES ('$id', '$size')";

            if (mysqli_query($conn, $themsql)) {
                header("Location:lietke.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
