<?php
    session_start();
    if($_SESSION["utype"] != "ADMIN"){
        header("location: ../restricted.php");
        exit(1);
    }

    include('../conn_db.php');
    
    // Get the shop ID to be deleted from the query string
    $s_id = $_GET["s_id"];

    // Perform the deletion query
    $delete_query = "DELETE FROM shop WHERE s_id = '{$s_id}';";
    $delete_result = $mysqli->query($delete_query);

    if($delete_result){
        // Redirect to the shop list page with a success message
        header("location: admin_shop_list.php?del_shp=1");
    } else {
        // Redirect to the shop list page with a failure message
        header("location: admin_shop_list.php?del_shp=0");
    }
?>
