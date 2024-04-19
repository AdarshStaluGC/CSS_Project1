<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css" /> 
</head>
<body>
<?php 
    include('shared/header.php'); 
    $title = 'Player List'; 
    include('shared/datab.php');

    // Query to fetch all players
    $sql = "SELECT * FROM players";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $players= $cmd->fetchAll();

    // Display the player list
    echo '<h1 class="centered-title">Player List</h1>';
    echo '<table><thead><th>Photo</th><th>Name</th><th>Country</th><th>Role</th>';
    if (!empty($_SESSION['username'])) {
        echo '<th>Actions</th>';
    }
    echo '</thead>';

    // Loop through each player and display their details
    foreach ($players as $players) {
        echo '<tr><td>';
        if ($players['photo'] != null) {
            echo '<img src="img/uploads/' . $players['photo'] . '" class="thumbnail" />';
        }
        echo '</td><td>' . $players['name'] . '</td><td>' . $players['country'] . '</td><td>' . $players['role'] . '</td>';
        if (!empty($_SESSION['username'])) {
            echo '<td class=""><a href="edit-player.php?playerId=' . $players['playerId'] . '">Edit</a>&nbsp;<a href="delete-player.php?playerId=' .$players['playerId'] . '" onclick="return confirmDelete();">Delete</a></td>';
        }
        echo '</tr>';
    }

    // End of player list
    echo '</table>';

    // Close database connection
    $db = null;
?>
</main>
</body>
</html>