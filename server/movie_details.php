<?php
// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code displays details of a specific movie based on its ID from the database.

require_once 'config.php';

// Check if movie ID is provided, redirect if not
if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$movie_id = $_GET['id'];

// Fetch movie details from database
$sql = "SELECT * FROM movies WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$movie_id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    header("Location: ../index.php");
    exit();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ottawa Movies - <?php echo htmlspecialchars($movie['name']); ?></title>
    <link rel="stylesheet" href="../style/movie_details.css">
</head>
<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo"><a href="../index.php">Ottawa Movies</a></div>
        <nav>
            <ul class="nav-links">
                <li><a href="../index.php"><img src="../image/home.png" alt="Home Icon" class="nav-icon"> Home</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="./playlist.php"><img src="../image/watchlist.png" alt="Watchlist Icon" class="nav-icon"> My Playlist</a></li>
                <?php endif; ?>
                <li><a href="./search.php"><img src="../image/search.png" alt="Search Icon" class="nav-icon"> Search</a></li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="./logout.php"><img src="../image/login.png" alt="Logout Icon" class="nav-icon"> Logout</a>
                    <?php else: ?>
                        <a href="./login.php"><img src="../image/regestier.png" alt="Login Icon" class="nav-icon"> Login/Register</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main content with movie details -->
    <main>
        <section class="movie-details">
            <h1><?php echo htmlspecialchars($movie['name']); ?> (<?php echo htmlspecialchars($movie['year']); ?>)</h1>
            <div class="movie-content">
                <div class="movie-poster">
                    <img src="../image/<?php echo htmlspecialchars($movie['image_path']); ?>" alt="<?php echo htmlspecialchars($movie['name']); ?>">
                </div>
                <div class="movie-info">
                    <p><strong>Rank:</strong> <?php echo htmlspecialchars($movie['rank']); ?></p>
                    <p><strong>Rating:</strong> ★ <?php echo htmlspecialchars($movie['rating']); ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
                    <p><strong>Certificate:</strong> <?php echo htmlspecialchars($movie['certificate']); ?></p>
                    <p><strong>Runtime:</strong> <?php echo htmlspecialchars($movie['run_time']); ?></p>
                    <p><strong>Tagline:</strong> <?php echo htmlspecialchars($movie['tagline']); ?></p>
                    <p><strong>Budget:</strong> $<?php echo number_format($movie['budget']); ?></p>
                    <p><strong>Box Office:</strong> $<?php echo number_format($movie['box_office']); ?></p>
                    <p><strong>Casts:</strong> <?php echo htmlspecialchars($movie['casts']); ?></p>
                    <p><strong>Directors:</strong> <?php echo htmlspecialchars($movie['directors']); ?></p>
                    <p><strong>Writers:</strong> <?php echo htmlspecialchars($movie['writers']); ?></p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>Copyright@Mahmoud Sharmarke Moustafa 2025</p>
    </footer>

    <script src="../js/movie_details.js"></script>
</body>
</html>