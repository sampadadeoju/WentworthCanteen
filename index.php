<?php
require_once 'core/conn_db.php';
session_start();

// Set default canteen name if not set
if (!isset($_SESSION['canteen_name'])) {
    $_SESSION['canteen_name'] = 'Wentworth Canteen';
}

// Set page title
$page_title = $_SESSION['canteen_name'];
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/head.php'; ?>
<body>
    <?php require_once 'includes/nav_header.php'; ?>

    <main class="container">
        <div class="hero-banner">
            <h1>Welcome to <?= htmlspecialchars($_SESSION['canteen_name']) ?></h1>
            <p>Food ordering system for our institution</p>
        </div>

        <section class="shop-recommendations">
            <h2>Recommended For You</h2>
            <div class="shop-grid">
                <?php
                try {
                    $db = new Database();
                    $conn = $db->connect();
                    $stmt = $conn->query("SELECT * FROM shops WHERE featured = 1 LIMIT 5");
                    
                    while ($shop = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        include 'includes/shop_card.php';
                    }
                } catch(PDOException $e) {
                    error_log("Database Error: " . $e->getMessage());
                    echo '<p class="error">Currently unable to load shops. Please try again later.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>