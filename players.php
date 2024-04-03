<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/ply.css" />
</head>

<?php 


//This file is for showing the list of players in the database

//including the shared header
    include('shared/header.php'); 
// title of this page 
    $title = 'Player List'; 
    
//including the shared Database
    include('shared/datab.php');

//set up query to fetch show data
    $sql = "SELECT * FROM players";
    $cmd = $db->prepare($sql);

// running query and storing results 
    $cmd->execute();
    $players= $cmd->fetchAll();

//Showing the Language list
    echo '<h1 class="centered-title">Player List</h1>';
    echo '<table><thead><th>Photo</th><th>Name</th><th>Country</th><th>Role</th>';
    if (!empty($_SESSION['username'])) {
        echo '<th>Actions</th>';
    }
    echo '</thead>';
// looping through the data result from the query, and displaying each show name
    foreach ($players as $players) {
        echo '<tr>

        <td>';
        if ($players['photo'] != null) {
            echo '<img src="img/uploads/' . $players['photo'] . '" class="thumbnail" />';
        }
        echo '</td>

        <td>' . $players['name'] . '</td>
        <td>' . $players['country'] . '</td>
        <td>' . $players['role'] . '</td>';
        if (!empty($_SESSION['username'])) {
            echo '<td class="">
                <a href="edit-player.php?playerId=' . $players['playerId'] . '">
                    Edit
                </a>&nbsp;
                <a href="delete-player.php?playerId=' .$players['playerId'] . '" onclick="return confirmDelete();">
                    Delete
                </a>
            </td>';
        }
        echo '</tr>';
}

// end of the list
    echo '</table>';

//disconnect
    $db = null;
?>
</main>
</body>
</html>