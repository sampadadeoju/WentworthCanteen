<?php
    include('../conn_db.php');

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    // Adjusting the query to use Australian English context
    $query = "SELECT c_id, c_username, c_firstname, c_lastname FROM customer WHERE
    c_username = '$username' AND c_pwd = '$pwd' AND c_type = 'ADM' LIMIT 0,1";

    $result = $mysqli -> query($query);
    if($result -> num_rows == 1){
        // Customer login
        $row = $result -> fetch_array();
        session_start();
        $_SESSION["aid"] = $row["c_id"];
        $_SESSION["firstname"] = $row["c_firstname"];
        $_SESSION["lastname"] = $row["c_lastname"];
        $_SESSION["utype"] = "ADMIN";

        // Redirect to the admin home page for the Australian canteen
        header("location: admin_home.php");
        exit(1);
    }else{
        // Display an alert in case of wrong credentials
        ?>
        <script>
            alert("You entered the wrong username and/or password. Please try again.");
            history.back();
        </script>
        <?php
    }
?>
