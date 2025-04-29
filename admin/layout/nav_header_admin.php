<?php require_once '../../security/restricted.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../../includes/head.php'; ?>
</head>
<body>
<nav class="admin-nav">
    <div class="admin-nav-brand">Admin Panel</div>
    <ul class="admin-nav-links">
        <li><a href="../admin_home.php">Dashboard</a></li>
        <li><a href="../food/admin_food_list.php">Food Items</a></li>
        <li><a href="../customers/admin_customer_list.php">Customers</a></li>
        <li><a href="../../authentication/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="admin-container">