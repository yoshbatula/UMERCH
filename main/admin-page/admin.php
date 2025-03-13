<?php
    session_start();
    include '../../database/dbconnect.php';
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
                <img src="/assets/images/profile-icon.png" alt="Admin" class="rounded-circle" width="60">
            </div>
            <div class="mt-2">
                <h6 class="mb-0">Admin</h6>
            </div>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="admin.php" class="nav-link">
                    <i class="fa-solid fa-gauge-simple-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item active">
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
                        <h3 class="mt-1 text-white">$5,74.12</h3>
                    </div>
                </div>
            </div>
            
            <div class="stat-card red-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block text-white">TOTAL USERS</small>
                        <h3 class="mt-1 text-white">$5,74.12</h3>
                    </div>
                </div>
            </div>
            
            <div class="stat-card green-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block text-white">TODAY SALES</small>
                        <h3 class="mt-1 text-white">$5,74.12</h3>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ORD-001</td>
                                        <td>1</td>
                                        <td>Mar 10, 2025</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>150</td>
                                    </tr>
                                    <tr>
                                        <td>ORD-002</td>
                                        <td>2</td>
                                        <td>Mar 11, 2025</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>150</td>
                                    </tr>
                                    <tr>
                                        <td>ORD-003</td>
                                        <td>3</td>
                                        <td>Mar 12, 2025</td>
                                        <td><span class="badge bg-info">Processing</span></td>
                                        <td>150</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <nav aria-label="Order pagination">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="footer mt-3">
                <p class="mb-0">Copyright © 2025 Merchandise | Powered by UMERCH</p>
            </div>
    </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>
</html>