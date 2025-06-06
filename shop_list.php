<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <title>Shop List | Wentworth Canteen</title> <!-- Updated title to reflect Wentworth context -->
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>

    <div class="container p-5" id="recommended-shop">
        <a class="nav nav-item text-decoration-none text-muted mb-3" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <h3 class="border-bottom pb-2"><i class="bi bi-shop align-top"></i> Available Shops</h3> <!-- Adjusted spelling of "Available" -->

        <!-- GRID SHOP SELECTION -->
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">

        <?php
            $query = "SELECT s_id,s_name,s_pic FROM shop";
            $result = $mysqli -> query($query);
            if($result -> num_rows > 0){
            while($row = $result -> fetch_array()){
        ?>
            <!-- GRID EACH SHOP -->
            <div class="col">
                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>" class="text-decoration-none text-dark">
                    <div class="card rounded-25">
                        <img
                        <?php
                            if(is_null($row["s_pic"])){echo "src='img/default.png'";}  // Default image for shops without one
                            else{echo "src=\"img/{$row['s_pic']}\"";}  // Display custom shop image if available
                        ?>
                        style="width:100%; height:175px; object-fit:cover;" class="card-img-top rounded-25 img-fluid" alt="...">
                        <div class="card-body">
                            <h4 name="shop-name" class="card-title"><?php echo $row["s_name"]?></h4>  <!-- Display shop name -->

                            <div class="text-end">
                                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>" class="btn btn-sm btn-outline-dark">Go to shop</a>  <!-- Button to navigate to the shop's menu -->
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID EACH SHOP -->
        <?php }
        }else{
            ?>
            </div>
            <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">No shops currently available for order!</p> <!-- Message if no shops are available -->
                    </div>
            </div>
            <?php
        }
            $result -> free_result();
        ?>
        </div>
        <!-- END GRID SHOP SELECTION -->

    </div>

    <?php include('footer.php')?>
</body>

</html>
