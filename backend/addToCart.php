<?php

session_start();




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $masp = $_POST['masp'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $size = isset($_POST['size']) ? $_POST['size'] : '';

    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }


    $item = array(
        'masp' => $masp,
        'size' => $size,
        'quantity' => $quantity,
        
        
    );
    $_SESSION['cart'][] = $item;

    
    $response = array('success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.');
    echo json_encode($response);
    exit;
} else {

    $response = array('success' => false, 'message' => 'Invalid request method.');
    echo json_encode($response);
    exit;
}
?>
