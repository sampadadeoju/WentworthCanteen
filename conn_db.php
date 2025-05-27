<?php
    $mysqli = new mysqli("localhost", "root", "", "wentworthcanteen");

    if ($mysqli->connect_errno) {
        header("location: db_error.php");
        exit(1);
    }

    define('SITE_ROOT', realpath(dirname(__FILE__)));
    
    // Update timezone to Sydney
    date_default_timezone_set('Australia/Sydney');
?>
