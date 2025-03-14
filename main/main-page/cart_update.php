<?php
session_start();
include '../../database/dbconnect.php';

if (!isset($_SESSION['ID']) || !isset($_POST['product_id'])) {
    $_SESSION['message'] = "Invalid request";
    $_SESSION['message_type'] = "error";
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['ID'];
$product_id = $_POST['product_id'];
$price = isset($_POST['price']) ? $_POST['price'] : 0;
$stock = isset($_POST['stock']) ? $_POST['stock'] : 0; // Get stock value

// Get current quantity
$query = "SELECT quantity FROM carts WHERE ID = ? AND product_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['message'] = "Product not found in cart";
    $_SESSION['message_type'] = "error";
    header("Location: cart.php");
    exit();
}

$row = $result->fetch_assoc();
$current_quantity = $row['quantity'];
$new_quantity = $current_quantity;

if (isset($_POST['increase'])) {
    if ($current_quantity + 1 > $stock) {
        $_SESSION['message'] = "Cannot add more than available stock!";
        $_SESSION['message_type'] = "error";
        header("Location: cart.php");
        exit();
    }
    $new_quantity = $current_quantity + 1;
} elseif (isset($_POST['decrease'])) {
    if ($current_quantity > 1) {
        $new_quantity = $current_quantity - 1;
    } else {
        header("Location: cart_delete.php?product_id=" . $product_id);
        exit();
    }
}

// Calculate new subtotal
$new_subtotal = $new_quantity * $price;

// Update the cart
$update_query = "UPDATE carts SET quantity = ?, subtotal = ? WHERE ID = ? AND product_id = ?";
$update_stmt = $connection->prepare($update_query);
$update_stmt->bind_param("idii", $new_quantity, $new_subtotal, $user_id, $product_id);
$update_stmt->execute();

header("Location: cart.php");
exit();
?>