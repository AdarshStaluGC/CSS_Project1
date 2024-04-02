<?php 
$title = 'Edit Player'; //title of the page
include('shared/header.php'); 

$playerId = $_GET['playerId'];

$name = null;
$country = null;
$role = null;

if (is_numeric($playerId)) {
    try {
        include('shared/datab.php');

        $sql = "SELECT * FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $cmd->execute();
        $player = $cmd->fetch();  // use fetch() for 1 record

        $name = $player['name'];
        $country = $player['country'];
        $role = $player['role'];

    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}

?>

<h2>Edit Player Details</h2>
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
            // set up & run query, store data results
            $sql = "SELECT * FROM role ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $role = $cmd->fetchAll();

            // loop through list of services, adding each one to dropdown 1 at a time
            // check each service & select the one that matches the show we're editing
            foreach ($role as $role) {
                if ($role['name'] == $roleName) {
                    echo '<option selected>' . $role['name'] . '</option>';
                }
                else {
                     echo '<option>' . $role['name'] . '</option>';
                }    
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>" />
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>