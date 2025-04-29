<?php
require_once '../core/conn_db.php';
require_once '../includes/head.php';
require_once '../includes/nav_header.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Get all shops
    $stmt = $conn->query("SELECT * FROM shops ORDER BY name");
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    error_log('Shop List Error: ' . $e->getMessage());
    die('Error loading shops');
}
?>

<main class="container">
    <section class="shop-listings">
        <h1>Canteen Shops</h1>
        <div class="shop-grid">
            <?php foreach ($shops as $shop): ?>
                <div class="shop-card">
                    <?php if(!empty($shop['image'])): ?>
                        <img src="../assets/img/<?= htmlspecialchars($shop['image']) ?>" 
                             alt="<?= htmlspecialchars($shop['name']) ?>">
                    <?php endif; ?>
                    <div class="shop-info">
                        <h3><?= htmlspecialchars($shop['name']) ?></h3>
                        <p class="shop-description"><?= htmlspecialchars($shop['description']) ?></p>
                        <div class="shop-meta">
                            <?php if(!empty($shop['location'])): ?>
                                <span class="location"><?= htmlspecialchars($shop['location']) ?></span>
                            <?php endif; ?>
                            <a href="food_items.php?id=<?= $shop['id'] ?>" class="btn-visit-shop">
                                Visit Shop
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>