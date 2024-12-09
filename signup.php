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
    $password = $_POST['password']; // No hashing
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <header>
        <a href="index.html" class="home-button"><font color="white">Home</font></a>
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
        <div class="popup active">
            <h3>Registration Successful!</h3>
            <p>You have successfully registered.</p>
            <button onclick="this.parentElement.style.display='none'">Close</button>
        </div>
    <?php endif; ?>
    

</body>
</html>
