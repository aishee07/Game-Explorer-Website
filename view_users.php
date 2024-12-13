<?php
session_start();

// Redirect non-admin users to login page
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit();
}

// Logout functionality
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Database connection
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userid = trim($_POST['user_id']);
    try {
        $pdo->beginTransaction();

        // Delete user by user_id
        $deleteFromUsers = $pdo->prepare("DELETE FROM users WHERE user_id = :userid");
        $deleteFromUsers->bindParam(':userid', $userid, PDO::PARAM_INT);

        $deleteFromUsers->execute();

        $pdo->commit();
        $message = "User deleted successfully!";
    } catch (PDOException $e) {
        $pdo->rollBack();
        $message = "Error deleting user: " . $e->getMessage();
    }
}

// Fetch all users to display
try {
    $userQuery = $pdo->query("
        SELECT user_id, username, name, email_id 
        FROM users 
        WHERE role = 'user'
    ");
    $users = $userQuery->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View and Delete Users</title>
    <link rel="stylesheet" href="view_users.css">
</head>
<body>
    <header>
        <a href="admin_home.php" class="home-button">Home</a>
    </header>

    <div class="user-list">
        <h2>User List</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <?php if (count($users) > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['user_id']) ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['email_id']) ?></td>
                                <td>
                                    <form action="view_users.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No users found in the database.</p>
        <?php endif; ?>
    </div>
</body>
</html>
