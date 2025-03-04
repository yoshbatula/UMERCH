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
<nav class="navbar navbar-expand-lg navbar-custom" style="background-color: #BE0002;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/assets/images/logo.png" alt="UMERCH Logo" height="40">
        </a>

        <form class="d-flex ms-auto">
            <input class="form-control me-2 search-bar" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light" type="submit">🔍</button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item text-white">
                    <a class="nav-link" href="main-page/home.php">HOME</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link" href="main-page/shop.php">SHOP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main-page/about.php">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main-page/contact.php">CONTACT US</a>
                </li>
            </ul>
        </div>

        <div class="navbar-icons d-flex">
            <a href="#"><i class="bi bi-cart"></i></a>
            <a href="#"><i class="bi bi-bell"></i></a>
            <a href="#"><i class="bi bi-person-circle"></i></a>
        </div>
    </div>
</nav>
<!-- HEADER IMAGE -->
<div class="d-flex">
    <div class="label-check-form text-center">
        <img src="/assets/images/headerimg.png" alt="">
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
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card custom-card-height" style="width: 17rem;">
                    <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                    <div class="card-body">
                        <h5 class="card-title">UM CCE ESPORTS</h5>
                        <h5 class="card-title">JERSEY</h5>
                        <small class="card-text">Men</small>
                        <div class="d-flex flex-row">
                            <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                            <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card custom-card-height" style="width: 17rem;">
                    <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                    <div class="card-body">
                        <h5 class="card-title">UM CCE ESPORTS</h5>
                        <h5 class="card-title">JERSEY</h5>
                        <small class="card-text">Men</small>
                        <div class="d-flex flex-row">
                            <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                            <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card custom-card-height" style="width: 17rem;">
                    <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                    <div class="card-body">
                        <h5 class="card-title">UM CCE ESPORTS</h5>
                        <h5 class="card-title">JERSEY</h5>
                        <small class="card-text">Men</small>
                        <div class="d-flex flex-row">
                            <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                            <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card custom-card-height" style="width: 17rem;">
                    <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                    <div class="card-body">
                        <h5 class="card-title">UM CCE ESPORTS</h5>
                        <h5 class="card-title">JERSEY</h5>
                        <small class="card-text">Men</small>
                        <div class="d-flex flex-row">
                            <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                            <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <nav class="container" aria-label="Page navigation example">
        <hr>
        <ul class="mt-4 pagination justify-content-center">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</body>
</html>