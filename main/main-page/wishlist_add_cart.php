<?php
session_start();
include '../../database/dbconnect.php';

// Check if product_id is set
if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    $_SESSION['message'] = "Invalid product selection";
    $_SESSION['message_type'] = "error";
    header("Location: wishlist.php");
    exit();
}

$product_id = $_POST['product_id'];
$user_id = $_SESSION['ID'];

// Check if product exists in database
$check_product_query = "SELECT * FROM products WHERE product_id = ?";
$check_product_stmt = $connection->prepare($check_product_query);
$check_product_stmt->bind_param("i", $product_id);
$check_product_stmt->execute();
$product_result = $check_product_stmt->get_result();

if ($product_result->num_rows === 0) {
    $_SESSION['message'] = "Product not found";
    $_SESSION['message_type'] = "error";
    header("Location: wishlist.php");
    exit();
}

$product = $product_result->fetch_assoc();

// Check if product is in stock
if ($product['stock'] <= 0) {
    $_SESSION['message'] = "This product is out of stock";
    $_SESSION['message_type'] = "error";
    header("Location: wishlist.php");
    exit();
}

// FIRST: Verify the product exists in the wishlist (as a safety check)
$check_wishlist_query = "SELECT * FROM wishlist WHERE ID = ? AND product_id = ?";
$check_wishlist_stmt = $connection->prepare($check_wishlist_query);
$check_wishlist_stmt->bind_param("ii", $user_id, $product_id);
$check_wishlist_stmt->execute();
$wishlist_result = $check_wishlist_stmt->get_result();

if ($wishlist_result->num_rows === 0) {
    // Product not in wishlist, something is wrong
    $_SESSION['message'] = "Product not found in your wishlist";
    $_SESSION['message_type'] = "error";
    header("Location: wishlist.php");
    exit();
}

// Check if product already exists in user's cart
$check_cart_query = "SELECT * FROM carts WHERE ID = ? AND product_id = ?";
$check_cart_stmt = $connection->prepare($check_cart_query);
$check_cart_stmt->bind_param("ii", $user_id, $product_id);
$check_cart_stmt->execute();
$check_cart_result = $check_cart_stmt->get_result();

$quantity = 1;

try {
    // Start transaction
    $connection->begin_transaction();

    if ($check_cart_result->num_rows > 0) {
        // Update quantity if product already in cart
        $update_query = "UPDATE carts SET quantity = quantity + 1, subtotal = subtotal + ? WHERE ID = ? AND product_id = ?";
        $update_stmt = $connection->prepare($update_query);
        $update_stmt->bind_param("dii", $product['product_price'], $user_id, $product_id);
        $update_stmt->execute();
        
        if ($update_stmt->affected_rows > 0) {
            $_SESSION['message'] = "Product quantity updated in cart!";
            $_SESSION['message_type'] = "success";
            
            // Add to session cart if not already there
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            if (!in_array($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][] = $product_id; 
            }
        } else {
            throw new Exception("Failed to update cart");
        }
    } else {
        // Product does not exist in cart, insert a new record
        $subtotal = $product['product_price'] * $quantity;
        $insert_cart_query = "INSERT INTO carts (ID, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
        $insert_cart_stmt = $connection->prepare($insert_cart_query);
        $insert_cart_stmt->bind_param("iiid", $user_id, $product_id, $quantity, $subtotal);
        
        if ($insert_cart_stmt->execute()) {
            $_SESSION['message'] = "Product added to cart successfully!";
            $_SESSION['message_type'] = "success";
            
            // Initialize cart array if it doesn't exist
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            // Add to session cart
            $_SESSION['cart'][] = $product_id;
        } else {
            throw new Exception("Error adding product to cart: " . $connection->error);
        }
    }
    
    // Now remove the item from the wishlist
    $remove_from_wishlist_query = "DELETE FROM wishlist WHERE ID = ? AND product_id = ?";
    $remove_from_wishlist_stmt = $connection->prepare($remove_from_wishlist_query);
    $remove_from_wishlist_stmt->bind_param("ii", $user_id, $product_id);
    
    if (!$remove_from_wishlist_stmt->execute()) {
        throw new Exception("Error removing product from wishlist: " . $connection->error);
    }
    
    // Commit transaction
    $connection->commit();
    
} catch (Exception $e) {
    // Rollback on error
    $connection->rollback();
    
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['message_type'] = "error";
    
    // Log the error
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n", FILE_APPEND);
}

// Redirect back to wishlist page with success parameter
header("Location: wishlist.php?added=1");
exit();
?>