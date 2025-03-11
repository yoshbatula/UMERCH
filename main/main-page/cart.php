<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/cart.css">
</head>
<body>
    <?php
    include 'navigation.php';
    ?>
    <div class="container mt-4">
        <div class="cart-header">
          <span class="active"><span class="step-number">01</span> <span class="step-text">Shopping Cart</span></span>
          <span class="inactive" onclick="navigateTo('checkout.html')"><span class="step-number">02</span> <span class="step-text">Checkout</span></span>
          <span class="inactive" onclick="navigateTo('order.html')"><span class="step-number">03</span> <span class="step-text">Complete-Order</span></span>
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
                <tr>
                    <td><img src="https://via.placeholder.com/80" alt="Product Image"></td>
                    <td>Fusce Laoreet Volutpat</td>
                    <td>$130.00</td>
                    <td class="quantity-box">
                        <button class="btn btn-outline-secondary">-</button>
                        <input type="text" value="1" class="form-control d-inline w-auto">
                        <button class="btn btn-outline-secondary">+</button>
                    </td>
                    <td>$130.00</td>
                    <td>
                        <button class="btn btn-danger remove-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/80" alt="Product Image"></td>
                    <td>Fusce Laoreet Volutpat</td>
                    <td>$140.00</td>
                    <td class="quantity-box">
                        <button class="btn btn-outline-secondary">-</button>
                        <input type="text" value="1" class="form-control d-inline w-auto">
                        <button class="btn btn-outline-secondary">+</button>
                    </td>
                    <td>$140.00</td>
                    <td>
                        <button class="btn btn-danger remove-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="main-container">
            <div class="cart-section">
                <div class="cart-actions">
                    <button class="update-cart">UPDATE CART</button>
                    <button class="continue-shopping">CONTINUE SHOPPING</button>
                </div>
               
                <div class="coupon-box mb-2">
                    <h3>Coupon</h3>
                    <p>Enter your coupon code if you have one.</p>
                    <input type="text" placeholder="Coupon">
                    <button class="apply-coupon">APPLY COUPON</button>
                </div>
            </div>
       
            <div class="cart-footer">
                <h3>Cart Totals</h3>
                <p><strong>SUBTOTAL:</strong> <span class="total-price">$150.00</span></p>
                <p><strong>TAX:</strong> <span class="total-price">$3.00</span></p>
                <p><strong>COUPON DISCOUNT:</strong> <span class="total-price">$-5.00</span></p>


                <p class="total"><strong>TOTAL:</strong> <span class="total-price">$148.00</span></p>
                <div class="checkout-div">
                  <button class="checkout">PROCESS TO CHECKOUT</button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
      function navigateTo(url) {
        window.location.href = url;
      }
    </script>
</body>
</html>