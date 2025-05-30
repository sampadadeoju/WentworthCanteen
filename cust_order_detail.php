<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start();
        if(!isset($_SESSION["cid"])||!isset($_GET["orh_id"])){
            header("location: restricted.php");
            exit(1);
        }
        include("conn_db.php");
        include('head.php');
    ?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <title>Order Detail | WENTWORTH CANTEEN</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>

    <div class="container px-5 py-4" id="cart-body">
        <div class="row my-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
            <h2 class="pt-3 display-6">Order Detail</h2>

            <?php
                $orh_id = $_GET["orh_id"];
                $orh_query = "SELECT * FROM order_header WHERE orh_id = {$orh_id}";
                $orh_arr = $mysqli -> query($orh_query) -> fetch_array();
            ?>

            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-2 mb-md-0">
                    <ul class="list-unstyled fw-light">
                        <li class="list-item mb-2">
                            <?php if($orh_arr["orh_orderstatus"]=="VRFY"){ ?>
                                <h5><span class="fw-bold badge bg-info text-dark">Verifying</span></h5>
                            <?php }else if($orh_arr["orh_orderstatus"]=="ACPT"){ ?>
                                <h5><span class="fw-bold badge bg-secondary text-dark">Accepted</span></h5>
                            <?php }else if($orh_arr["orh_orderstatus"]=="PREP"){ ?>
                                <h5><span class="fw-bold badge bg-warning text-dark">Preparing</span></h5>
                            <?php }else if($orh_arr["orh_orderstatus"]=="RDPK"){ ?>
                                <h5><span class="fw-bold badge bg-primary text-white">Ready to pick up</span></h5>
                            <?php }else if($orh_arr["orh_orderstatus"]=="FNSH"){?>
                                <h5><span class="fw-bold badge bg-success text-white">Completed</span></h5>
                            <?php }else if($orh_arr["orh_orderstatus"]=="CNCL"){?>
                                <h5><span class="fw-bold badge bg-danger text-white">Cancelled</span></h5>
                            <?php } ?>
                        </li>
                        <li class="list-item">Order </li>
                        <li class="list-item">From 
                            <?php
                                $shop_query = "SELECT s_name FROM shop WHERE s_id = {$orh_arr['s_id']};";
                                $shop_arr = $mysqli -> query($shop_query) -> fetch_array();
                                echo $shop_arr["s_name"];
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-unstyled fw-light">
                        <?php 
                            $od_placedate = (new Datetime($orh_arr["orh_ordertime"])) -> format("F j, Y H:i"); 
                        ?>
                        <li class="mb-2">&nbsp;</li>
                        <li>Placed on <?php echo $od_placedate;?></li>
                        <?php if($orh_arr["orh_orderstatus"]!="FNSH"){ ?>
                        <?php }else{
                            $od_finishtime = (new Datetime($orh_arr["orh_finishedtime"])) -> format("F j, Y H:i");
                        ?>
                        <li>Finished on <?php echo $od_finishtime;?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <div class="row row-cols-1">
                    <div class="col">
                        <h5 class="fw-light">Menu</h5>
                    </div>
                    <div class="col row row-cols-1 row-cols-md-2 border-bottom">
                        <?php 
                            $ord_query = "SELECT f.f_name,f.f_pic,ord.ord_amount,ord.ord_buyprice,ord_note FROM order_detail ord INNER JOIN food f ON ord.f_id = f.f_id WHERE ord.orh_id = {$orh_id}";
                            $ord_result = $mysqli -> query($ord_query);
                            while($ord_row = $ord_result -> fetch_array()){
                        ?>
                        <div class="col">
                            <ul class="list-group">
                                <!-- START CART ITEM -->
                                 
                                <li class="list-group-item d-flex border-0 pb-3 border-bottom w-100 justify-content-between align-items-center">
                                    <div class="image-parent">
                                        <img 
                                        <?php
                                            if(is_null($ord_row["f_pic"])){echo "src='img/default.png'";} 
                                            else{echo "src=\"img/{$ord_row['f_pic']}\"";}
                                        ?>
                                        class="img-fluid rounded"
                                        style="width: 100px; height:100px; object-fit:cover;" alt="<?php echo $ord_row["f_name"]?>">
                                    </div>
                                    <div class="ms-3 me-auto">
                                        <div class="fw-normal"><span class="h5"><?php echo $ord_row["ord_amount"]?>x </span><?php echo $ord_row["f_name"]?>
                                            <p><?php printf("%.2f AUD <small class='text-muted'>(%.2f AUD each)</small>",$ord_row["ord_buyprice"]*$ord_row["ord_amount"],$ord_row["ord_buyprice"]);?><br />
                                                <span class="text-muted small"><?php echo $ord_row["ord_note"]?></span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col my-3">
                        <ul class="list-inline justify-content-between">
                            <li class="list-inline-item fw-light me-5">Grand Total</li>
                            <li class="list-inline-item fw-bold h4">
                                <?php
                                    $gt_query = "SELECT SUM(ord_amount*ord_buyprice) AS gt FROM order_detail WHERE orh_id = {$orh_id}";
                                    $gt_arr = $mysqli -> query($gt_query) -> fetch_array();
                                    printf("%.2f AUD",$gt_arr["gt"]);
                                ?>
                            </li>
                            <li class="list-item fw-light small">Pay by QR</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('footer.php')?>
</body>

</html>
