<?php
session_start();
include '../../database/dbconnect.php';

// Check if product_id is set in GET request
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Delete the product from wishlist
    $delete_query = "DELETE FROM wishlists WHERE ID = ? AND product_id = ?";
    $delete_stmt = $connection->prepare($delete_query);
    $delete_stmt->bind_param("ii", $_SESSION['ID'], $product_id);
    
    if ($delete_stmt->execute() && $delete_stmt->affected_rows > 0) {
        $_SESSION['message'] = "Product removed from wishlist";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error removing product from wishlist";
        $_SESSION['message_type'] = "error";
    }
}

// Redirect back to wishlist page
header("Location: wishlist.php");
exit();
?>