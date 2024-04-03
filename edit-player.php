<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reg.css" />
</head>

<?php 
// Include authentication script
include('shared/auth.php');

// Set the title of the page
$title = 'Edit Player';

// Include shared header
include('shared/header.php'); 

// Get player ID from the URL
$playerId = $_GET['playerId'];

// Initialize player details
$name = null;
$country = null;
$role = null;

// If player ID is numeric, fetch player details
if (is_numeric($playerId)) {
    try {
        // Include database connection script
        include('shared/datab.php');

        // Prepare SQL query to fetch player details
        $sql = "SELECT * FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $cmd->execute();
        $player = $cmd->fetch();  // use fetch() for 1 record

        // Assign player details to variables
        $name = $player['name'];
        $country = $player['country'];
        $role = $player['role'];
        $photo = $player['photo'];  // fill var w/show photo name if there is one
    }
    catch (Exception $err) {
        // Redirect to error page on exception
        header('location:error.php');
        exit();
    }
}
?>

<h2>Edit Player Details</h2>

<!-- Form for editing player details -->
<form method="post" action="update-player.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name: *</label>
        <input name="name" id="name" required value="<?php echo $name; ?>" />
    </fieldset>

    <fieldset>
        <label for="country">Country: *</label>
        <input name="country" id="country" required value="<?php echo $country; ?>" />
    </fieldset>

    <fieldset>
        <label for="role">Role: *</label>
        <select name="role" id="role" required>
            <?php
            // Prepare and execute SQL query to fetch roles
            $sql = "SELECT * FROM role ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $role = $cmd->fetchAll();

            // Loop through roles and add them to the dropdown
            foreach ($role as $role) {
                if ($role['name'] == $roleName) {
                    echo '<option selected>' . $role['name'] . '</option>';
                }
                else {
                     echo '<option>' . $role['name'] . '</option>';
                }    
            }

            // Disconnect from the database
            $db = null;
            ?>
        </select>
    </fieldset>

    <!-- Hidden input to hold player ID -->
    <input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>" />
    
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
        <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
        <?php
        // If there's a photo, display it
        if ($photo != null) {
            echo '<img src="img/uploads/' . $photo . '" alt="Show Photo" />';
        }
        ?>
    </fieldset>

    <!-- Submit button -->
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>