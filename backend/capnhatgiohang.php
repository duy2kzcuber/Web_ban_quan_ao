<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST['key'];
    $new_quantity = intval($_POST['soluong']);

    if ($new_quantity <= 0) {
        $new_quantity = 1;
    }

    
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

    
    if (isset($cart[$key])) {
        $cart[$key]['soluong'] = $new_quantity;
    }

    
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day, adjust as needed

    
    header("Location: cart.php");
    exit();
}
?>
