<?php
    include('conn_db.php');

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    // Secure the query using prepared statements
    $query = "SELECT c_id, c_username, c_firstname, c_lastname 
              FROM customer 
              WHERE c_username = ? AND c_pwd = ? 
              LIMIT 1";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login
        $row = $result->fetch_array();
        session_start();
        $_SESSION["cid"] = $row["c_id"];
        $_SESSION["firstname"] = $row["c_firstname"];
        $_SESSION["lastname"] = $row["c_lastname"];
        $_SESSION["utype"] = "customer";

        header("location: index.php");
        exit(1);
    } else {
        ?>
        <script>
            alert("Incorrect username or password! Please try again.");
            history.back();
        </script>
        <?php
    }

    $stmt->close();
?>
