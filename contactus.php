<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("location: login.php");
    exit(); 
}


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contactus.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Contact Us</title>
</head>


<body>
    <header>
        <a href="user_home.php" class="home-button"><font color="white">Home</font></a>
    </header>
    <h1>Explore Gaming Together!</h1>
    <p>
    Have questions, feedback, or suggestions for our game catalog? <br><br>
    We’re here to help! Whether you’re a developer wanting to feature your game or a gamer looking for assistance, we’d love to hear from you.
    </p>
    <br>
    <p>
        We are&nbsp;
        <a href="index.html" target="_blank" class="logo">Astar<span>Games</span></a>
    </p>

    <div class="social-media">
        <p>Follow us on social media to never miss a gaming update:</p>
        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://www.instagram.com" target="_blank" aria-label="Instagram"> 
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </div>
    </div>

    <p>
        📧 Email Us : <i>astargames@gmail.com</i> <br><br>
        Or fill out the form below, and we’ll get back to you ASAP:
    </p>

    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSesMsfTh-r7WL8T-_EiJ_PPBAIiIfKLMYhrgnizeIoPGvPHwA/viewform?embedded=true" width="340" height="550" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe> 
    
</body>

</html>