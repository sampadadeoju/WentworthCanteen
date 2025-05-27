<?php
    // For inserting a new customer into the database
    include('conn_db.php');
    $pwd = $_POST["pwd"];
    $cfpwd = $_POST["cfpwd"];

    if ($pwd != $cfpwd) {
        ?>
        <script>
            alert('Your passwords do not match.\nPlease enter them again.');
            history.back();
        </script>
        <?php
        exit(1);
    } else {
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $type = $_POST["type"];

        if ($gender == "-" || $type == "-") {
            ?>
            <script>
                alert('Please select your gender and role before proceeding.');
                history.back();
            </script>
            <?php
            exit(1);
        }

        // Check for duplicate username
        $query = "SELECT c_username FROM customer WHERE c_username = '$username';";
        $result = $mysqli->query($query);
        if ($result->num_rows >= 1) {
            ?>
            <script>
                alert('This username is already taken. Please choose another one.');
                history.back();
            </script>
            <?php
        }
        $result->free_result();
        
        // Check for duplicate email
        $query = "SELECT c_email FROM customer WHERE c_email = '$email';";
        $result = $mysqli->query($query);
        if ($result->num_rows >= 1) {
            ?>
            <script>
                alert('This email is already registered. Please use another one.');
                history.back();
            </script>
            <?php
        }
        $result->free_result();

        // Insert the new customer into the database
        $query = "INSERT INTO customer (c_username, c_pwd, c_firstname, c_lastname, c_email, c_gender, c_type)
                  VALUES ('$username', '$pwd', '$firstname', '$lastname', '$email', '$gender', '$type');";

        $result = $mysqli->query($query);

        if ($result) {
            header("location: cust_regist_success.php");
        } else {
            header("location: cust_regist_fail.php?err={$mysqli->errno}");
        }
    }
?>
