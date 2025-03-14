<?php
include 'navigation.php';
include '../../database/dbconnect.php';

$subtotal = 0;
$tax_rate = 0.01; 
$tax = 0;
$total = 0;

// Check for empty cart
$check_empty_query = "SELECT COUNT(*) as count FROM carts WHERE ID = ?";
$check_empty_stmt = $connection->prepare($check_empty_query);
$check_empty_stmt->bind_param("i", $_SESSION['ID']);
$check_empty_stmt->execute();
$check_empty_result = $check_empty_stmt->get_result();
$cart_count = $check_empty_result->fetch_assoc()['count'];
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
          <span class="inactive"><span class="step-number">02</span> <span class="step-text">Complete-Order</span></span>
        </div>
        
        <?php if ($cart_count === 0): ?>
            <div class="text-center my-5">
                <h3>Your cart is empty</h3>
                <p>Browse our products and add items to your cart</p>
                <a href="shop.php" class="btn btn-warning text-white">Continue Shopping</a>
            </div>
        <?php else: ?>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <th>UNIT PRICE</th>
                        <th>QUANTITY</th>
                        <th>SUBTOTAL</th>
                        <th>REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT products.product_image, products.product_name, products.product_price, products.stock,
                                carts.quantity, carts.subtotal, carts.ID, carts.product_id
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
                        // Calculate the actual subtotal based on current quantity and price
                        $item_total = $row['product_price'] * $row['quantity']; 
                        $subtotal += $item_total;
                    ?>
                    <tr>
                        <td><img src="/assets/images/<?php echo $row['product_image']; ?>" alt="Product Image" class="img-thumbnail" style="max-width: 100px;"></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><?php echo number_format($row['product_price'], 2); ?></td>
                        <form method="post" action="cart_update.php">
                            <td class="quantity-box">
                                <button type="submit" name="decrease" class="btn btn-outline-secondary">-</button>
                                <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['product_price']; ?>">
                                <input type="hidden" name="stock" value="<?php echo $row['stock']; ?>">
                                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control d-inline w-auto" readonly>
                                <button type="submit" name="increase" class="btn btn-outline-secondary">+</button>
                            </td>
                        </form>
                        <td><?php echo number_format($item_total, 2); ?></td>
                        <td>
                            <button class="btn btn-danger remove-btn" data-bs-toggle="modal" data-bs-target="#deleteCartItemModal<?php echo $row['product_id']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <!-- DELETE CART MODAL-->
                        <div class="modal fade" id="deleteCartItemModal<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="deleteCartItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to remove "<?php echo $row['product_name']; ?>" from the cart?
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
                    </tr>
                    <?php 
                        $_SESSION['raw-total'] += $item_total;
                    ?>
                    <?php }?>
                </tbody>
            </table>
            
            <div class="main-container">
                <div class="cart-section">
                    <div class="cart-actions">
                        <a href="shop.php" class="continue-shopping">CONTINUE SHOPPING</a>
                        <form action="cart_clear.php" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to clear your cart?');">
                            <button type="submit" class="btn btn-outline-danger">CLEAR CART</button>
                        </form>
                    </div>
                   
                </div>
                        
                <div class="cart-footer mb-2">
                    <h3>Cart Totals</h3>
                    <p><strong>SUBTOTAL:</strong> <span class="subtotal-price"><?php echo number_format($_SESSION['raw-total'], 2);?></span></p>

                    <?php  
                        $tax = $tax_rate * $_SESSION['raw-total'];
                        $grandtotal = $_SESSION['raw-total'] + $tax;
                        
                        // Store in session for checkout
                        $_SESSION['cart_subtotal'] = $_SESSION['raw-total'];
                        $_SESSION['cart_tax'] = $tax;
                        $_SESSION['cart_total'] = $grandtotal;
                    ?>
                    
                    <p><strong>TAX (<?php echo ($tax_rate * 100); ?>%):</strong> <span class="total-price"><?php echo number_format($tax, 2);?></span></p>

                    <p class="total"><strong>TOTAL:</strong> <span class="total-price"><?php echo number_format($grandtotal, 2);?></span></p>
                    <div class="checkout-div">
                      <a href="order.php" class="checkout">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>




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