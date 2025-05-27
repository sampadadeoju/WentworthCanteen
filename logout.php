<?php
    session_start();  // Start the session
    session_destroy();  // Destroy the session
    header("location: index.php");  // Redirect to the homepage (index.php)
?>
