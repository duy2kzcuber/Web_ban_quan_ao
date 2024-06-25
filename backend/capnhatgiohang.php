<?php
// Ensure this PHP script receives POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST['key'];
    $new_quantity = intval($_POST['soluong']);

    if ($new_quantity <= 0) {
        $new_quantity = 1;
    }

    // Decode existing cart from cookie or initialize a new array
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

    // Update quantity in the cart cookie
    if (isset($cart[$key])) {
        $cart[$key]['soluong'] = $new_quantity;
    }

    // Encode the cart back to JSON and save it in the cookie
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day, adjust as needed

    // Redirect back to cart.php after update
    header("Location: cart.php");
    exit();
}
?>
