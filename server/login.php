<?php
// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code handles user login for Ottawa Movies, checks credentials, and displays a login form.

require_once './config.php';

// Redirect if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input and check user credentials
    if (!empty($username) && !empty($password)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ottawa Movies - Login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo"><a href="../index.php">Ottawa Movies</a></div>
        <nav>
            <ul class="nav-links">
                <li><a href="../index.php"><img src="../image/home.png" alt="Home Icon" class="nav-icon"> Home</a></li>
                <li><a href="./search.php"><img src="../image/search.png" alt="Search Icon" class="nav-icon"> Search</a></li>
                <li><a href="./login.php" class="active"><img src="../image/regestier.png" alt="Login Icon" class="nav-icon"> Login/Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content with login form -->
    <main>
        <section class="login-section">
            <div class="login-container">
                <h1>Login</h1>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit">Sign In</button>
                </form>
                <p class="register-link">Don't have an account? <a href="./register.php">Register here</a></p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>Copyright@Mahmoud Sharmarke Moustafa 2025</p>
    </footer>

    <script src="../js/login.js"></script>
</body>
</html>