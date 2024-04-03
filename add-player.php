<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reg.css" />
</head>

<?php
include('shared/auth.php');

$title = 'Add Show';

//including my shared header in this page 
include('shared/header.php'); ?>

<h1>Add a new player</h1>
<form method="post" action="insert-player.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Player Name: *</label>
        <input name="name" id="name" required />
    </fieldset>
    <fieldset>
        <label for="country">Country: *</label>
        <input name="country" id="country" required />
    </fieldset>
    <fieldset>
        <label for="role">Player Position: *</label>
        <select name="role" id="role" required>
       
       <?php

// connecting to my database using the shared datab.php file
try {
    // connect
    include('shared/datab.php');

    // set up & run query, store data results
    $sql = "SELECT * FROM role ORDER BY name";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $role = $cmd->fetchAll();

    // loop through list of player positions.
    //this part is for the dropdown menu for the player positions
    foreach ($role as $role) {
        echo '<option>' . $role['name'] . '</option>';
    }

    // disconnect
    $db = null;
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
        ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
    </fieldset>
    <br> 
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>