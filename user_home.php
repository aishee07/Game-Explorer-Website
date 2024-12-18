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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome User</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Swiper/swiper-bundle.min.css">
</head>

<body>
  <!-- Custom scroll bar -->
  <div class="progress">
    <div class="progress-bar" id="scroll-bar"></div>
  </div>

  <!-- Header Section -->
  <header>
    <div class="nav container">
      <a href="index.php" class="logo">Astar<span>Games</span></a>
      <div class="nav-icons">
        <div class="menu-icon">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
      </div>
      <div class="menu">
        <img src="images/menu.png" alt="">
        <div class="navbar">
          <li><a href="login.php">Logout</a></li>
          <li><a href="user_category.html">Categories</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        </div>
      </div>
    </div>
  </header>

  <!-- Home Section -->
  <section class="home container" id="home">
    <img src="images/wukong.jpeg" alt="">
    <div class="home-text">
      <a href="https://store.steampowered.com/app/2358720/Black_Myth_Wukong/" class="btn">Available Now</a>
    </div>
  </section>

  <!-- Trending Section -->
  <section class="trending container" id="trending">
    <div class="heading">
      <i class="bx bxs-flame"></i>
      <h2>Trending Games</h2>
    </div>
    <div class="trending-content swiper">
      <div class="swiper-wrapper"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>

  <!-- New Games Section -->
  <section class="new container" id="new">
    <div class="heading">
      <i class="bx bxs-game"></i>
      <h2>All Games</h2>
    </div>
    <div class="new-content swiper">
      <div class="swiper-wrapper"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>

  <!-- Load JS scripts -->
  <script src="Swiper/swiper-bundle.min.js"></script>
  <script src="user_trending.js"></script>
  <script>
    const CURRENT_USER_ID = <?php echo json_encode($_SESSION['user_id'] ?? null); ?>;
  </script>
  <script src="user_new.js"></script>
</body>
</html>
