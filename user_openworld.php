<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open-World Games</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="openworld.css">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet"> <!-- Add Boxicons for star icons -->
    <style>
        .stars {
            font-size: 20px;
            color: #FFD700;
        }
    </style>
</head>

<body>

    <header>
        <a href="user_home.php" class="home-button"><font color="white">Home</font></a>
        <a href="" class="home-button"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></a>
        <a href="user_category.html" class="home-button"><font color="white">Categories</font></a>
    </header>

    <h1>Open-World Games</h1>
    <hr>

    <div class="container">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "astar_games";

        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch racing games
            $stmt = $pdo->prepare("SELECT g_name, g_rating, g_description, g_image_url, g_download_url FROM new_games WHERE g_category = :category");
            $stmt->execute(['category' => 'Open-World']);
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if games are available
            if ($games) {
                foreach ($games as $game) {
                    // Pass the rating to JavaScript function
                    echo "
                    <div class='card'>
                        <div class='inner'>
                            <div class='front'>
                                <img src='{$game['g_image_url']}' alt='{$game['g_name']}'>
                                <div class='name'>{$game['g_name']}</div>
                                <div class='stars' id='stars_{$game['g_name']}'></div>
                            </div>
                            <div class='back'>
                               <div class='about'>{$game['g_description']}</div>
                               <a href='{$game['g_download_url']}' class='box-btn'>
                                  <i class='bx bx-download'></i>
                               </a>
                            </div>

                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p>No racing games available at the moment.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Error fetching racing games: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>

    <script>
        // JavaScript function to generate stars
        function generateStars(rating) {
            const normalizedRating = rating / 2; // Convert a 10-point scale into 5-star equivalents
            let stars = "";

            for (let i = 0; i < 5; i++) {
                if (i < Math.floor(normalizedRating)) {
                    stars += "<i class='bx bxs-star'></i>"; // Full stars
                } else if (i < normalizedRating) {
                    stars += "<i class='bx bxs-star-half'></i>"; // Half stars
                } else {
                    stars += "<i class='bx bx-star'></i>"; // Empty stars
                }
            }

            return stars;
        }

        // Assign the stars dynamically to each game's rating
        <?php
        foreach ($games as $game) {
            echo "document.getElementById('stars_{$game['g_name']}').innerHTML = generateStars({$game['g_rating']});";
        }
        ?>
    </script>
</body>

</html>
