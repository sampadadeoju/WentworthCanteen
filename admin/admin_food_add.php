<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"] != "ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        if(isset($_POST["add_confirm"])){
            $f_name = $_POST["f_name"];
            $s_id = $_POST["s_id"];
            $f_price = $_POST["f_price"];
            $insert_query = "INSERT INTO food (f_name,f_price,s_id) 
            VALUES ('{$f_name}',{$f_price},{$s_id});";
            $insert_result = $mysqli -> query($insert_query);
            if(!empty($_FILES["f_pic"]["name"]) && $insert_result){
                //Image upload
                $f_id = $mysqli -> insert_id;
                $target_dir = '/img/';
                $temp = explode(".",$_FILES["f_pic"]["name"]);
                $target_newfilename = $f_id."_".$s_id.".".strtolower(end($temp));
                $target_file = $target_dir.$target_newfilename;
                if(move_uploaded_file($_FILES["f_pic"]["tmp_name"],SITE_ROOT.$target_file)){
                    $insert_query = "UPDATE food SET f_pic = '{$target_newfilename}' WHERE f_id = {$f_id};";
                    $insert_result = $mysqli -> query($insert_query);
                }else{
                    $insert_result = false;
                }
            }
            if($insert_result){
                header("location: admin_food_list.php?add_fdt=1");
            } else {
                header("location: admin_food_list.php?add_fdt=0");
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
    <title>Add New Menu | Wentworth Canteen</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <div class="container form-signin mt-auto w-50">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <form method="POST" action="admin_food_add.php" class="form-floating" enctype="multipart/form-data">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-pencil-square me-2"></i>Add New Menu Item</h2>
            
            <div class="form-floating">
                <select class="form-select mb-2" id="s_id" name="s_id">
                    <option selected value="">---</option>
                    <?php
                        $option_query = "SELECT s_id,s_name FROM shop;";
                        $option_result = $mysqli -> query($option_query);
                        if($option_result -> num_rows != 0){
                            while($option_arr = $option_result -> fetch_array()){
                    ?>
                    <option value="<?php echo $option_arr["s_id"]?>"><?php echo $option_arr["s_name"];?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <label for="s_id">Shop Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="f_name" placeholder="Food Item Name" name="f_name" required>
                <label for="f_name">Menu Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" step=".25" min="0.00" max="999.75" class="form-control" id="f_price" placeholder="Price (AUD)" name="f_price" required>
                <label for="f_price">Price (AUD)</label>
            </div>
            <div class="mb-2">
                <label for="formFile" class="form-label">Upload Food Image</label>
                <input class="form-control" type="file" id="f_pic" name="f_pic" accept="image/*">
            </div>
            <button class="w-100 btn btn-success mb-3" name="add_confirm" type="submit">Add New Menu Item</button>
        </form>
    </div>

    <?php include('admin_footer.php')?>
</body>

</html>
