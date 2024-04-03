<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title> <!-- Dynamic title -->
    <link rel="stylesheet" href="./css/site.css" /> <!-- Link to the CSS file -->
    <script src="./js/scripts.js" defer></script> <!-- Link to the JavaScript file -->
</head>
<body>
<header id="navbar">
    <nav class="navbar-container container">
        <div class="navbar-items">
            <a href="home.php" class="home-link"> <!-- Home link -->
                <div class="navbar-logo"></div>
                Home 
            </a>

            <?php
                // Start session if not already started
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }                    
            ?>

            <li class="navbar-item">
                <a class="navbar-link" href="players.php">Players</a> <!-- Players link -->
            </li>

            <?php
                // Display different navbar items based on whether user is logged in
                if (!empty($_SESSION['username'])) {
                    echo '<li class="navbar-item">
                        <a class="navbar-link" href="add-player.php">Add Player</a>
                    </li>
                    <li class="navbar-item">
                        <a class="navbar-link" href="logout.php">Logout</a>
                    </li>';
                } 
                else {
                    echo '<li class="navbar-item">
                        <a class="navbar-link" href="register.php">Register</a>
                    </li>
                    <li class="navbar-item">
                        <a class="navbar-link" href="login.php">Login</a>
                    </li>';
                }
            ?>
        </div>
        <?php
            // Display username if user is logged in
            if (!empty($_SESSION['username'])) {
                echo '<li class="navbar-item">
                    <a class="navbar-link username" href="#">
                        <img src="img/usericon.png" alt="Profile Icon" class="profile-icon" />
                        ' . $_SESSION['username'] . '
                    </a>
                </li>';
            }
        ?>
    </nav>
</header>
<main> <!-- Start of main content -->