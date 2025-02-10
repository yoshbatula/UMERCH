<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMERCH LOGIN</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form action="" method="POST">
                <h1>LOGIN</h1>
                <div class="login-container">
                    <div class="input_box">
                        <input type="text" class="input-field" placeholder="e.g @umindanao.edu.ph" name="email" required>
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" class="input-field" placeholder="Enter your password" name="password" required>
                        <i class="fa-solid fa-lock icon"></i>
                    </div>
                    <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>
                    </div>
                    <div class="input_box">
                        <input class="input-submit" type="submit" value="LOGIN" name="login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>