<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding and viewport for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to the CSS stylesheet -->
    <link rel="stylesheet" href="./css/common.css" /> 
</head>
<body>
   
    <!-- Include the shared header -->
    <?php
     $title = 'Login';  // Define $title before including header.php
    require 'shared/header.php'; 
    ?>

    <!-- Display the login form -->
    <h2>User Login</h2>

    <!-- Check if there was an invalid login attempt -->
    <?php
    if (!empty($_GET['invalid'])) {
        echo '<h4>INVALID LOGIN</h4>';
    }
    ?>

    <h5>Please enter your Username and Password.</h5>

    <!-- Start of the login form -->
    <form method="post" action="validate.php">
        <fieldset>
            <!-- Username input field -->
            <label for="username">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset>
            <!-- Password input field -->
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>

        <!-- Login button -->
        <button class="offset-button">Login</button>
    </form>
</main>
</body>
</html>