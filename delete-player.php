<?php
include('shared/auth.php');

// read the showId from the url parameter using $_GET   
$playerId = $_GET['playerId'];

if (is_numeric($playerId)) {
    try {
        // connect to db
        include('shared/datab.php');

        // prepare SQL DELETE
        $sql = "DELETE FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);

        // execute the delete
        $cmd->execute();

        // disconnect
        $db = null;

        // show a message (temporarily)
        echo 'player Deleted';

        
        header('location:players.php');
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>