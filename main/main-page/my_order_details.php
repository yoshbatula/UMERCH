<?php
include 'navigation.php';
include '../../database/dbconnect.php';

if (!isset($_GET['order_id'])) {
  die("Order ID not provided.");
}

$order_id = $_GET['order_id']; // Get the order_id from the URL

$order_items_query = "
    SELECT products.product_image, products.product_name, products.product_price, order_items.quantity, order_items.subtotal
    FROM order_items
    JOIN products ON order_items.product_id = products.product_id
    WHERE order_items.order_id = ?
";

$stmt = $connection->prepare($order_items_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/my_order_details.css">
</head>
<body>
    <div class="container mt-4">
        <h4>Order Details</h4>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>IMAGE</th>
                    <th>PRODUCT NAME</th>
                    <th>UNIT PRICE</th>
                    <th>QUANTITY</th> 
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><img src="/assets/images/<?= $row['product_image'] ?>" alt="no image"></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php echo $row['product_price'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <td><?php echo $row['subtotal'];?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
      function navigateTo(url) {
        window.location.href = url;
      }
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>