<?php
    session_start();
    include('conn_db.php');

    if(isset($_GET["rmv"])){
        // Remove item pressed
        $target_sid = $_GET["s_id"];
        $target_cid = $_SESSION["cid"];
        $target_fid = $_GET["f_id"];

        // Deleting the specific item from the cart
        $cartdelete_query = "DELETE FROM cart WHERE c_id = {$target_cid} AND s_id = {$target_sid} AND f_id = {$target_fid}";
        $cartdelete_result = $mysqli->query($cartdelete_query);

        // Redirect based on the result of the deletion
        if($cartdelete_result){
            header("location: cust_cart.php?rmv_crt=1"); // Successful removal
        } else {
            header("location: cust_cart.php?rmv_crt=0"); // Error in removal
        }
        exit(1);
    }
?>
