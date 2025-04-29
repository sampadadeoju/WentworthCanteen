<?php
session_start();
require_once '../core/conn_db.php';
require_once '../security/restricted.php';
require_customer();

if (empty($_SESSION['cart'])) {
    header('Location: ../customer/cust_cart.php');
    exit();
}

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Start transaction
    $conn->beginTransaction();
    
    // Create order
    $stmt = $conn->prepare("INSERT INTO orders (customer_id, order_date, status) VALUES (:customer_id, NOW(), 'pending')");
    $stmt->bindParam(':customer_id', $_SESSION['user_id']);
    $stmt->execute();
    $order_id = $conn->lastInsertId();
    
    // Add order items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, food_item_id, quantity, price) VALUES (:order_id, :food_item_id, :quantity, :price)");
    
    foreach ($_SESSION['cart'] as $shop_id => $items) {
        foreach ($items as $item) {
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':food_item_id', $item['id']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->bindParam(':price', $item['price']);
            $stmt->execute();
        }
    }
    
    // Commit transaction
    $conn->commit();
    
    // Clear cart
    unset($_SESSION['cart']);
    
    header('Location: order_success.php?id=' . $order_id);
    exit();

} catch(PDOException $e) {
    $conn->rollBack();
    error_log("Order Error: " . $e->getMessage());
    die("Order processing failed. Please try again.");
}
?>