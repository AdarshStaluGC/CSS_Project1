<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css" /> <!-- Link to the CSS file -->
</head>

<body>
<?php
include('shared/auth.php'); // Include authentication script

$title = 'Add Show'; // Set page title

// Include shared header
include('shared/header.php'); 
?>

<h1>Add a new player</h1> <!-- Page heading -->

<!-- Form for adding a new player -->
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
       // Connect to the database and fetch player positions
       try {
            include('shared/datab.php'); // Include database connection script

            // Set up & run query, store data results
            $sql = "SELECT * FROM role ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $role = $cmd->fetchAll();

            // Loop through list of player positions and create dropdown options
            foreach ($role as $role) {
                echo '<option>' . $role['name'] . '</option>';
            }

            $db = null; // Disconnect from the database
        }
        catch (Exception $err) {
            header('location:error.php'); // Redirect to error page on exception
            exit();
        }
        ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" /> <!-- File input for photo -->
    </fieldset>
    <br> 
    <button class="offset-button">Submit</button> <!-- Submit button -->
</form>
</main>
</body>
</html>