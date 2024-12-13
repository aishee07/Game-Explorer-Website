<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "astar_games";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch games
$sql = "SELECT * FROM trending_games";
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
