<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        include("range_fn.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <script type="text/javascript" src="../js/revenue_date_selection.js"></script>
    <title>Shop Revenue Report | Wentworth Canteen</title>
</head>

<body class="d-flex flex-column h-100 bg-white">
    <?php include('nav_header_admin.php')?>

    <?php
        $s_id = $_GET["s_id"];
        $query = "SELECT s_name,s_location,s_phoneno,s_pic
        FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $shop_row = $result -> fetch_array();
    ?>

    <div class="container px-5 py-4" id="shop-body">
        <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <div class="container row row-cols-6 row-cols-md-12 g-5 pt-4 mb-4" id="shop-header">
            <div class="rounded-25 col-6 col-md-4" id="shop-img" style="
                    background: url(
                        <?php
                            if(is_null($shop_row["s_pic"])){echo "'../img/default.png'";}
                            else{echo "'../img/{$shop_row['s_pic']}'";}
                        ?> 
                    ) center; height: 225px;
                    background-size: cover; background-repeat: no-repeat; object-fit:fill;
                    background-position: center;">
            </div>
            <div class="col-6 col-md-8">
                <h1 class="display-5 strong"><?php echo $shop_row["s_name"];?></h1>
                <ul class="list-unstyled">
                    
                    <li class=""><?php echo $shop_row["s_location"];?></li>
                    
                    <li class="">Telephone number: <?php echo "(+61) ".$shop_row["s_phoneno"];?></li>
                </ul>
                <a class="btn btn-sm btn-outline-secondary" href="admin_shop_pwd.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-key"></i>
                    Change password
                </a>
                <a class="btn btn-sm btn-primary mt-2 mt-md-0" href="admin_shop_edit.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-pencil-square"></i>
                    Update shop profile
                </a>
                <a class="btn btn-sm btn-danger mt-2 mt-md-0" href="admin_shop_delete.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-trash"></i>
                    Delete this shop
                </a>
            </div>
        </div>

        <?php
            // Revenue Summary Preparation Part
            // 1: Indicate Range
            // rev_mode: 1 Today / 2 Yesterday / 3 This Week / 4 Monthly / 5 Specific Period
            $s_id = $_GET["s_id"];
            $rev_mode = $_GET["rev_mode"];
            $today = date("Y-m-d");
            $yesterday = (new Datetime()) -> sub(new DateInterval("P1D")) -> format('Y-m-d');
            $weekrange = rangeWeek(date('Y-n-j'));
            $monthrange = rangeMonth(date('Y-n-j'));
            switch($rev_mode){
                case 1: $start_date = $today; 
                        $end_date = $today; 
                        break;
                case 2: $start_date = $yesterday; 
                        $end_date = $yesterday; 
                        break;
                case 3: $start_date = (new Datetime($weekrange["start"])) -> format('Y-m-d');
                        $end_date = (new Datetime($weekrange["end"])) -> format('Y-m-d');
                        break;
                case 4: $start_date = (new Datetime($monthrange["start"])) -> format('Y-m-d');
                        $end_date = (new Datetime($monthrange["end"])) -> format('Y-m-d');
                        break;
                case 5: 
                        if(isset($_GET["start_date"])&&(isset($_GET["end_date"]))){
                            $start_date = $_GET["start_date"];
                            $end_date = $_GET["end_date"];
                        }else{
                            header("location: shop_report_select.php"); exit(1);
                        }
                        break;
                default: header("location: shop_report_select.php"); exit(1);
            }
            $formatted_start = (new Datetime($start_date)) -> format('F j, Y');
            $formatted_end = (new Datetime($end_date)) -> format('F j, Y');
        ?>

        <div class="container">
            <h3 class="border-top pt-3 my-2">
                <a class="text-decoration-none link-secondary"
                    href="admin_shop_detail.php?s_id=<?php echo $s_id?>">Menus</a>
                <span class="text-secondary">/</span>
                <a class="nav-item text-decoration-none link-secondary" href="admin_shop_order.php?s_id=<?php echo $s_id?>">Orders</a></span>
                <span class="text-secondary">/</span>
                <a class="nav-item text-decoration-none link-success"
                    href="admin_shop_revenue.php?s_id=<?php echo $s_id?>">Revenue</a></span>
            </h3>

            <a class="nav nav-item text-decoration-none text-muted my-3" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
            <h3 class="display-6">Revenue Report</h3>
            <h4 class="fw-light">
                <?php 
                if($formatted_start==$formatted_end){
                    echo "Of {$formatted_start}";
                }else{
                    echo "From {$formatted_start} to {$formatted_end}";
                }
            ?>
            </h4>
            <p class="fw-light">Generated on <?php echo date("F j, Y H:i")?>. This report only includes finished orders.
            </p>

            <h4 class="border-top fw-light pt-3 pb-2 mt-2">Overall Performance</h4>
            <div class="row row-cols-2 row-cols-md-4 mb-3 g-2">
                <div class="col">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                    $query = "SELECT SUM(ord.ord_amount*ord.ord_buyprice) AS rev FROM order_header orh INNER JOIN order_detail ord ON orh.orh_id = ord.orh_id
                                    WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                                    $result = $mysqli -> query($query) -> fetch_array();
                                    if(is_null($result["rev"])){$grandtotal = 0;} else{$grandtotal = $result["rev"];}
                                    printf("%.2f AUD",$grandtotal); // Changed to AUD (Australian Dollar)
                                ?>
                            </h5>
                            <p class="card-text small">Total revenue</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                    $query = "SELECT COUNT(*) AS cnt FROM order_header orh 
                                    WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                                    $result = $mysqli -> query($query) -> fetch_array();
                                    if(is_null($result["cnt"])){$num_order = 0;} else{$num_order = $result["cnt"];}
                                    printf("%d Orders",$num_order);
                                ?>
                            </h5>
                            <p class="card-text small">Number of orders</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                    $query = "SELECT COUNT(DISTINCT orh.c_id) AS cnt FROM order_header orh 
                                    WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                                    $result = $mysqli -> query($query) -> fetch_array();
                                    if(is_null($result["cnt"])){echo "0 Customers";} else{echo $result["cnt"]." Customers";}
                                ?>
                            </h5>
                            <p class="card-text small">Number of customers</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                    if($num_order == 0){echo "0.00 AUD";} // Changed to AUD
                                    else{printf("%.2f AUD",$grandtotal/$num_order);} // Changed to AUD
                                ?>
                            </h5>
                            <p class="card-text small">Average revenue per order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
