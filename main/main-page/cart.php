<?php
include '../../database/dbconnect.php';

$cart_query = "SELECT * FROM carts";
$cart_result = mysqli_query($connection, $cart_query);


$subtotal = 0;
$tax_rate = 0.02; 
$tax = 0;
$total = 0;

$cart_count = mysqli_num_rows($cart_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/cart.css">
</head>
<body>
    <?php include 'navigation.php' ?>
    <div class="container mt-4">
        <div class="cart-header">
            <span class="active">01 Shopping Cart</span>
            <span>02 Checkout</span>
            <span>03 Complete-Order</span>
        </div>
        
        <?php if ($cart_count > 0): ?>
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
                    
                    while ($item = mysqli_fetch_assoc($cart_result)) {
                        $item_total = $item['Unit_Price']; 
                        $subtotal += $item_total;
                    ?>
                    <tr>
                        <td><img src="/assets/images/<?php echo $item['Image']; ?>" alt="<?php echo $item['Product_Name']; ?>" style="width: 80px;"></td>
                        <td><?php echo $item['Product_Name']; ?></td>
                        <td>$<?php echo number_format($item['Unit_Price'], 2); ?></td>
                        <td class="quantity-box">
                            <form method="POST" action="update_cart.php" class="d-flex justify-content-center align-items-center">
                                <input type="hidden" name="cart_id" value="<?php echo $item['Cart_ID']; ?>">
                                <button type="button" class="btn btn-outline-secondary decrease-qty">-</button>
                                <input type="text" name="quantity" value="1" class="form-control mx-2" style="width: 60px;">
                                <button type="button" class="btn btn-outline-secondary increase-qty">+</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($item_total, 2); ?></td>
                        <td>
                            <form method="POST" action="remove_item.php">
                                <input type="hidden" name="cart_id" value="<?php echo $item['Cart_ID']; ?>">
                                <button type="submit" class="btn btn-danger remove-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } 
                    
                    $tax = $subtotal * $tax_rate;
                    $total = $subtotal + $tax;
                    
                    mysqli_data_seek($cart_result, 0);
                    ?>
                </tbody>
            </table>

            <div class="main-container">
                <div class="cart-section">
                    <div class="cart-actions">
                        <button class="update-cart">UPDATE CART</button>
                        <a href="index.php" class="continue-shopping btn">CONTINUE SHOPPING</a>
                    </div>
                    
                    <div class="coupon-box mb-3">
                        <h3>Coupon</h3>
                        <p>Enter your coupon code if you have one.</p>
                        <form method="POST" action="apply_coupon.php" class="d-flex">
                            <input type="text" name="coupon_code" placeholder="Coupon" class="form-control me-2">
                            <button type="submit" class="apply-coupon">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            
                <div class="cart-footer mb-2">
                    <h3>Cart Totals</h3>
                    <p><strong>SUBTOTAL:</strong> $<?php echo number_format($subtotal, 2); ?></p>
                    <p><strong>TAX:</strong> $<?php echo number_format($tax, 2); ?></p>
                    <p><strong>PAYMENT METHOD:</strong>
                        <select class="payment-method form-select">
                            <option value="flat-rate">Cash on Delivery</option>
                            <option value="bank-transfer">GCash</option>
                        </select>
                    </p>
                    <p><strong>TOTAL:</strong> <span class="total-price">$<?php echo number_format($total, 2); ?></span></p>
                    <a href="checkout.php" class="checkout btn">PROCESS TO CHECKOUT</a>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center my-5">
                <h3>Your cart is empty</h3>
                <p>You haven't added any products to your cart yet.</p>
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php' ?>
    
    <script>
    // Simple quantity adjustment
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseButtons = document.querySelectorAll('.decrease-qty');
        const increaseButtons = document.querySelectorAll('.increase-qty');
        
        decreaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            });
        });
        
        increaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                let value = parseInt(input.value);
                input.value = value + 1;
            });
        });
    });
    </script>
</body>
</html>