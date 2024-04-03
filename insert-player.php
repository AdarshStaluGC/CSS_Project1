<?php
// Include authentication and set the title
include('shared/auth.php');
$title = 'Adding a new player'; 
include('shared/header.php');

// Check if a photo was uploaded
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    $size = $_FILES['photo']['size']; 
    $tmp_name = $_FILES['photo']['tmp_name'];
    $type = mime_content_type($tmp_name);

    // Check if the uploaded file is a jpg or png
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // Move the uploaded file to the uploads directory
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
}

// Get the form data
$name = $_POST['name'];
echo $name;
$country = $_POST['country'];
$role = $_POST['role'];
$ok = true;

// Validate the form data
if (empty($name)) {
    echo 'Name is required</br>';
    $ok = false;
}
if (empty($country)) {
    echo 'country is required</br>';
    $ok = false;
}
if (empty($role)) {
    echo 'Role is required</br>';
    $ok = false;
}

// If validation passed, insert the data into the database
if ($ok == true) {
    try {
        include('shared/datab.php');
        $sql = "INSERT INTO players (photo, name, country, role) VALUES (:photo, :name, :country, :role)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':country', $country, PDO::PARAM_STR, 20);
        $cmd->bindParam(':role', $role, PDO::PARAM_STR, 100);
        $cmd->execute();
        $db = null;
        echo 'Player Saved';
        $db = null;
        echo 'Player Saved';
    }
    catch (Exception $err) {
        // Redirect to error page if there was an exception
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>