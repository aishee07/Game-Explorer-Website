<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astar_games";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$registration_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email_id = $_POST['email_id'];
    $role = 'user';

    try {
        $sql = "INSERT INTO users (username, password, name, email_id, role) VALUES (:username, :password, :name, :email_id, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email_id', $email_id);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $registration_successful = true;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    
    <header>
        <a href="index.html" class="home-button"><font color="white">Home</font></a>
        <a href="" class=""><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></a>
        <a href="login.php" class="home-button"><font color="white">Login</font></a>
    </header>

    <div class="registration-form">
        <h2>Register New User</h2>
        <form action="signup.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="email_id">Email ID:</label>
            <input type="email" name="email_id" id="email_id" required><br>

            <button type="submit">Register</button>
        </form>
    </div>

    <?php if ($registration_successful): ?>
        <div class="popup-wrapper" id="popup">
            <div class="popup">
                <h3>🎉 Registration Successful! 🎉</h3>
                <p>You have successfully registered.</p>
                <button onclick="closePopup()">Close</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        function closePopup() {
            document.getElementById('popup').style.display = "none";
        }

        window.onload = function() {
            const popup = document.getElementById('popup');
            if (popup) {
                setTimeout(() => {
                    popup.style.display = "flex";
                    popup.classList.add('show');
                }, 100);
            }
        }
    </script>
</body>
</html>
