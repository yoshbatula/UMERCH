<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMERCH - Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/product.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="/assets/images/logo.png" alt="UMERCH Logo" class="img-fluid">
        </div>
        
        <div class="admin-profile">
            <div class="profile-pic">
                <img src="/assets/images/profile-icon.png" alt="Admin" class="rounded-circle" width="80">
            </div>
            <div class="mt-2">
                <h6 class="mb-0">Admin</h6>
            </div>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-gauge-simple-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        
    <div class="topbar">
        <div class="user-dropdown">
            <div class="dropdown align-items-end">
                <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                    <img src="/assets/images/profile-icon.png" alt="Admin" class="rounded-circle" width="30">
                    <span class="ms-2">Admin Name</span>
                    <i class="fa-solid fa-caret-down ms-2"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- MESSAGE -->
    <div class="mt-2">
        <h4 style="margin-left: 20px;">Products</h4>
        <small style="margin-left: 20px;">Welcome back Admin, everything looks great.</small>
    </div>
        <!-- Product List Section -->
        <div class="product-list-container">
            <div class="product-list-card">
                <h4 class="mb-4">Product List</h4>
                
                <button class="add-product-btn">
                    <i class="fa-solid fa-plus me-2"></i>Add New Product
                </button>
                
                <div class="d-flex justify-content-end mb-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Stock</th>
                                <th>Stock Count</th>
                                <th>Product Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="/api/placeholder/50/50" alt="Product 1" class="product-image"></td>
                                <td>1</td>
                                <td>Product 1</td>
                                <td>$10.00</td>
                                <td>In Stock</td>
                                <td>100</td>
                                <td>Clothing</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="/api/placeholder/50/50" alt="Product 2" class="product-image"></td>
                                <td>2</td>
                                <td>Product 2</td>
                                <td>$20.00</td>
                                <td>In Stock</td>
                                <td>50</td>
                                <td>Clothing</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="/api/placeholder/50/50" alt="Product 3" class="product-image"></td>
                                <td>3</td>
                                <td>Product 3</td>
                                <td>$30.00</td>
                                <td>Out of Stock</td>
                                <td>0</td>
                                <td>Accessories</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="/api/placeholder/50/50" alt="Product 4" class="product-image"></td>
                                <td>4</td>
                                <td>Product 4</td>
                                <td>$40.00</td>
                                <td>In Stock</td>
                                <td>200</td>
                                <td>Accessories</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="/api/placeholder/50/50" alt="Product 5" class="product-image"></td>
                                <td>5</td>
                                <td>Product 5</td>
                                <td>$50.00</td>
                                <td>In Stock</td>
                                <td>150</td>
                                <td>Clothing</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p class="mb-0">Copyright © 2025 Merchandise | Powered by UMERCH</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function() {
                    this.querySelector('.dropdown-menu').classList.toggle('show');
                });
            });
            
            const addButton = document.querySelector('.add-product-btn');
            addButton.addEventListener('click', function() {
                alert('Add new product form would open here');
            });
        });
    </script>
</body>
</html>