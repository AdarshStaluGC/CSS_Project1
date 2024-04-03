<?php
// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];

try {
    // Connect to database
    include('shared/datab.php');
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // Check if user exists
    if (empty($user)) {
        $db = null;
        header('location:login.php?invalid=true');
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
    } else {
        // Start session and store username
        session_start();
        $_SESSION['username'] = $username;
        $db = null;
        header('location:players.php');
    }
} catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>