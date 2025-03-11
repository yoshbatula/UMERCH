<?php
include '../../database/dbconnect.php';

$query = "SELECT * FROM products";
$result = mysqli_query($connection, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
        
        $product_query = "SELECT Product_ID, Product_Name, Unit_Price, Image FROM products WHERE Product_ID = $product_id";
        $product_result = mysqli_query($connection, $product_query);
        
        if ($product = mysqli_fetch_assoc($product_result)) {
    
            $insert_query = "INSERT INTO carts (Product_ID, Unit_Price, Product_Name, Image) 
                            VALUES ('{$product['Product_ID']}', '{$product['Unit_Price']}', 
                            '{$product['Product_Name']}', '{$product['Image']}')";
            
            mysqli_query($connection, $insert_query);
        }
    }
    
    header("Location: " . $_SERVER['PHP_SELF'] . "?added=1");
    exit();
}

if (isset($_GET['added']) && $_GET['added'] == 1) {
    $message = "Product added to cart successfully!";
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
</head>
<body>
<!-- NAVIGATION -->
<?php include 'navigation.php'; ?>
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
        <div class="d-flex justify-content-between align-items-center" id="view-dropdown">
            <div class="d-flex align-items-center">
                <label class="me-2">View</label>
                <select name="" id="" class="form-select">
                    <option select>25</option>
                    <option value="1">50</option>
                    <option value="2">100</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <label class="me-2" style="width: 100px; margin-left: 10%;">Sort By</label>
                <select name="" id="" class="form-select">
                    <option select>Default</option>
                    <option value="1"></option>
                </select>
            </div>
            <div class="view-show ms-auto">
                <label for="">Showing <strong>1-20</strong> of <strong>120</strong> results</label>
            </div>
        </div>
        <hr>
    </div>
</section>
<section>
    <div class="container mt-3">
        <div class="row g-3">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3">
                    <div class="card custom-card-height" style="width: 90%; height: 100%;">
                        <img src="/assets/images/<?php echo $row['Image']; ?>" alt="<?php echo $row['Product_Name']; ?>" class="product-image" class="thumbnail">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['Product_Name'] ?></h5> 
                            <small class="card-text">MEN</small>
                            <div class="d-flex flex-row gap-2">
                                <p class="card-text text-decoration-line-through text-danger">150</p> 
                                <p class="card-text text-success">&nbsp;&nbsp;<?= $row['Unit_Price'] ?></p> 
                            </div>
                            <div class="d-flex flex-row ms-2">
                                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    <input type="hidden" name="product_id" value="<?= $row['Product_ID'] ?>">
                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                </form>
                                <a href="product.php?id=<?= $row['Product_ID'] ?>" class="btn btn-secondary ms-2">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<section>
    <nav class="container" aria-label="Page navigation example">
        <hr>
        <ul class="mt-3 pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" tabindex="-1"><-</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#">-></a>
            </li>
        </ul>
        <hr>
    </nav>
</section>
<?php
    include 'footer.php';
?>
<?php if (isset($_GET['added']) && $_GET['added'] == 1 && isset($_SESSION['added_product'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Added to Cart!',
            text: '<?php echo $_SESSION['added_product']; ?> has been added to your cart',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    });
</script>
<?php 
    unset($_SESSION['added_product']); 
endif; 
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</script>
</body>
</html>