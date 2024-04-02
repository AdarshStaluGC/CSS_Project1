<?php
include('shared/auth.php');
$title = 'Saving player Updates...';
include('shared/header.php');

// capture form inputs into vars
$playerId = $_POST['playerId'];  // id value from hidden input on form
$name = $_POST['name'];
$country = $_POST['country'];
$role = $_POST['role'];
$ok = true;

// input validation before save
if (empty($name)) {
    echo 'Name is required<br />';
    $ok = false;
}

if (empty($country)) {
    echo 'Country is required<br />';
    $ok = false;
}

if (empty($role)) {
    echo 'role is required<br />';
    $ok = false;
}

if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/datab.php');

    // set up SQL UPDATE command
    $sql = "UPDATE players SET name = :name, country = :country, role = :role WHERE playerId = :playerId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
    $cmd->bindParam(':country', $country, PDO::PARAM_STR, 100);
    $cmd->bindParam(':role', $role, PDO::PARAM_STR, 20);
    $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);

    // execute the update (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Player Updated';
}
?>
</main>
</body>
</html>
