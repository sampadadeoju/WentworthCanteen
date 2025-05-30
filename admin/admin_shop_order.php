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
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Shop Profile | Wentworth Canteen</title>
</head>

<body class="d-flex flex-column h-100">
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

        <!-- GRID MENU SELECTION -->
        <div class="container">
        <h3 class="border-top pt-3 my-2">
            <a class="text-decoration-none link-secondary" href="admin_shop_detail.php?s_id=<?php echo $s_id?>">Menus</a>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-success" href="#">Orders</a></span>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-secondary" href="admin_shop_revenue.php?s_id=<?php echo $s_id?>">Revenue</a></span>
        </h3>
            <form class="form-floating mb-3" method="GET" action="admin_shop_order.php">
                <input type="hidden" name="s_id" value="<?php echo $s_id;?>">
                <div class="row g-2">
                    <div class="col">
                        <select class="form-select" id="c_id" name="c_id">
                            <option selected value="">Customer Name</option>
                            <?php
                                $option_query = "SELECT DISTINCT c.c_id, c.c_firstname,c.c_lastname
                                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id 
                                WHERE orh.s_id = {$s_id};";
                                $option_result = $mysqli -> query($option_query);
                                $opt_row = $option_result -> num_rows;
                                if($option_result -> num_rows != 0){
                                    while($option_arr = $option_result -> fetch_array()){
                            ?>
                            <option value="<?php echo $option_arr["c_id"]?>"><?php echo $option_arr["c_firstname"]." ".$option_arr["c_lastname"]?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
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
                    <div class="col">
                        <select class="form-select" id="orderstatus" name="os">
                            <?php if(isset($_GET["search"])){?>
                            <option selected value="">Order Status</option>
                            <option value="VRFY" <?php if($_GET["os"]=="VRFY"){ echo "selected";}?>>Order Verifying</option>
                            <option value="ACPT" <?php if($_GET["os"]=="ACPT"){ echo "selected";}?>>Order Accepted</option>
                            <option value="PREP" <?php if($_GET["os"]=="PREP"){ echo "selected";}?>>Order Preparing</option>
                            <option value="RDPK" <?php if($_GET["os"]=="RDPK"){ echo "selected";}?>>Ready for Pick-Up</option>
                            <option value="FNSH" <?php if($_GET["os"]=="FNSH"){ echo "selected";}?>>Order Finished</option>
                            <option value="CNCL" <?php if($_GET["os"]=="CNCL"){ echo "selected";}?>>Order Cancelled</option>
                            <?php }else{ ?>
                            <option selected value="">Order Status</option>
                            <option value="VRFY">Order verifying</option>
                            <option value="ACPT">Order Accepted</option>
                            <option value="PREP">Order Preparing</option>
                            <option value="RDPK">Ready for Pick-Up</option>
                            <option value="FNSH">Order Finished</option>
                            <option value="CNCL">Order Cancelled</option>
                            
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" value="1" class="btn btn-success"
                        <?php if($opt_row==0){echo "disabled";} ?>>Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='admin_shop_order.php?s_id=<?php echo $s_id?>'">Clear</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
            $result -> free_result();
            if(isset($_GET["search"])){
                if($_GET["c_id"]!=''){ $cid_clause = " AND orh.c_id = '{$_GET['c_id']}';"; }else{ $cid_clause = ";";}
                $query = "SELECT orh.orh_id,orh.orh_ordertime,c.c_firstname,c.c_lastname,orh.orh_orderstatus,p.p_amount
                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id INNER JOIN payment p ON p.p_id = orh.p_id
                WHERE orh.s_id = {$s_id} AND c.c_type LIKE '%{$_GET['ut']}%' AND orh_orderstatus LIKE '%{$_GET['os']}%'".$cid_clause;
            }else{
                $query = "SELECT orh.orh_id,orh.orh_ordertime,c.c_firstname,c.c_lastname,orh.orh_orderstatus,p.p_amount,orh.t_id
                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id INNER JOIN payment p ON p.p_id = orh.p_id WHERE orh.s_id = {$s_id};";
            }
            $result = $mysqli -> query($query);
            $numrow = $result -> num_rows;
            if($numrow > 0){
        ?>
        <div class="container align-items-stretch">
            <!-- GRID EACH MENU -->
            <div class="table-responsive">
            <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-3">
                <caption><?php echo $numrow;?> order(s) <?php if(isset($_GET["search"])){?><br /><a
                        href="admin_shop_order.php?s_id=<?php echo $s_id?>" class="text-decoration-none text-danger">Clear Search
                        Result</a><?php } ?></caption>
                <thead class="bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Cost</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($row = $result -> fetch_array()){ ?>
                    <tr>
                        <th><?php echo $i++;?></th>
                        <td><?php echo $row["t_id"];?></td>
                        <td>
                            <?php if($row["orh_orderstatus"]=="VRFY"){ ?>
                                <h5><span class="fw-bold badge bg-info text-dark">Verifying</span></h5>
                            <?php }else if($row["orh_orderstatus"]=="ACPT"){ ?>
                                <h5><span class="fw-bold badge bg-secondary text-dark">Accepted</span></h5>
                            <?php }else if($row["orh_orderstatus"]=="PREP"){ ?>
                                <h5><span class="fw-bold badge bg-warning text-dark">Preparing</span></h5>
                            <?php }else if($row["orh_orderstatus"]=="RDPK"){ ?>
                                <h5><span class="fw-bold badge bg-primary text-white">Ready to pick up</span></h5>
                            <?php }else if($row["orh_orderstatus"]=="FNSH"){?>
                                <h5><span class="fw-bold badge bg-success text-white">Completed</span></h5>
                            <?php }
                            else if($row["orh_orderstatus"]=="CNCL"){?>
                                <h5><span class="fw-bold badge bg-danger text-white">Cancelled</span></h5>
                            <?php } ?>
                        </td>
                        <td><?php 
                        $order_time = (new Datetime($row["orh_ordertime"])) -> format("F j, Y H:i");
                        echo $order_time;
                        ?></td>
                        <td><?php echo $row["c_firstname"]." ".$row["c_lastname"];?></td>
                        <td><?php echo "$".$row["p_amount"];?></td>
                        <td><a href="admin_order_detail.php?orh_id=<?php echo $row["orh_id"]?>" class="btn btn-sm btn-primary">View</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <?php }else{ ?>
        <div class="alert alert-warning" role="alert">
            No matching orders found.
        </div>
        <?php } ?>
    </div>
</body>
</html>
