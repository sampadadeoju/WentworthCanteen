<?php
    session_start();
    if($_SESSION["utype"] != "ADMIN"){
        header("location: ../restricted.php");
        exit(1);
    }
    include('../conn_db.php');
    
    // Retrieve order ID from the URL
    $orh_id = $_GET["orh_id"];

    // Delete the order from the database
    $delete_query = "DELETE FROM order_header WHERE orh_id = '{$orh_id}';";
    $delete_result = $mysqli->query($delete_query);

    // Redirect based on success or failure of the deletion
    if($delete_result){
        header("location: admin_order_list.php?del_ord=1");  // Successfully deleted
    } else {
        header("location: admin_order_list.php?del_ord=0");  // Deletion failed
    }
?>
