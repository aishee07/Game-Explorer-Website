<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start(); 

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

session_start();
$error = ''; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name = trim($_POST['username']);
    $password_input = trim($_POST['psw']);

    // Prepare query to verify user credentials
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $user_name, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password_input === $user['password']) { // Verify password match
        session_regenerate_id(true);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_home.php");
            exit();
        } else {
            header("Location: user_home.php");
            exit();
        }
    } else {
        $error = 'Incorrect username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-form">
    <form action="" method="POST">
      <h1>Login</h1>
      <div>
        <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" width="120" height="120" alt="Avatar" class="avatar">
      </div>
      <br>
      <div>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div>
        <input type="password" id="psw" name="psw" placeholder="Password" required>
      </div>
      <div>
        <button type="submit" class="login-btn">Login</button>
      </div>
      <?php if ($error) { ?>
        <div style="color: red; margin: 10px 0;"><?php echo $error; ?></div>
      <?php } ?>
      <div style="margin: 10px 0;">Or</div>
      <div>
        <a href="signup.php"><button type="button" class="signup-btn">Sign Up Here</button></a>
      </div>
    </form>
  </div>
</body>
</html>
