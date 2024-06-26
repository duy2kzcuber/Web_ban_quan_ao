<?php
// Ensure this PHP script receives GET data
if (isset($_GET['key'])) {
    $key = $_GET['key'];

    // Decode existing cart from cookie or initialize a new array
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

    // Check if the item exists in the cart and remove it
    if (isset($cart[$key])) {
        unset($cart[$key]);
    }

    // Encode the cart back to JSON and save it in the cookie
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day, adjust as needed

    // Redirect back to cart.php after deletion
    header("Location: cart.php");
    exit();
} else {
    // Redirect back to cart.php if no key is provided
    header("Location: cart.php");
    exit();
}
?>
