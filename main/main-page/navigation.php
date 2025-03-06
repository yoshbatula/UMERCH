
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMerch Store</title>
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="brand-logo">
                    <a href="#">
                        <img src="/assets/images/logo.png" alt="UMerch Logo">
                    </a>
                </div>

                <ul class="nav-menu">
                    <li class="nav-item"><a href="mainpage.php">HOME</a></li>
                    <li class="nav-item"><a href="wishlist.php">WISHLIST</a></li>
                    <li class="nav-item"><a href="shop.php">SHOP</a></li>
                    <li class="nav-item"><a href="#">ABOUT US</a></li>
                    <li class="nav-item"><a href="#">CONTACT US</a></li>
                </ul>
            </div>

            <div class="nav-actions">
                <button class="icon-btn"><img src="/assets/images/cart-icon.png" alt="Cart"></button>
                <button class="icon-btn"><img src="/assets/images/notif-icon.png" alt="Notifications"></button>
                <button class="icon-btn"><img src="/assets/images/profile-icon.png" alt="Profile"></button>
            </div>

            <button class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('.nav-item a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          navLinks.forEach(nav => nav.classList.remove('active'));
          this.classList.add('active');
        });
      });
    });
        $(document).ready(function() {
            $('.hamburger').click(function() {
                $('.nav-menu').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>