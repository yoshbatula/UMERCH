<?php
include 'navigation.php';
include '../../database/dbconnect.php';

// Make sure user is logged in
if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
    $_SESSION['message'] = "Please log in to view your wishlist";
    $_SESSION['message_type'] = "error";
    header("Location: login.php");
    exit();
}

// Check if the wishlist is empty
$check_empty_query = "SELECT COUNT(*) as count FROM wishlist WHERE ID = ?";
$check_empty_stmt = $connection->prepare($check_empty_query);
$check_empty_stmt->bind_param("i", $_SESSION['ID']);
$check_empty_stmt->execute();
$check_empty_result = $check_empty_stmt->get_result();
$wishlist_count = $check_empty_result->fetch_assoc()['count'];

$wishlist = [];
if ($wishlist_count > 0) {
    $query = "SELECT products.product_image, products.product_name, products.product_price,
                     products.stock, wishlist.ID, wishlist.product_id
              FROM wishlist
              JOIN products ON wishlist.product_id = products.product_id
              WHERE wishlist.ID = ?";
              
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $_SESSION['ID']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $wishlist[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISHLIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/wishlist.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex">
        <div class="label-check-form text-center">
            <img src="/assets/images/headerimg.png" alt="">
            <div class="overlay justify-content-center">
                <p>WISHLIST DETAILS</p>
                <h6>HOME / WISHLIST</h6>
            </div>
        </div>
    </div>
    <section class="wishlist">
        <div class="container mt-4">
            <h3>My Wishlist</h3>
            <?php if ($wishlist_count === 0): ?>
            <div class="text-center my-5">
                <h3>Your wishlist is empty</h3>
                <p>Browse our products and add items to your wishlist</p>
                <a href="shop.php" class="btn btn-warning text-white">Continue Shopping</a>
            </div>
            <?php else: ?>
                <div class="mt-4">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>UNIT PRICE</th>
                        <th>STOCK</th>
                        <th>ADD ITEM</th>
                        <th>REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach ($wishlist as $item): ?>
                    <tr>
                        <td><img src="/assets/images/<?= $item['product_image'] ?>" alt="<?= $item['product_name'] ?>" width="100"></td>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= $item['product_price'] ?></td>
                        <td><?= $item['stock'] ?></td>
                        <td>
                            <form method="POST" action="wishlist_add_cart.php">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </td>
                        <td><a href="wishlist_remove.php?product_id=<?= $item['product_id'] ?>" class="btn btn-danger">Remove</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                </div>
            </div>
            <?php endif; ?>
    </section>
    
    <?php include 'footer.php'; ?>
    
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
        });
    </script>
</body>
</html>