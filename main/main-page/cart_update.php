<?php
    session_start();
    include '../../database/dbconnect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
      $product_id = $_POST['product_id'];
      $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

      if (isset($_POST['increase'])) {
          $quantity++;
      } elseif (isset($_POST['decrease']) && $quantity > 1) {
          $quantity--;
      }

      $query = "INSERT INTO carts (ID, product_id, quantity, subtotal)
              VALUES (?, ?, ?, ? * (SELECT product_price FROM products WHERE product_id = ?))
              ON DUPLICATE KEY UPDATE 
              quantity = VALUES(quantity), 
              subtotal = VALUES(subtotal)";

      $stmt = $connection->prepare($query);
      $stmt->bind_param("iiiii", $_SESSION['ID'], $product_id, $quantity, $quantity, $product_id);
      $stmt->execute();

      header("Location: cart.php");
      exit();
  }
?>