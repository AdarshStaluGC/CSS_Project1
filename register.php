<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding and viewport for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to the CSS stylesheet -->
    <link rel="stylesheet" href="./css/common.css" /> 
    <link rel="stylesheet" href="./css/register.css" /> 
</head>
<body>
    <?php
    $title = 'Register';

    // Include the shared header
    require('shared/header.php');
    ?>

    <div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <h1>User Registration</h1>
    </div>
    <div class="flip-card-back">
      <h1>Please Provide User Info</h1>
    </div>
  </div>
</div>

    <!-- Display the registration form -->
    <h5>Passwords must be a minimum of 8 characters,
    including 1 digit, 1 upper-case letter, and 1 lower-case letter.
    </h5>

    <?php
    // Check if there was a duplicate user error
    if (!empty($_GET['duplicate'])) {
        echo '<h4 class="err">User already exists</h4>';
    }
    ?>

    <!-- Start of the registration form -->
    <form method="post" action="save-registration.php">
        <fieldset>
            <!-- Username input field -->
            <label for="username">Username: *</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset>
            <!-- Password input field -->
            <label for="password">Password: *</label>
            <input type="password" name="password" id="password" required
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <img id="showHide" src="img/show.png" alt="Show/Hide" onclick="togglePassword();" />
        </fieldset>
        <fieldset>
            <!-- Confirm password input field -->
            <label for="confirm">Confirm Password: *</label>
            <input type="password" name="confirm" id="confirm" required 
            onkeyup="return comparePasswords();"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <span id="pwErr"></span>
        </fieldset>

        <!-- Register button -->
        <button class="offset-button" onclick="return comparePasswords();">Register</button>
    </form>
</main>
</body>
</html>