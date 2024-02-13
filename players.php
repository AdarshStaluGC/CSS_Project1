<?php 
    //including the shared header
    include('shared/header.php'); 
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
    echo '<h1>Player List</h1>';
    echo '<table style="border-spacing: 10px;"><thead><th>Name</th><th>Country</th><th>Role</th></thead>';

    // looping through the data result from the query, and displaying each show name
    foreach ($players as $players) {
        echo '<tr>
        <td style="padding: 0 10px;">' . $players['name'] . '</td>
        <td style="padding: 0 10px;">' . $players['country'] . '</td>
        <td style="padding: 0 10px;">' . $players['role'] . '</td>
        </tr>';
          }

    // end of the list
    echo '</table>';

    //disconnect
    $db = null;
?>
</body>
</html>