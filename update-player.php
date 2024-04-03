<?php
// Include necessary files and set the title
include('shared/auth.php');
$title = 'Saving player Updates...';
include('shared/header.php');

// Capture form inputs
$playerId = $_POST['playerId'];
$name = $_POST['name'];
$country = $_POST['country'];
$role = $_POST['role'];
$ok = true;

// Validate inputs
if (empty($name) || empty($country) || empty($role)) {
    echo 'All fields are required<br />';
    $ok = false;
}

// Process photo if any
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    $size = $_FILES['photo']['size']; 
    $tmp_name = $_FILES['photo']['tmp_name'];
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    } else {
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }     
} else {
    $finalName = $_POST['currentPhoto'];
}

// Update player information if validation passed
if ($ok == true) {
    try {
        include('shared/datab.php');
        $sql = "UPDATE players SET photo = :photo, name = :name, country = :country, role = :role WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':country', $country, PDO::PARAM_STR, 100);
        $cmd->bindParam(':role', $role, PDO::PARAM_STR, 20);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);
        $cmd->execute();
        $db = null;
        echo 'Player Updated';
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>