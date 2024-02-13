<?php
$title = 'Adding a new player'; 
include('shared/header.php');

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

if ($ok == true) {
    //connecting to the database
    include('shared/datab.php');

    $sql = "INSERT INTO players (name, country, role) VALUES (:name, :country, :role)";
    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

        // map each input to a column in the shows table
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':country', $country, PDO::PARAM_STR, 20);
        $cmd->bindParam(':role', $role, PDO::PARAM_STR, 100);

        // execute the INSERT (which saves to the db)
    $cmd->execute();

     // disconnect
     $db = null;

     // show msg to user
     echo 'Player Added';
 }
 ?>
 </main>
 </body>
 </html>




