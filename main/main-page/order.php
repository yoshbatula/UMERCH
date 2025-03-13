<?php
// filepath: c:\xampp\htdocs\UMERCH\main\main-page\order.php
include 'navigation.php';
include '../../database/dbconnect.php';

if (!isset($_SESSION['ID'])) {
    die("User session not found.");
}

$subtotal = 0;
$tax_rate = 0.01; 
$tax = 0;
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/order.css">
    <!-- Make sure Bootstrap JS is loaded correctly -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="cart-header">
          <span class="inactive" onclick="navigateTo('cart.php')"><span class="step-number">01</span> <span class="step-text">Shopping Cart</span></span>
          <span class="active"><span class="step-number">02</span> <span class="step-text">Complete-Order</span></span>
        </div>

        <div class="order-container">
          <h4 class="fw-bold">YOUR ORDER</h4>
          <hr>
      
          <!-- Give the form an ID so we can reference it -->
          <form id="orderForm" action="order_place.php" method="POST" enctype="multipart/form-data">
            <table class="table order-table">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th class="text-end">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT products.product_name, products.product_price, carts.quantity, carts.subtotal, carts.ID, carts.product_id
                              FROM carts 
                              JOIN products ON carts.product_id = products.product_id 
                              WHERE carts.ID = ?";

                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("i", $_SESSION['ID']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $_SESSION['raw-total'] = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_total = $row['product_price']; 
                        $subtotal += $item_total;
                ?>
                    <tr>
                        <td><?php echo $row['product_name'];?> × <?php echo $row['quantity'];?></td>
                        <td class="text-end"><?php echo $row['subtotal'];?></td>
                    </tr>
                    <?php $_SESSION['raw-total'] += $row['subtotal']; ?>
                <?php } ?>
                    <tr>
                        <td><strong>RAW TOTAL</strong></td>
                        <td class="text-end"><?php echo number_format($_SESSION['raw-total'], 2); ?></td>
                    </tr>
                    <tr>
                        <?php  
                            $tax = 0.01 * $_SESSION['raw-total'];
                            $grandtotal = $_SESSION['raw-total'] + $tax;
                            // Store the total in session
                            $_SESSION['grandtotal'] = $grandtotal;
                        ?>
                        <td><strong>TAX</strong></td>
                        <td class="text-end">+<?php echo number_format($tax, 2); ?></td>
                    </tr>
                    <tr>
                        <td><strong>PAYMENT METHOD</strong></td>
                        <td class="text-end">
                            <select class="payment-method" name="payment_method" style="width: 160px;" required>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="GCash">GCash</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>TOTAL</strong></td>
                        <td class="text-end order-total"><?php echo number_format($grandtotal, 2); ?></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="place-order-div">
                <button type="button" class="btn btn-place-order mt-3" data-bs-toggle="modal" data-bs-target="#placeOrderModal">PLACE ORDER</button>
            </div>
          </form>

          <!-- PLACE ORDER MODAL - removed nested form -->
          <div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="placeOrderModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="placeOrderModalLabel">Confirm Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <p>Confirm placing order?</p>
                          <p>Total amount: <strong><?php echo number_format($grandtotal, 2); ?></strong></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="submitOrder()">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <script>
      function navigateTo(url) {
        window.location.href = url;
      }
      
      function submitOrder() {
        
        document.getElementById('orderForm').submit();
      }

      document.addEventListener('DOMContentLoaded', function() {
          <?php if(isset($_SESSION['message'])): ?>
              Swal.fire({
                  icon: '<?php echo $_SESSION['message_type']; ?>',
                  title: '<?php echo $_SESSION['message']; ?>',
                  showConfirmButton: false,
                  timer: 1500
              });
              <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
          <?php endif; ?>
      });
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>