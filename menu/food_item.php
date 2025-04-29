<?php
require_once '../core/conn_db.php';
require_once '../includes/head.php';
require_once '../includes/nav_header.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    $stmt = $conn->prepare("
        SELECT f.*, s.name AS shop_name 
        FROM food_items f
        JOIN shops s ON f.shop_id = s.id
        WHERE f.id = :id
    ");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Error loading food item");
}
?>
<main class="food-item-container">
    <h1><?= htmlspecialchars($item['name']) ?></h1>
    <div class="food-details">
        <p class="price"><?= number_format($item['price'], 2) ?> AUD</p>
        <p class="shop">From: <?= htmlspecialchars($item['shop_name']) ?></p>
        <p class="description"><?= htmlspecialchars($item['description']) ?></p>
        <form action="../customer/cust_cart.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
            <input type="hidden" name="shop_id" value="<?= $item['shop_id'] ?>">
            <button type="submit" class="btn-add-to-cart">Add to Cart</button>
        </form>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>