<?php
session_start();
include '../../database/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['ID'];
    
    // Delete the item from the cart
    $delete_query = "DELETE FROM carts WHERE product_id = ? AND ID = ?";
    $stmt = $connection->prepare($delete_query);
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
    
    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        $_SESSION['message'] = "Item removed from cart successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to remove item from cart";
        $_SESSION['message_type'] = "error";
    }
    
    // Remove from session cart array if it exists
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        $key = array_search($product_id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        }
    }
    
    header("Location: cart.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request";
    $_SESSION['message_type'] = "error";
    header("Location: cart.php");
    exit();
}
?>