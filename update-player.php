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

// process photo if any
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    //echo $finalName . '<br />';

    // in php, file size is bytes (1 kb = 1024 bytes)
    $size = $_FILES['photo']['size']; 
    //echo $size . '<br />';

    // temp location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];
    //echo $tmp_name . '<br />';

    // file type
    // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
    $type = mime_content_type($tmp_name);
    //echo $type . '<br />';

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }     
}
else {
    // no new photo uploaded, keep current photo set in hidden input on form
    // this prevents an existing photo being set to null and removed
    $finalName = $_POST['currentPhoto'];
}


if ($ok == true) {

    try {
        // connect to db using the PDO (PHP Data Objects Library)
        include('shared/db.php');

    // set up SQL UPDATE command
    $sql = "UPDATE players SET photo = :photo, name = :name, country = :country, role = :role WHERE playerId = :playerId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
    $cmd->bindParam(':country', $country, PDO::PARAM_STR, 100);
    $cmd->bindParam(':role', $role, PDO::PARAM_STR, 20);
    $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
    $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

    // execute the update (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Player Updated';
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
</main>
</body>
</html>
