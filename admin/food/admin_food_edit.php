<?php
require_once '../../security/restricted.php';
require_admin();
require_once '../../core/conn_db.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Get food item data
    $stmt = $conn->prepare("SELECT * FROM food_items WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $food = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get shops for dropdown
    $shops = $conn->query("SELECT id, name FROM shops")->fetchAll(PDO::FETCH_ASSOC);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_input($_POST['name']);
        $price = sanitize_input($_POST['price']);
        $shop_id = sanitize_input($_POST['shop_id']);
        
        $stmt = $conn->prepare("UPDATE food_items SET 
            name = :name,
            price = :price,
            shop_id = :shop_id
            WHERE id = :id");
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':shop_id', $shop_id);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        
        $_SESSION['success'] = 'Food item updated';
        header('Location: admin_food_list.php');
        exit();
    }

} catch(PDOException $e) {
    die("Error updating food item");
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
        <h1>Edit Food Item</h1>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($food['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Price (AUD)</label>
                <input type="number" step="0.01" name="price" value="<?= $food['price'] ?>" required>
            </div>
            <div class="form-group">
                <label>Shop</label>
                <select name="shop_id" required>
                    <?php foreach ($shops as $shop): ?>
                    <option value="<?= $shop['id'] ?>" <?= $shop['id'] == $food['shop_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($shop['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-save">Update Item</button>
            <a href="admin_food_list.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>