<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    $product_exists = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $product_exists = true;
            break;
        }
    }
    
    if (!$product_exists) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => $quantity
        ];
    }
    
    $_SESSION['message'] = "Product added to cart successfully!";
    $_SESSION['message_type'] = "success";
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_POST['remove_from_cart'])) {
    $index = $_POST['cart_index'];
    
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        
        $_SESSION['message'] = "Product removed from cart!";
        $_SESSION['message_type'] = "success";
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_POST['update_cart'])) {
    $index = $_POST['cart_index'];
    $quantity = (int)$_POST['quantity'];
    
    if (isset($_SESSION['cart'][$index]) && $quantity > 0) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        
        $_SESSION['message'] = "Cart updated!";
        $_SESSION['message_type'] = "success";
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>