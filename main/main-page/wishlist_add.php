<?php
session_start();
include '../../database/dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
    $_SESSION['message'] = "Please log in to add items to your wishlist";
    $_SESSION['message_type'] = "error";
    header("Location: shop.php");
    exit();
}

// Check if product_id is set in POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Check if product already exists in user's wishlist
    $check_wishlist_query = "SELECT * FROM wishlists WHERE ID = ? AND product_id = ?";
    $check_wishlist_stmt = $connection->prepare($check_wishlist_query);
    $check_wishlist_stmt->bind_param("ii", $_SESSION['ID'], $product_id);
    $check_wishlist_stmt->execute();
    $check_wishlist_result = $check_wishlist_stmt->get_result();
    
    if ($check_wishlist_result->num_rows > 0) {
        $_SESSION['message'] = "Product already in your wishlist!";
        $_SESSION['message_type'] = "info";
    } else {
        // Insert product into wishlist
        $insert_wishlist_query = "INSERT INTO wishlists (ID, product_id) VALUES (?, ?)";
        $insert_wishlist_stmt = $connection->prepare($insert_wishlist_query);
        $insert_wishlist_stmt->bind_param("ii", $_SESSION['ID'], $product_id);
        
        if ($insert_wishlist_stmt->execute()) {
            $_SESSION['message'] = "Product added to wishlist successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error adding product to wishlist.";
            $_SESSION['message_type'] = "error";
        }
    }
}

header("Location: shop.php");
exit();
?>