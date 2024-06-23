<?php
// Start session if not already started
session_start();



// Ensure this PHP script receives POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs (example)
    $masp = $_POST['masp'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $size = isset($_POST['size']) ? $_POST['size'] : '';

    // Example: Add to session cart (you can modify this to add to database)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add item to cart array
    $item = array(
        'masp' => $masp,
        'size' => $size,
        'quantity' => $quantity,
        
        // Add more details as needed (price, name, etc.)
    );
    $_SESSION['cart'][] = $item;

    // Respond with JSON success message
    $response = array('success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.');
    echo json_encode($response);
    exit;
} else {
    // Handle invalid request method (not POST)
    $response = array('success' => false, 'message' => 'Invalid request method.');
    echo json_encode($response);
    exit;
}
?>
