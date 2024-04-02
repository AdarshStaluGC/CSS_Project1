<?php

include('shared/auth.php');

//Adding a title 
$title = 'Adding a new player'; 

//Adding my shared header in this page
include('shared/header.php');

// process photo if any
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    echo $finalName . '<br />';

    // in php, file size is bytes (1 kb = 1024 bytes)
    $size = $_FILES['photo']['size']; 
    echo $size . '<br />';

    // temp location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];
    echo $tmp_name . '<br />';

    // file type
    // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
    $type = mime_content_type($tmp_name);
    echo $type . '<br />';

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }

}

//Assigning the input values to variables
$name = $_POST['name'];
echo $name;
$country = $_POST['country'];
$role = $_POST['role'];
$ok = true;

// input validation before save
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
 
//if everything is okay, save to the database
if ($ok == true) {
    
//connecting to the database
    include('shared/datab.php');

//inserting data into sql table
    $sql = "INSERT INTO players (photo, name, country, role) VALUES (:photo, :name, :country, :role)";
// link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

// map each input to a column in the shows table
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':country', $country, PDO::PARAM_STR, 20);
        $cmd->bindParam(':role', $role, PDO::PARAM_STR, 100);
        
// execute the INSERT (which saves to the db)
    $cmd->execute();

// disconnect from the database
     $db = null;

// show msg to user
     echo '   -Player Added to the Team';
 }
 ?>
 </main>
 </body>
 </html>




