<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astar_games";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['game_name'])) {
    $game_name = trim($_POST['game_name']);
    try {
        // Delete from both tables based on game name
        $pdo->beginTransaction();
        
        $deleteFromNewGames = $pdo->prepare("DELETE FROM new_games WHERE g_name = :game_name");
        $deleteFromTrendingGames = $pdo->prepare("DELETE FROM trending_games WHERE name = :game_name");
        
        $deleteFromNewGames->bindParam(':game_name', $game_name, PDO::PARAM_STR);
        $deleteFromTrendingGames->bindParam(':game_name', $game_name, PDO::PARAM_STR);
        
        $deleteFromNewGames->execute();
        $deleteFromTrendingGames->execute();
        
        $pdo->commit();
        $message = "Game deleted successfully!";
    } catch (PDOException $e) {
        $pdo->rollBack();
        $message = "Error deleting game: " . $e->getMessage();
    }
}

// Fetch all games to display
try {
    $gamesQuery = $pdo->query("
        SELECT g_name AS game_name FROM new_games
        UNION
        SELECT name AS game_name FROM trending_games
    ");
    $games = $gamesQuery->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching games: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View and Delete Games</title>
    <link rel="stylesheet" href="del_games.css">
</head>
<body>
    <header>
        <a href="admin_home.php" class="home-button">Home</a>
    </header>

    <div class="game-list">
        <h2>Game List</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <?php if (count($games) > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Game Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                            <tr>
                                <td><?= htmlspecialchars($game['game_name']) ?></td>
                                <td>
                                    <form action="del_games.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="game_name" value="<?= htmlspecialchars($game['game_name']) ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No games found in the database.</p>
        <?php endif; ?>
    </div>
</body>
</html>
