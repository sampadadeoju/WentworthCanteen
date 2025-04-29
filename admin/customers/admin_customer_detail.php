<?php
require_once '../../security/restricted.php';
require_admin();
require_once '../../core/conn_db.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    $stmt = $conn->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get customer orders
    $stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id = :id ORDER BY order_date DESC");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Error loading customer details");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../../includes/head.php'; ?>
</head>
<body>
    <?php include '../layout/nav_header_admin.php'; ?>
    <div class="admin-container">
        <h1>Customer Details</h1>
        <div class="customer-details">
            <p><strong>ID:</strong> <?= $customer['id'] ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($customer['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($customer['email']) ?></p>
            <p><strong>Joined:</strong> <?= date('d/m/Y', strtotime($customer['created_at'])) ?></p>
        </div>
        
        <h2>Order History</h2>
        <?php if(empty($orders)): ?>
            <p>No orders found</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                        <td><?= ucfirst($order['status']) ?></td>
                        <td><?= number_format($order['total_amount'], 2) ?> AUD</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="admin_customer_list.php" class="btn-back">Back to List</a>
    </div>
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>