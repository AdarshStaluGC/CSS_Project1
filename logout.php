<?php
// access current user session
session_start();
session_destroy();
header('location:home.php');
?>