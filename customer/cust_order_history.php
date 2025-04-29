<?php
require_once '../core/conn_db.php';
require_once '../security/restricted.php';
require_customer();

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Get customer orders with total amounts
    $stmt = $conn->prepare("
        SELECT o.id, o.order_date, o.status, SUM(oi.price * oi.quantity) as total
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        WHERE o.customer_id = :customer_id
        GROUP BY o.id
        ORDER BY o.order_date DESC
    ");
    $stmt->bindParam(':customer_id', $_SESSION['user_id']);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    error_log("Order History Error: " . $e->getMessage());
    die("Error loading order history");
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
    <style>
        /* Add this to your main.css later */
        .order-history-container {
            min-height: calc(100vh - 300px); /* Adjust based on your header/footer height */
            padding: 2rem 0;
        }
        
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .order-table th, 
        .order-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .order-table th {
            background-color: #2c3e50;
            color: white;
        }
        
        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-badge.pending {
            background-color: #f39c12;
            color: white;
        }
        
        .status-badge.completed {
            background-color: #27ae60;
            color: white;
        }
        
        .btn-view {
            background-color: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        
        .btn-view:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <?php include '../includes/nav_header.php'; ?>
    
    <main class="container order-history-container">
        <h1>Order History</h1>
        
        <?php if(empty($orders)): ?>
            <div class="empty-orders">
                <p>You haven't placed any orders yet.</p>
                <a href="/BasicCanteen/menu/shop_list.php" class="btn-shop-now">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="order-table">
                    [Rest of your table code remains the same]
                </table>
            </div>
        <?php endif; ?>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>