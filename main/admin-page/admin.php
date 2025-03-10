<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE</title>
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/admin.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="d-flex flex-row" style="background-color: #BE0002;">
        <nav class="navbar w-100">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <img src="/assets/images/logo.png" alt="">
                <div class="ml-auto text-white d-flex align-items-center" style="margin-right: 100px;">
                    <img src="/assets/images/profile-icon.png" width="30">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        ↓
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item text-center text-white" href="../login-page/index.php">Logout</a></li>         
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <section class="admin">
        <div class="container">
            <div class="col-md-3 mx-auto text-center" style="transform: translateY(40px);">
                <img src="/assets/images/profile-icon.png" alt="">
                <div class="mt-2 text-white" style="transform: translateX(-20px);">
                    <h4>Admin</h4>
                </div>
                <div class="admin-link">
                    <div class="d-flex flex-row mt-4 text-white align-items-center" style="transform: translateX(-40px);">
                        <i class="fa-solid fa-gauge-simple-high" style="font-size: 2rem;"></i>
                        <a class="ms-2 admin-link" href="admin.php" style="text-decoration: none; color: white;">Dashboard</a>
                    </div>
                    <div class="d-flex flex-row mt-4 text-white align-items-center" style="transform: translateX(-40px);">
                        <i class="fa-solid fa-box" style="font-size: 2rem;"></i>
                        <a class="ms-2 admin-link" href="product.php" style="text-decoration: none; color: white;">Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="d-flex flex-column text-center" style="transform: translateY(-700px); margin-right: 820px;">
                <h4>Dashboard</h4>
                <p style="transform: translateX(117px);">Welcome back Admin, everything looks great.</p>
            </div>
            <div class="d-flex flex-row justify-content-center" style="transform: translateY(-700px);">
                <div class="col-md-3 mx-2 text-center" style="background-color: #FFB600; border-radius: 10px;">
                    <div class="d-flex flex-row justify-content-between align-items-center" style="background-color: #FFB600; border-radius: 3px;">
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>Products</h4>
                            <p style="transform: translateX(20px);">Total Products</p>
                        </div>
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>10</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-2 text-center" style="background-color: #FFB600; border-radius: 10px;">
                    <div class="d-flex flex-row justify-content-between align-items-center" style="background-color: #FFB600; border-radius: 3px;">
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>Orders</h4>
                            <p style="transform: translateX(20px);">Total Orders</p>
                        </div>
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>10</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-2 text-center" style="background-color: #FFB600; border-radius: 10px;">
                    <div class="d-flex flex-row justify-content-between align-items-center" style="background-color: #FFB600; border-radius: 3px;">
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>Users</h4>
                            <p style="transform: translateX(20px);">Total Users</p>
                        </div>
                        <div class="d-flex flex-column text-white" style="transform: translateY(20px);">
                            <h4>10</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column" style="transform: translateY(-670px); margin-left: 170px;">
                <h4>Recent Orders</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ORDER ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Type of Products</th>
                        <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>