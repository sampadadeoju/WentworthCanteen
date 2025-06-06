<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if($_SESSION["utype"] != "ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/Color Icon with background.png" rel="icon">
    <link href="../css/main.css" rel="stylesheet">
    <title>Customer List | Wentworth Canteen</title>
</head>

<body class="d-flex flex-column h-100">

    <?php include('nav_header_admin.php')?>

    <div class="container p-2 pb-0" id="admin-dashboard">
        <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>

            <?php
            if(isset($_GET["up_prf"])){
                if($_GET["up_prf"] == 1){
                    ?>
            <!-- START SUCCESSFULLY UPDATE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully updated customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED UPDATE PROFILE -->
            <?php }
                }
            if(isset($_GET["del_cst"])){
                if($_GET["del_cst"] == 1){
                    ?>
            <!-- START SUCCESSFULLY DELETE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully deleted customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY DELETE PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED DELETE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to delete customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED DELETE PROFILE -->
            <?php }
                }
            if(isset($_GET["add_cst"])){
                if($_GET["add_cst"] == 1){
                    ?>
            <!-- START SUCCESSFULLY ADD PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully added new customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY ADD PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED ADD PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to add new customer profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_customer_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED ADD PROFILE -->
            <?php }
                }
            ?>

            <h2 class="pt-3 display-6">Customer List</h2>
            <form class="form-floating mb-3" method="GET" action="admin_customer_list.php">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="username" name="un" placeholder="Username"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["un"];?>" <?php } ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="firstname" name="fn" placeholder="First name"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["fn"];?>" <?php } ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="lastname" name="ln" placeholder="Last name"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["ln"];?>" <?php } ?>>
                    </div>
                    <div class="col">
                        <select class="form-select" id="utype" name="ut">
                            <?php if(isset($_GET["search"])){?>
                            <option selected value="">Customer Type</option>
                            <option value="STD" <?php if($_GET["ut"]=="STD"){ echo "selected";}?>>Student</option>
                            <option value="STF" <?php if($_GET["ut"]=="STF"){ echo "selected";}?>>Faculty Staff</option>
                            <option value="GUE" <?php if($_GET["ut"]=="GUE"){ echo "selected";}?>>Visitor</option>
                            <option value="ADM" <?php if($_GET["ut"]=="ADM"){ echo "selected";}?>>Admin</option>
                            <option value="OTH" <?php if($_GET["ut"]=="OTH"){ echo "selected";}?>>Other</option>
                            <?php }else{ ?>
                            <option selected value="">Customer Type</option>
                            <option value="STD">Student</option>
                            <option value="STF">Faculty Staff</option>
                            <option value="GUE">Visitor</option>
                            <option value="ADM">Admin</option>
                            <option value="OTH">Other</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" value="1" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='admin_customer_list.php'">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container pt-2" id="cust-table">

        <?php
            if(!isset($_GET["search"])){
                $search_query = "SELECT c_id, c_username, c_firstname, c_lastname, c_type, c_email FROM customer;";
            } else {
                $search_un = $_GET["un"];
                $search_fn = $_GET["fn"];
                $search_ln = $_GET["ln"];
                $search_ut = $_GET["ut"];
                $search_query = "SELECT c_id, c_username, c_firstname, c_lastname, c_type, c_email FROM customer
                WHERE c_username LIKE '%{$search_un}%' AND c_firstname LIKE '%{$search_fn}%' AND c_lastname LIKE '%{$search_ln}%' AND c_type LIKE '%{$search_ut}%';";
            }
            $search_result = $mysqli->query($search_query);
            $search_numrow = $search_result->num_rows;
            if($search_numrow == 0){
        ?>
        <div class="row">
            <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">No customer found!</span>
                <a href="admin_customer_list.php" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption><?php echo $search_numrow;?> customer(s) <?php if(isset($_GET["search"])){?><br /><a
                    href="admin_customer_list.php" class="text-decoration-none text-danger">Clear Search Result</a><?php } ?></caption>
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Customer Type</th>
                    <th>Email</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $search_result->fetch_assoc()) { ?>
                <tr>
                    <td class="fw-bold"><?php echo $row["c_username"]; ?></td>
                    <td><?php echo $row["c_firstname"] . " " . $row["c_lastname"]; ?></td>
                    <td><?php echo $row["c_type"]; ?></td>
                    <td><?php echo $row["c_email"]; ?></td>
                    <td>
                        <a href="admin_customer_profile.php?id=<?php echo $row["c_id"];?>"
                            class="btn btn-outline-primary btn-sm">View</a>
                        <a href="admin_customer_edit.php?id=<?php echo $row["c_id"];?>"
                            class="btn btn-outline-warning btn-sm">Edit</a>
                        <a href="admin_customer_delete.php?id=<?php echo $row["c_id"];?>"
                            class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    </div>

</body>

</html>
