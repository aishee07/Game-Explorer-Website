<?php
$servername = "localhost";
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "astar_games";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch new games
$sql = "SELECT * FROM new_games";
$result = $conn->query($sql);

$games = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($games);

$conn->close();
?>
