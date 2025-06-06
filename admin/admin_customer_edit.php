<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        if(isset($_POST["upd_confirm"])){
            $c_id = $_POST["c_id"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $type = $_POST["type"];

            $query = "UPDATE customer SET c_firstname = '{$firstname}', c_lastname = '{$lastname}', c_email = '{$email}', c_gender = '{$gender}', c_type = '{$type}' WHERE c_id = {$c_id}";
            $result = $mysqli -> query($query);
            if($result){
                header("location: admin_customer_list.php?up_prf=1");
            }else{
                header("location: admin_customer_list.php?up_prf=0");
            }
            exit(1);
        }
        include('../head.php');
    ?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Update Profile | Wentworth Canteen</title> <!-- Changed title for Australian context -->
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <div class="container form-signin mt-auto w-50">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <?php 
            //Select customer record from database
            $c_id = $_GET["c_id"];
            $query = "SELECT c_firstname,c_lastname,c_email,c_gender,c_type FROM customer WHERE c_id = {$c_id} LIMIT 0,1";
            $result = $mysqli ->query($query);
            $row = $result -> fetch_array();
        ?>
        <form method="POST" action="admin_customer_edit.php" class="form-floating">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-pencil-square me-2"></i>Update Profile</h2> <!-- Updated heading -->
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname"
                value="<?php echo $row["c_firstname"];?>" required>
                <label for="firstname">First Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $row["c_lastname"];?>" name="lastname" required>
                <label for="lastname">Last Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $row["c_email"];?>" required>
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating">
                <select class="form-select mb-2" id="gender" name="gender">
                    <option value="M" <?php if($row["c_gender"]=="M"){echo "selected";}?>>Male</option>
                    <option value="F" <?php if($row["c_gender"]=="F"){echo "selected";}?>>Female</option>
                </select>
                <label for="gender">Your Gender</label>
            </div>
            <div class="form-floating">
                <select class="form-select mb-2" id="type" name="type">
                    <option value="STD" <?php if($row["c_type"]=="STD"){echo "selected";}?>>Student</option> <!-- Retained "Student" for Wentworth -->
                    <option value="GUE" <?php if($row["c_type"]=="GUE"){echo "selected";}?>>Visitor</option> <!-- Changed "Guest" to "Visitor" for clarity -->
                    <option value="ADM" <?php if($row["c_type"]=="ADM"){echo "selected";}?>>Admin</option>
                    <option value="OTH" <?php if($row["c_type"]=="OTH"){echo "selected";}?>>Other</option>
                </select>
                <label for="type">Your Role</label> <!-- Changed label text for clarity -->
            </div>
            <input type="hidden" name="c_id" value="<?php echo $c_id;?>">
            <button class="w-100 btn btn-success mb-3" name="upd_confirm" type="submit">Update Profile</button>
        </form>
    </div>

    <?php include('admin_footer.php')?>
</body>

</html>
