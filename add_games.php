<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit(); 
}


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}
?>

<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "astar_games"; 

// Establish the PDO connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$game_submission_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['game_name'], $_POST['game_category'], $_POST['game_description'], $_POST['game_rating'], $_POST['game_image_url'], $_POST['game_download_url'])) {
        // Extract the form data
        $game_name = $_POST['game_name'];
        $game_category = $_POST['game_category'];
        $game_description = $_POST['game_description'];
        $game_rating = floatval($_POST['game_rating']);
        $game_image_url = $_POST['game_image_url'];
        $game_download_url = $_POST['game_download_url'];

        try {
            // Insert game into new_games table
            $sql_new_game = "INSERT INTO new_games (g_name, g_category, g_description, g_rating, g_image_url, g_download_url) VALUES (:name, :category, :description, :rating, :image_url, :download_url)";
            $stmt_new_game = $pdo->prepare($sql_new_game);
            $stmt_new_game->bindParam(':name', $game_name);
            $stmt_new_game->bindParam(':category', $game_category);
            $stmt_new_game->bindParam(':description', $game_description);
            $stmt_new_game->bindParam(':rating', $game_rating);
            $stmt_new_game->bindParam(':image_url', $game_image_url);
            $stmt_new_game->bindParam(':download_url', $game_download_url);

            if ($stmt_new_game->execute()) {
                $game_submission_successful = true;

                // Check if rating is greater than 7
                if ($game_rating > 7) {
                    // Insert into trending_games as well
                    $sql_trending_game = "INSERT INTO trending_games (name, category, description, rating, image_url, download_url) VALUES (:name, :category, :description, :rating, :image_url, :download_url)";
                    $stmt_trending_game = $pdo->prepare($sql_trending_game);
                    $stmt_trending_game->bindParam(':name', $game_name);
                    $stmt_trending_game->bindParam(':category', $game_category);
                    $stmt_trending_game->bindParam(':description', $game_description);
                    $stmt_trending_game->bindParam(':rating', $game_rating);
                    $stmt_trending_game->bindParam(':image_url', $game_image_url);
                    $stmt_trending_game->bindParam(':download_url', $game_download_url);

                    $stmt_trending_game->execute();
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    $pdo = null;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Submission</title>
    <link rel="stylesheet" href="add_games.css">
</head>
<body>
    
    <header>
        <a href="admin_home.php" class="home-button"><font color="white">Home</font></a>
        <a href="" class=""><font color="">&nbsp;&nbsp;&nbsp;&nbsp;</font></a>
        <a href="del_games.php" class="home-button"><font color="white">Delete Games</font></a>
    </header>

    <div class="game-submission-form">
        <h2>Submit New Game</h2>
        <form action="add_games.php" method="POST">
            <label for="game_name">Game Name:</label>
            <input type="text" name="game_name" id="game_name" required><br>

            <label for="game_category">Category:</label>
            <input type="text" name="game_category" id="game_category" required><br>

            <label for="game_description">Description:</label>
            <textarea name="game_description" id="game_description" required></textarea><br>

            <label for="game_rating">Rating:</label>
            <input type="number" step="0.1" name="game_rating" id="game_rating" required><br>

            <label for="game_image_url">Image URL:</label>
            <input type="text" name="game_image_url" id="game_image_url" required><br>

            <label for="game_download_url">Download URL:</label>
            <input type="text" name="game_download_url" id="game_download_url" required><br>

            <button type="submit">Submit Game</button>
        </form>
    </div>

    <?php if ($game_submission_successful): ?>
        <div class="popup active">
            <h3>Game Submission Successful!</h3>
            <p>The game has been added to the system.</p>
            <button onclick="this.parentElement.style.display='none'">Close</button>
        </div>
    <?php endif; ?>
    
</body>
</html>
