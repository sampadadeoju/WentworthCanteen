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

        // Handle form submission for updating menu item
        if(isset($_POST["upd_confirm"])){
            $s_id = $_POST["s_id"];
            $f_id = $_POST["f_id"];
            
            $f_name = $_POST["f_name"];
            $f_price = $_POST["f_price"];
            
            // Update food details in the database
            $update_query = "UPDATE food SET f_name = '{$f_name}', f_price = '{$f_price}' WHERE f_id = {$f_id};";
            $update_result = $mysqli -> query($update_query);

            // Handle image upload if a new file is provided
            if(!empty($_FILES["f_pic"]["name"])){
                // Image upload directory
                $target_dir = '/img/';
                $temp = explode(".",$_FILES["f_pic"]["name"]);
                $target_newfilename = $f_id."_".$s_id.".".strtolower(end($temp));
                $target_file = $target_dir.$target_newfilename;
                
                if(move_uploaded_file($_FILES["f_pic"]["tmp_name"], SITE_ROOT.$target_file)){
                    $update_query = "UPDATE food SET f_pic = '{$target_newfilename}' WHERE f_id = {$f_id};";
                    $update_result = $mysqli -> query($update_query);
                }else{
                    $update_result = false;
                }
            }

            // Redirect with success or failure message
            if($update_result){
                header("location: admin_food_detail.php?f_id={$f_id}&up_fdt=1");
            } else {
                header("location: admin_food_detail.php?f_id={$f_id}&up_fdt=0");
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
    <title>Update menu detail | WENTWORTH CANTEEN</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <div class="container form-signin mt-auto w-50">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>

        <?php 
            // Select food record from database
            $f_id = $_GET["f_id"];
            $query = "SELECT * FROM food WHERE f_id = {$f_id} LIMIT 0,1";
            $result = $mysqli -> query($query);
            $row = $result -> fetch_array();
        ?>

        <form method="POST" action="admin_food_edit.php" class="form-floating" enctype="multipart/form-data">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-pencil-square me-2"></i>Update Menu Detail</h2>

            <!-- Food Name Input -->
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="f_name" placeholder="Food Name" name="f_name" 
                value="<?php echo $row["f_name"];?>" required>
                <label for="f_name">Menu Name</label>
            </div>

            <!-- Price Input (set to AUD currency) -->
            <div class="form-floating mb-2">
                <input type="number" step=".25" min="0.00" max="999.75" class="form-control" id="f_price" 
                placeholder="Price (AUD)" value="<?php echo $row["f_price"];?>" name="f_price" required>
                <label for="f_price">Price (AUD)</label>
            </div>

            <!-- Image Upload -->
            <div class="mb-2">
                <label for="formFile" class="form-label">Upload Food Image</label>
                <input class="form-control" type="file" id="f_pic" name="f_pic" accept="image/*">
            </div>

            <input type="hidden" name="s_id" value="<?php echo $s_id;?>">
            <input type="hidden" name="f_id" value="<?php echo $f_id;?>">

            <!-- Submit Button -->
            <button class="w-100 btn btn-success mb-3" name="upd_confirm" type="submit">Update Menu Detail</button>
        </form>
    </div>

    <?php include('admin_footer.php')?>
</body>

</html>
