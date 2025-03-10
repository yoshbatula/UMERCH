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
                            Admin   ↓
                        </button>
                        <ul class="dropdown-menu" style="background-color:#BE0002;" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item active" href="../login-page/index.php">Logout</a></li>         
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- <nav class="d-flex flex-column text-center" id="navigation">
        <div class="mt-5" id="admin-logo">
            <img src="/assets/images/profile-icon.png" alt="">
        </div>
    </nav> -->

    <!-- Bootstrap JS and Popper.js for dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>