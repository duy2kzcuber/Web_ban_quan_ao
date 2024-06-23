<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST['key'];
    $new_quantity = intval($_POST['soluong']);

    
    if ($new_quantity <= 0) {
        
        $new_quantity = 1;
    }

    // Update quantity in the cart session
    $_SESSION['cart'][$key]['soluong'] = $new_quantity;

    // Redirect back to cart.php after update
    header("Location: cart.php");
    exit();
}
?>
