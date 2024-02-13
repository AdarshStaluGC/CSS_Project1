<?php
$title = 'Add Show';
include('shared/header.php'); ?>

<h1>Add A New Player</h1>
<form method="post" action="insert-player.php">
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
            // connect
            include('shared/datab.php');

            // set up & run query, store data results
            $sql = "SELECT * FROM role ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $role = $cmd->fetchAll();

            // loop through list of player positions.
            foreach ($role as $role) {
                echo '<option>' . $role['name'] . '</option>';
            }
            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <br>
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>


