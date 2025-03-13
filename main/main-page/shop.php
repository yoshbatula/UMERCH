<?php
include 'navigation.php';
include '../../database/dbconnect.php';

// Pagination configuration
$per_page = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

// Get total products
$count_query = "SELECT COUNT(*) AS total FROM products";
$count_result = mysqli_query($connection, $count_query);
$total_row = mysqli_fetch_assoc($count_result);
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $per_page);

// Validate page range
if ($total_pages > 0 && $page > $total_pages) {
    $page = $total_pages;
}

// Calculate offset
$offset = ($page - 1) * $per_page;

// Query with pagination
$query = "SELECT * FROM products LIMIT $per_page OFFSET $offset";
$result = mysqli_query($connection, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Check if user is logged in
    if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
        $_SESSION['message'] = "Please log in to add items to your cart";
        $_SESSION['message_type'] = "error";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if product already exists in user's cart in the database
    $check_cart_query = "SELECT * FROM carts WHERE ID = ? AND product_id = ?";
    $check_cart_stmt = $connection->prepare($check_cart_query);
    $check_cart_stmt->bind_param("ii", $_SESSION['ID'], $product_id);
    $check_cart_stmt->execute();
    $check_cart_result = $check_cart_stmt->get_result();
    
    // Get product information
    $product_query = "SELECT product_id, product_name, product_price, product_image FROM products WHERE product_id = ?";
    $stmt = $connection->prepare($product_query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();
    
    $quantity = 1;
    
    if ($product = mysqli_fetch_assoc($product_result)) {
        if ($check_cart_result->num_rows > 0) {
            // Update quantity if product already in cart
            $update_query = "UPDATE carts SET quantity = quantity + 1, subtotal = subtotal + ? WHERE ID = ? AND product_id = ?";
            $update_stmt = $connection->prepare($update_query);
            $update_stmt->bind_param("dii", $product['product_price'], $_SESSION['ID'], $product_id);
            $update_stmt->execute();
            
            if ($update_stmt->affected_rows > 0) {
                $_SESSION['message'] = "Product quantity updated in cart!";
                $_SESSION['message_type'] = "success";
                
                // Add to session cart if not already there
                if (!in_array($product_id, $_SESSION['cart'])) {
                    $_SESSION['cart'][] = $product_id;
                }
            } else {
                $_SESSION['message'] = "Failed to update cart";
                $_SESSION['message_type'] = "error";
            }
        } else {
            // Product does not exist, insert a new record
            $subtotal = $product['product_price'] * $quantity;
            $insert_cart_query = "INSERT INTO carts (ID, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
            $insert_cart_stmt = $connection->prepare($insert_cart_query);
            $insert_cart_stmt->bind_param("iiid", $_SESSION['ID'], $product_id, $quantity, $subtotal);
            
            if ($insert_cart_stmt->execute()) {
                $_SESSION['message'] = "Product added to cart successfully!";
                $_SESSION['message_type'] = "success";
                
                // Add to session cart
                $_SESSION['cart'][] = $product_id;
            } else {
                $_SESSION['message'] = "Error adding product to cart.";
                $_SESSION['message_type'] = "error";
            }
        }
    } else {
        $_SESSION['message'] = "Product not found";
        $_SESSION['message_type'] = "error";
    }
    
    $redirect = $_SERVER['PHP_SELF'];
    if (isset($_GET['page'])) {
        $redirect .= '?page=' . $_GET['page'] . '&added=1';
    } else {
        $redirect .= '?added=1';
    }
    header("Location: " . $redirect);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- HEADER IMAGE -->
<div class="d-flex">
    <div class="label-check-form text-center">
        <div class="img-oten">
        <img src="/assets/images/headerimg.png" alt="">
        </div>
        
        <div class="overlay justify-content-center">
            <p>PRODUCT LIST</p>
            <h6>HOME / SHOP</h6>
        </div>
    </div>
</div>
<!-- DROPDOWN -->
<section>
    <div class="container mt-4">
        <hr>
        <hr>
    </div>
</section>
        <div class="container mt-3">
                <div class="row g-3">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-3">
                            <div class="card custom-card-height" style="width: 90%; height: 100%;">
                                <img src="/assets/images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="product-image">
                                <div class="card-body" style="background-color: #B02A24;">
                                    <h5 class="card-title" style="color: white;"><?= $row['product_name'] ?></h5> 
                                    <div class="d-flex flex-row gap-2">
                                        <!-- <p class="card-text text-decoration-line-through text-warning opacity-75">150</p>  -->
                                        <p class="" style="color: white;">&nbsp;&nbsp;<?php echo "₱". $row['product_price'] ?></p> 
                                    </div>
                                    <div class="d-flex flex-row ms-2">
                                        
                                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                            <button type="submit" class="btn btn-warning" id="add-to-cart">
                                                <i class="fa-solid fa-cart-shopping" id="cart-button" style="font-size: 10px;"> Add to Cart</i>
                                            </button>
                                        </form>
                                        <form action="wishlist_add.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                            <button type="submit" class="btn-link border-0 bg-transparent">
                                                <i class="fa-regular fa-heart" style="color: white; font-size: 16px; transform: translateY(3px);"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- View Button -->
                                        <a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#productModal<?= $row['product_id'] ?>">
                                            <i class="fa-solid fa-eye" id="view-button"></i>
                                        </a>

                                        <!-- Product Modal -->
                                        <div class="modal fade" id="productModal<?= $row['product_id'] ?>" tabindex="-1" aria-labelledby="productModalLabel<?= $row['product_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="productModalLabel<?= $row['product_id'] ?>"><?= $row['product_name'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img src="/assets/images/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5>Description</h5>
                                                                <p><?= $row['product_description'] ?></p>
                                                                <h5>Price</h5>
                                                                <p><?= $row['product_price'] ?></p>
                                                                <h5>Stock Count</h5>
                                                                <p><?= $row['stock'] ?></p>
                                                                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                                                    <button type="submit" class="btn btn-warning" name="cart">Add to Cart</button>
                                                                </form>
                                                                <form action="wishlist_add.php" method="POST">
                                                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                                                    <button type="submit" class="btn btn-outline-danger">
                                                                        <i class="fa-regular fa-heart"></i> Add to Wishlist
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
</section>
<section>
    <nav class="container" aria-label="Product pagination">
        <hr>
        <?php if ($total_pages > 1): ?>
        <ul class="mt-3 pagination justify-content-center">
            <!-- Previous Page Button -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?page=<?= $page - 1 ?>" 
                   <?= $page <= 1 ? 'tabindex="-1" aria-disabled="true"' : '' ?>>
                    &laquo;
                </a>
            </li>

            <?php
            // Calculate page range with ellipsis logic
            $range = 2;
            $start = max(1, $page - $range);
            $end = min($total_pages, $page + $range);

            // Show first page + ellipsis if needed
            if ($start > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if ($start > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }

            // Generate page number links
            for ($i = $start; $i <= $end; $i++) {
                $active = $i == $page ? 'active' : '';
                echo "<li class='page-item $active'>";
                echo "<a class='page-link' href='?page=$i'>$i</a>";
                echo "</li>";
            }

            // Show last page + ellipsis if needed
            if ($end < $total_pages) {
                if ($end < $total_pages - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                echo "<li class='page-item'>";
                echo "<a class='page-link' href='?page=$total_pages'>$total_pages</a>";
                echo "</li>";
            }
            ?>

            <!-- Next Page Button -->
            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?page=<?= $page + 1 ?>" 
                   <?= $page >= $total_pages ? 'tabindex="-1" aria-disabled="true"' : '' ?>>
                    &raquo;
                </a>
            </li>
        </ul>
        <?php endif; ?>

        <!-- Product Count Display -->
        <div class="text-center text-muted mt-2 mb-3">
            <?php if ($total_products > 0): ?>
                Page <?= $page ?> of <?= $total_pages ?> - 
                Showing <?= number_format($offset + 1) ?> - 
                <?= number_format(min($offset + $per_page, $total_products)) ?> of 
                <?= number_format($total_products) ?> products
            <?php else: ?>
                No products found
            <?php endif; ?>
        </div>
        <hr>
    </nav>
</section>
<?php
    include 'footer.php';
?>
<script>
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

        console.log("Page loaded");
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>