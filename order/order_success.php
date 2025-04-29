<?php
require_once '../core/conn_db.php';
require_once '../security/restricted.php';
require_customer();

try {
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id AND customer_id = :customer_id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->bindParam(':customer_id', $_SESSION['user_id']);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error loading order details");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
</head>
<body>
    <?php include '../includes/nav_header.php'; ?>
    <main class="order-success-container">
        <h1>Order Confirmation</h1>
        <div class="success-card">
            <h2>Thank you for your order!</h2>
            <p>Order ID: #<?= $order['id'] ?></p>
            <p>Status: <?= ucfirst($order['status']) ?></p>
            <p>Total Amount: <?= number_format($order['total_amount'], 2) ?> AUD</p>
            <a href="../index.php" class="btn-continue">Continue Shopping</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>