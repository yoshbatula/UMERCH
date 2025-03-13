<?php
include '../../database/dbconnect.php';
include 'navigation.php';

$user_id = $_SESSION['ID'];
$order_date = NULL; 
$total_amount = $_SESSION['raw-total'] + (0.01 * $_SESSION['raw-total']); 
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'Unknown'; 

try {
    // Start transaction
    $connection->begin_transaction();
    
    $order_query = "INSERT INTO orders (ID, order_date) VALUES (?, CURRENT_TIMESTAMP)";
    $order_stmt = $connection->prepare($order_query);
    $order_stmt->bind_param("i", $user_id);
    
    if (!$order_stmt->execute()) {
        throw new Exception("Error inserting order: " . $order_stmt->error);
    }
    
    $order_id = $connection->insert_id; 

    // Insert into payments table
    $payment_query = "INSERT INTO payments (order_id, total_amount, payment_method) VALUES (?, ?, ?)";
    $payment_stmt = $connection->prepare($payment_query);
    $payment_stmt->bind_param("ids", $order_id, $total_amount, $payment_method);

    if (!$payment_stmt->execute()) {
        throw new Exception("Error inserting payment: " . $payment_stmt->error);
    }
    
    // Retrieve cart items to insert into order_items
    $cart_query = "SELECT carts.product_id, carts.quantity, carts.subtotal, 
                  products.product_price, products.stock
                  FROM carts 
                  JOIN products ON carts.product_id = products.product_id 
                  WHERE carts.ID = ?";
    $cart_stmt = $connection->prepare($cart_query);
    $cart_stmt->bind_param("i", $user_id);
    $cart_stmt->execute();
    $cart_result = $cart_stmt->get_result();

    if ($cart_result->num_rows == 0) {
        throw new Exception("Your cart is empty");
    }

    // Insert each cart item into order_items table
    $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)";
    $order_item_stmt = $connection->prepare($order_item_query);
    
    // Prepare stock update statement
    $update_stock_query = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
    $update_stock_stmt = $connection->prepare($update_stock_query);

    while ($row = $cart_result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price = $row['product_price'];
        $subtotal = $row['subtotal'];
        $current_stock = $row['stock'];
        
        // Check if we have enough stock
        if ($current_stock < $quantity) {
            throw new Exception("Not enough stock for product ID: $product_id. Available: $current_stock, Requested: $quantity");
        }

        $order_item_stmt->bind_param("iiidd", $order_id, $product_id, $quantity, $price, $subtotal);
        
        if (!$order_item_stmt->execute()) {
            throw new Exception("Error inserting order item: " . $order_item_stmt->error);
        }
        
        // Update product stock
        $update_stock_stmt->bind_param("ii", $quantity, $product_id);
        if (!$update_stock_stmt->execute()) {
            throw new Exception("Error updating product stock: " . $update_stock_stmt->error);
        }
    }

    // Clear the user's cart after placing the order
    $clear_cart_query = "DELETE FROM carts WHERE ID = ?";
    $clear_cart_stmt = $connection->prepare($clear_cart_query);
    $clear_cart_stmt->bind_param("i", $user_id);
    
    if (!$clear_cart_stmt->execute()) {
        throw new Exception("Error clearing cart: " . $clear_cart_stmt->error);
    }

    $connection->commit();
    
    // Get the actual order date from the database
    $date_query = "SELECT order_date FROM orders WHERE order_id = ?";
    $date_stmt = $connection->prepare($date_query);
    $date_stmt->bind_param("i", $order_id);
    $date_stmt->execute();
    $date_result = $date_stmt->get_result();
    $order_date_record = $date_result->fetch_assoc();
    
    // Close all statements
    if (isset($order_stmt)) $order_stmt->close();
    if (isset($payment_stmt)) $payment_stmt->close();
    if (isset($cart_stmt)) $cart_stmt->close();
    if (isset($order_item_stmt)) $order_item_stmt->close();
    if (isset($clear_cart_stmt)) $clear_cart_stmt->close();
    if (isset($update_stock_stmt)) $update_stock_stmt->close();
    if (isset($date_stmt)) $date_stmt->close();
    
    // Store order info in session
    $_SESSION['order_success'] = true;
    $_SESSION['order_id'] = $order_id;
    $_SESSION['order_date'] = $order_date_record['order_date'] ?? date("Y-m-d H:i:s");
    $_SESSION['total_amount'] = $total_amount;
    
    $_SESSION['cart'] = [];
    unset($_SESSION['raw-total']); 

} catch (Exception $e) {
    
    $connection->rollback();
    
    // Close any open statements
    if (isset($order_stmt)) $order_stmt->close();
    if (isset($payment_stmt)) $payment_stmt->close();
    if (isset($cart_stmt)) $cart_stmt->close();
    if (isset($order_item_stmt)) $order_item_stmt->close();
    if (isset($clear_cart_stmt)) $clear_cart_stmt->close();
    if (isset($update_stock_stmt)) $update_stock_stmt->close();
    if (isset($date_stmt)) $date_stmt->close();

    // Store error in session
    $_SESSION['order_error'] = $e->getMessage();
    
    // Redirect to order page
    header("Location: mainpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success message with SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Order Placed Successfully!',
                text: 'Order has been confirmed!',
                confirmButtonColor: '#B02A24'
            }).then(function() {
                // Redirect to main page after user clicks OK
                window.location.href = 'mainpage.php';
            });
        });
    </script>
</body>
</html>