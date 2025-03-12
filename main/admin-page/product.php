<?php
    session_start();
    include '../../database/dbconnect.php';
    
    function handleImageUpload($file) {
        $targetDir = "../../assets/images";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($file["name"]);
        $targetFilePath = $targetDir . '/' . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($file["tmp_name"], $targetFilePath)){
                return $fileName;
            }
        }
        
        return false;
    }
    
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if($action == 'add') {
            $productName = $_POST['productName'];
            $productType = $_POST['productType'];
            $unitPrice = $_POST['unitPrice'];
            $stock = $_POST['stock'];
            $productDescription = $_POST['productDescription'];
            $imageName = null;
            if(isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
                $imageName = handleImageUpload($_FILES['productImage']);
            }
            
            $sql = "INSERT INTO products (product_image, product_name, product_price, stock, product_type, product_description) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssdiss", $imageName, $productName, $unitPrice, $stock, $productType, $productDescription);
            
            if($stmt->execute()) {
                $_SESSION['message'] = "Product added successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error adding product: " . $connection->error;
                $_SESSION['message_type'] = "danger";
            }
            
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
        
        if($action == 'edit') {
            $productId = $_POST['productId'];
            $productName = $_POST['editProductName'];
            $productType = $_POST['editProductType'];
            $unitPrice = $_POST['editUnitPrice'];
            $stockCount = $_POST['editStockCount'];
            $productDescription = $_POST['editProductDescription'];
            
            if(isset($_FILES['editProductImage']) && $_FILES['editProductImage']['error'] == 0) {
                $imageName = handleImageUpload($_FILES['editProductImage']);
                
                $sql = "UPDATE products SET 
                        product_name = ?, 
                        product_type = ?, 
                        product_description = ?,
                        product_price = ?, 
                        stock = ?,
                        product_image = ?
                        WHERE product_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sssddsi", $productName, $productType, $productDescription, $unitPrice, $stockCount, $imageName, $productId);
            } else {
                $sql = "UPDATE products SET 
                        product_name = ?, 
                        product_type = ?, 
                        product_description = ?,
                        product_price = ?, 
                        stock = ?
                        WHERE product_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sssddi", $productName, $productType, $productDescription, $unitPrice, $stockCount, $productId);
            }
            
            if($stmt->execute()) {
                $_SESSION['message'] = "Product updated successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error updating product: " . $connection->error . " - " . $stmt->error;
                $_SESSION['message_type'] = "danger";
            }
            
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }

        if($action == 'delete') {
            $productId = $_POST['deleteProductId'];
            
            $sql = "SELECT product_image FROM products WHERE product_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($row = $result->fetch_assoc()) {
                $imageName = $row['product_image'];
                
                if($imageName && file_exists("../../assets/images/".$imageName)) {
                    unlink("../../assets/images/".$imageName);
                }
            }
            
            $sql = "DELETE FROM products WHERE product_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $productId);
            
            if($stmt->execute()) {
                $_SESSION['message'] = "Product deleted successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error deleting product: " . $connection->error;
                $_SESSION['message_type'] = "danger";
            }
            
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
    
    $sql = "SELECT * FROM products ORDER BY Product_ID ASC";
    $result = $connection->query($sql);
    $products = [];
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMERCH - Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/product.css">
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
                    <li><a class="dropdown-item" href="../login-page/index.php">Logout</a></li>
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
                
                <button class="add-product-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
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
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Stock</th>
                                <th>Product Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><img src="/assets/images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image"></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['product_price']; ?></td>
                                <td><?php echo $product['stock']; ?></td>
                                <td><?php echo $product['product_type']; ?></td>
                                <td>
                                    <button class="edit-btn btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="<?php echo $product['product_id']; ?>" data-name="<?php echo $product['product_name']; ?>" data-type="<?php echo $product['product_type']; ?>" data-price="<?php echo $product['product_price']; ?>" data-stock="<?php echo $product['stock']; ?>" data-description="<?php echo $product['product_description']; ?>">Update</button>
                                    <button class="delete-btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal" data-id="<?php echo $product['product_id']; ?>">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <input type="text" class="form-control" id="productDescription" name="productDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="productType" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="productType" name="productType" required>
                        </div>
                        <div class="mb-3">
                            <label for="unitPrice" class="form-label">Unit Price</label>
                            <input type="number" class="form-control" id="unitPrice" name="unitPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="productImage" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" id="editProductId" name="productId">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="editProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Product Description</label>
                            <input type="text" class="form-control" id="editProductDescription" name="editProductDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductType" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="editProductType" name="editProductType" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUnitPrice" class="form-label">Unit Price</label>
                            <input type="number" class="form-control" id="editUnitPrice" name="editUnitPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStockCount" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="editStockCount" name="editStockCount" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="editProductImage" name="editProductImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" id="deleteProductId" name="deleteProductId">
                        <p>Are you sure you want to delete this product?</p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function() {
                    this.querySelector('.dropdown-menu').classList.toggle('show');
                });
            });
            
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');
                    const productType = this.getAttribute('data-type');
                    const unitPrice = this.getAttribute('data-price');
                    const stockCount = this.getAttribute('data-stock');
                    const productDescription = this.getAttribute('data-description');

                    document.getElementById('editProductId').value = productId;
                    document.getElementById('editProductName').value = productName;
                    document.getElementById('editProductType').value = productType;
                    document.getElementById('editUnitPrice').value = unitPrice;
                    document.getElementById('editStockCount').value = stockCount;
                    document.getElementById('editProductDescription').value = productDescription;
                });
            });
            
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    document.getElementById('deleteProductId').value = productId;
                });
            });

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