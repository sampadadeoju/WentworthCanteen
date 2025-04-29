<?php
require_once '../security/restricted.php';
require_admin();
require_once '../core/conn_db.php';
require_once 'layout/nav_header_admin.php';
?>

<div class="admin-container">
    <h1>Admin Dashboard</h1>
    
    <div class="admin-cards">
        <div class="admin-card">
            <h3>Total Shops</h3>
            <?php
            $db = new Database();
            $conn = $db->connect();
            $stmt = $conn->query("SELECT COUNT(*) FROM shops");
            $count = $stmt->fetchColumn();
            ?>
            <p><?= $count ?></p>
            <a href="food/admin_food_list.php">Manage</a>
        </div>
        
        <div class="admin-card">
            <h3>Total Menu Items</h3>
            <?php
            $stmt = $conn->query("SELECT COUNT(*) FROM food_items");
            $count = $stmt->fetchColumn();
            ?>
            <p><?= $count ?></p>
            <a href="food/admin_food_list.php">Manage</a>
        </div>
    </div>
</div>

<?php require_once 'layout/admin_footer.php'; ?>