<?php
    session_start();

    include '../../database/dbconnect.php';

    // Initialize cart count variable
    $cart_count = 0;
    
    // Check if user is logged in
    if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
        // Query to count items in cart for this user
        $cart_query = "SELECT SUM(quantity) as total_items FROM carts WHERE ID = ?";
        $cart_stmt = $connection->prepare($cart_query);
        $cart_stmt->bind_param("i", $_SESSION['ID']);
        $cart_stmt->execute();
        $cart_result = $cart_stmt->get_result();
        
        if ($cart_row = $cart_result->fetch_assoc()) {
            $cart_count = $cart_row['total_items'] ?: 0; // Use null coalescing to handle NULL result
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMerch Store</title>
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="brand-logo">
                    <a href="#">
                        <!-- Updated logo alt text -->
                        <img src="/assets/images/logo.png" alt="UMerch Logo" class="ms-3">
                    </a>
                </div>

                <ul class="nav-menu">
                    <li class="nav-item"><a href="mainpage.php">HOME</a></li>
                    <li class="nav-item"><a href="wishlist.php">WISHLIST</a></li>
                    <li class="nav-item"><a href="shop.php">SHOP</a></li>
                    <li class="nav-item"><a href="aboutUs.php">ABOUT US</a></li>
                </ul>
            </div>

            <div class="nav-actions">
               
                <a href="cart.php" class="icon-btn"><img src="/assets/images/cart-icon.png" alt="Cart"></a>
                <span class="text-white" style="transform: translateX(-20px); font-size:16px;" id="cart-count"><?= $cart_count ?></span>
                
                <a href="my_orders.php" class="icon-btn text-white" style="transform: translateX(-15px); font-size: 16px;"><i class="fa-solid fa-table-list"></i>></a>
                
                <div class="dropdown">
                    <a href="#" class="icon-btn dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transform: translateX(-10px);">
                        <img src="/assets/images/profile-icon.png" alt="Profile">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><span class="dropdown-item-text"><?php echo $_SESSION['user_fullname']?></span></li>
                        <hr>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>

            <button class="hamburger" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </nav>
    </header>
</body>
</html>