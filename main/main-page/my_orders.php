<?php
include 'navigation.php';
include '../../database/dbconnect.php';

if (!isset($_SESSION['ID'])) {
    die("User session not found.");
}

$order_query = "
    SELECT orders.order_id, payments.payment_id, payments.payment_method, orders.order_date, payments.total_amount
    FROM orders
    JOIN payments ON orders.order_id = payments.order_id
    WHERE orders.ID = ?
    ORDER BY orders.order_date DESC
    ";

$stmt = $connection->prepare($order_query);
$stmt->bind_param("i", $_SESSION['ID']);
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/my_orders.css">
</head>
<body>
    <div class="container mt-4">
        <h4>Order History</h4>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ORDER ID</th>
                    <th>PAYMENT ID</th>
                    <th>PAYMENT METHOD</th>
                    <th>ORDER DATE</th> 
                    <th>TOTAL</th>
                    <th>VIEW ORDERS</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['payment_id'];?></td>
                    <td><?php echo $row['payment_method'];?></td>
                    <td><?php echo $row['order_date'];?></td>
                    <td><?php echo $row['total_amount'];?></td>
                    <td>
                    <button class="btn btn-primary view-btn" onclick="window.location.href='my_order_details.php?order_id=<?php echo $row['order_id']; ?>'">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
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