<?php
    session_start();
    include '../../database/dbconnect.php';
    
    // Get total sales
    $total_sales_query = "SELECT SUM(total_amount) AS total FROM payments";
    $total_sales_result = $connection->query($total_sales_query);
    $total_sales = 0;
    if($total_sales_result && $total_sales_result->num_rows > 0) {
        $total_sales_row = $total_sales_result->fetch_assoc();
        $total_sales = $total_sales_row['total'] ?: 0;
    }
    
    // Get yesterday's sales
    $today_sales = 0;
    try {
        // Get current date in server's timezone
        $current_date = new DateTime('now', new DateTimeZone(date_default_timezone_get()));
        $today_start = $current_date->format('Y-m-d 00:00:00');
        $today_end = $current_date->format('Y-m-d 23:59:59');
    
        // Use prepared statement with proper time range
        $today_sales_query = "SELECT COALESCE(SUM(p.total_amount), 0) AS today_total 
                             FROM payments p 
                             INNER JOIN orders o ON p.order_id = o.order_id 
                             WHERE o.order_date BETWEEN ? AND ?";
        
        $stmt = $connection->prepare($today_sales_query);
        $stmt->bind_param("ss", $today_start, $today_end);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result) {
            $today_sales_row = $result->fetch_assoc();
            $today_sales = (float)$today_sales_row['today_total'];
        }
        $stmt->close();
    } catch (Exception $e) {
        error_log("Error fetching today's sales: " . $e->getMessage());
        $today_sales = 0;
    }
    
    // Get total users - changed to count all users by ID
    $users_query = "SELECT COUNT(ID) AS total_users FROM users";
    $users_result = $connection->query($users_query);
    $users_count = 0;
    if($users_result && $users_result->num_rows > 0) {
        $users_count = $users_result->fetch_assoc()['total_users'];
    }
    
    // Get orders with pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 5; 
    $offset = ($page - 1) * $limit;
    
    $orders_query = "SELECT o.order_id, o.ID, o.order_date, p.payment_id, p.total_amount 
                    FROM orders o 
                    JOIN payments p ON o.order_id = p.order_id 
                    ORDER BY o.order_date DESC 
                    LIMIT $limit OFFSET $offset";
    $orders_result = $connection->query($orders_query);
    
    // Get total number of orders for pagination
    $total_orders_query = "SELECT COUNT(*) as count FROM orders";
    $total_orders_result = $connection->query($total_orders_query);
    $total_orders = 0;
    if($total_orders_result && $total_orders_result->num_rows > 0) {
        $total_orders = $total_orders_result->fetch_assoc()['count'];
    }
    $total_pages = ceil($total_orders / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMERCH - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container" style="margin-left: 20px;">
            <img src="/assets/images/logo.png" alt="UMERCH Logo" class="img-fluid">
        </div>
        
        <div class="admin-profile">
            <div class="profile-pic">
                <img src="/assets/images/profile-icon.png" alt="Admin" class="rounded-circle" width="50">
            </div>
            <div class="mt-2">
                <h6 class="mb-0">Admin</h6>
            </div>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item active">
                <a href="admin.php" class="nav-link">
                    <i class="fa-solid fa-gauge-simple-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="product.php" class="nav-link">
                    <i class="fa-solid fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        
        <div class="topbar d-flex justify-content-end">
            <div class="user-dropdown">
                <div class="dropdown align-items-end">
                    <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="/assets/images/profile-icon.png" alt="Admin" class="rounded-circle" width="30">
                        <span class="ms-2">Admin</span>
                        <i class="fa-solid fa-caret-down ms-2"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php?destination=login">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- MESSAGE -->
        <div class="dashboard-header mb-2">
            <div class="container py-3">
                <h4 class="mb-1 fw-bold">Dashboard</h4>
                <small class="text-muted">Welcome back Admin, everything looks great.</small>
            </div>
        </div>
            
        <div class="stats-row mt-4">
            <div class="stat-card blue-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block text-white">TOTAL SALES</small>
                        <h3 class="mt-1 text-white">₱<?php echo number_format($total_sales, 2); ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-peso-sign text-white-50 fa-2x"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card red-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block text-white">TOTAL USERS</small>
                        <h3 class="mt-1 text-white"><?php echo number_format($users_count); ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-users text-white-50 fa-2x"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card green-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block text-white">YESTERDAY'S SALES</small>
                        <h3 class="mt-1 text-white">₱<?php echo number_format($today_sales, 2); ?></h3>
                        <!-- <?php echo number_format($today_sales, 2); ?> -->
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-chart-line text-white-50 fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="container mt-4">
                <div class="card table-card">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">ORDER LIST</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search orders...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover border-table mb-0" id="ordersTable">
                                <thead>
                                    <tr>
                                        <th>ORDER ID</th>
                                        <th>PAYMENT ID</th>
                                        <th>USER ID</th>
                                        <th>ORDER DATE</th>
                                        <th>TOTAL</th>
                                        <!-- <th>ACTIONS</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($orders_result && $orders_result->num_rows > 0) {
                                        while($order = $orders_result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['payment_id']; ?></td>
                                        <td><?php echo $order['ID']; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                        <td>₱<?php echo number_format($order['total_amount'], 2); ?></td>
                                        <!-- <td>
                                            <a href="view_order.php?id=<?php echo $order['order_id']; ?>" class="btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No orders found</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <nav aria-label="Order pagination">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="<?php echo ($page <= 1) ? 'true' : 'false'; ?>">Previous</a>
                                </li>
                                
                                <?php 
                                $start_page = max(1, $page - 2);
                                $end_page = min($total_pages, $page + 2);
                                
                                for($i = $start_page; $i <= $end_page; $i++): 
                                ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- view details -->
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
            <div class="footer mt-3">
                <p class="mb-0">Copyright © 2025 Merchandise | Powered by UMERCH</p>
            </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#ordersTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>