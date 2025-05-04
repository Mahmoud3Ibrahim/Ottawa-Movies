<?php
// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code displays the user's playlist and allows removing movies from it.

require_once 'config.php';

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle removing a movie from the playlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_movie_id'])) {
    $movie_id = $_POST['remove_movie_id'];
    $sql = "DELETE FROM playlists WHERE user_id = ? AND movie_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $movie_id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ottawa Movies - My Playlist</title>
    <link rel="stylesheet" href="../style/playlist.css">
    <script src="../js/playlist.js"></script>
</head>
<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo"><a href="../index.php">Ottawa Movies</a></div>
        <nav>
            <ul class="nav-links">
                <li><a href="../index.php"><img src="../image/home.png" alt="Home Icon" class="nav-icon"> Home</a></li>
                <li><a href="./playlist.php" class="active"><img src="../image/watchlist.png" alt="Watchlist Icon" class="nav-icon"> My Playlist</a></li>
                <li><a href="./search.php"><img src="../image/search.png" alt="Search Icon" class="nav-icon"> Search</a></li>
                <li><a href="./logout.php"><img src="../image/login.png" alt="Logout Icon" class="nav-icon"> Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content with playlist grid -->
    <main>
        <section class="playlist-section">
            <h1>My Playlist</h1>
            <div class="movie-grid">
                <?php
                $sql = "SELECT m.* FROM movies m JOIN playlists p ON m.id = p.movie_id WHERE p.user_id = ? ORDER BY m.id ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$user_id]);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="movie-item">';
                    echo '<a href="./movie_details.php?id=' . $row['id'] . '">';
                    echo '<img src="../image/' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '</a>';
                    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['genre']) . ' <span class="rating">★ ' . htmlspecialchars($row['rating']) . '</span></p>';
                    echo '<form method="POST" style="margin-top: 10px;">';
                    echo '<input type="hidden" name="remove_movie_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="remove-from-playlist-btn">Remove</button>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>Copyright@Mahmoud Sharmarke Moustafa 2025</p>
    </footer>


</body>
</html>