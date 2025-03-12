<?php
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
    <link rel="stylesheet" href="/css/cart.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="cart-header">
          <span class="active"><span class="step-number">01</span> <span class="step-text">Shopping Cart</span></span>
          <span class="inactive" onclick="navigateTo('checkout.php')"><span class="step-number">02</span> <span class="step-text">Checkout</span></span>
          <span class="inactive" onclick="navigateTo('order.php')"><span class="step-number">03</span> <span class="step-text">Complete-Order</span></span>
        </div>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>IMAGE</th>
                    <th>PRODUCT NAME</th>
                    <th>UNIT PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                    <th>REMOVE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT products.product_image, products.product_name, products.product_price, carts.quantity, carts.subtotal, carts.ID, carts.product_id
                    FROM carts 
                    JOIN products ON carts.product_id = products.product_id 
                    WHERE carts.ID = ?";
      
                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("i", $_SESSION['ID']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                ?>
                <?php
                $_SESSION['raw-total'] = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $item_total = $row['product_price']; 
                    $subtotal += $item_total;
                ?>
                <tr>
                    <td><img src="/assets/images/<?php echo $row['product_image']; ?>" alt="Product Image"></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <form method="post" action="cart_update.php">
                        <td class="quantity-box">
                            <button type="submit" name="decrease" class="btn btn-outline-secondary">-</button>
                            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control d-inline w-auto" readonly>
                            <button type="submit" name="increase" class="btn btn-outline-secondary">+</button>
                        </td>
                    </form>
                    <td><?php echo $row['subtotal']; ?></td>
                    <td>
                        <button class="btn btn-danger remove-btn" data-bs-toggle="modal" data-bs-target="#deleteCartItemModal<?php echo $row['product_id']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <!-- DELETE CART MODAL-->
                <div class="modal fade" id="deleteCartItemModal<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="deleteCartItemModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to remove this from the cart?
                            </div>
                            <div class="modal-footer">
                                <form action="cart_delete.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $_SESSION['raw-total'] = $_SESSION['raw-total'] + $row['subtotal'];
                    $deleteProduct = $row['subtotal'];
                ?>
                <?php }?>
            </tbody>
        </table>
        
        <div class="main-container">
            <div class="cart-section">
                <div class="cart-actions">
                    <button class="update-cart">UPDATE CART</button>
                    <a href="shop.php" class="continue-shopping">CONTINUE SHOPPING</a>
                </div>
               
            </div>
                    
            <div class="cart-footer mb-2">
                <h3>Cart Totals</h3>
                <p><strong>SUBTOTAL:</strong> <span class="subtotal-price"><?php echo number_format($_SESSION['raw-total'], 2);?></span></p>

                <?php  
                    $tax = 0.01 * $_SESSION['raw-total'];
                    $grandtotal = $_SESSION['raw-total'] + $tax;
                ?>
                
                <p><strong>TAX:</strong> <span class="total-price"><?php echo number_format($tax, 2);?></span></p>

                <p class="total"><strong>TOTAL:</strong> <span class="total-price"><?php echo number_format($grandtotal, 2);?></span></p>
                <div class="checkout-div">
                  <a href="checkout.php" class="checkout">PROCESS TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      function navigateTo(url) {
        window.location.href = url;
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
</body>
</html>