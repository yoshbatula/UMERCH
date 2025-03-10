<?php
session_start();

include '/xampp/htdocs/UMERCH/database/dbconnect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $userInput = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($userInput) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        try {
            $query = "SELECT * FROM users WHERE (user_email = ? OR user_id = ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ss", $userInput, $userInput);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if ($password === $user['user_password']) { 
                    
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_role'] = $user['user_role'] ?? 'user';
                    
                    if (isset($_POST['remember'])) {
                        setcookie("user_login", $user['user_id'], time() + (30 * 24 * 60 * 60), "/");
                    }

                    header("Location: ../main-page/mainpage.php");
                    exit();
                } else {
                    $error_message = "Incorrect password";
                }
            } else {
                $error_message = "User not found";
            }
            $stmt->close();
        } catch (Exception $e) {
            $error_message = "An error occurred. Please try again later.";
            error_log("Login error: " . $e->getMessage());
        }
    }
}

if (isset($_SESSION['user_id'])) {
    header("Location: ../main-page/mainpage.php");
    exit();
}
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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <img src="/assets/images/logo.png" alt="" class="um-logo">
        <div class="login-box">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <h1>LOGIN</h1>
                <div class="login-container">
                    <div class="input_box">
                        <input type="text" class="input-field" placeholder="e.g @umindanao.edu.ph" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
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
                    <?php if (!empty($error_message)): ?>
                    <div class="error-message text-white mt-3">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
            <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>