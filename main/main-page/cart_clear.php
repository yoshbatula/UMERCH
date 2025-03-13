<?php
session_start();
include '../../database/dbconnect.php';

if (!isset($_SESSION['ID'])) {
    $_SESSION['message'] = "Please log in to clear your cart";
    $_SESSION['message_type'] = "error";
    header("Location: login.php");
    exit();
}

// Delete all items from the user's cart
$clear_query = "DELETE FROM carts WHERE ID = ?";
$clear_stmt = $connection->prepare($clear_query);
$clear_stmt->bind_param("i", $_SESSION['ID']);
$clear_stmt->execute();

if ($clear_stmt->affected_rows > 0) {
    $_SESSION['message'] = "Your cart has been cleared";
    $_SESSION['message_type'] = "success";
    
    // Also clear the session cart
    $_SESSION['cart'] = [];
    $_SESSION['raw-total'] = 0;
} else {
    $_SESSION['message'] = "Your cart is already empty";
    $_SESSION['message_type'] = "info";
}

header("Location: cart.php");
exit();
?>