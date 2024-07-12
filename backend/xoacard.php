<?php

if (isset($_GET['key'])) {
    $key = $_GET['key'];

    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

    if (isset($cart[$key])) {
        unset($cart[$key]);
    }
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
    header("Location: cart.php");
    exit();
} else {
    header("Location: cart.php");
    exit();
}
