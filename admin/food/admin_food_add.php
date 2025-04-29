<?php
require_once '../../security/restricted.php';
require_admin();
require_once '../../core/conn_db.php';

$shops = [];
try {
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->query("SELECT id, name FROM shops");
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_input($_POST['name']);
        $price = sanitize_input($_POST['price']);
        $shop_id = sanitize_input($_POST['shop_id']);
        $description = sanitize_input($_POST['description']);
        $category = sanitize_input($_POST['category']);

        $stmt = $conn->prepare("INSERT INTO food_items 
            (shop_id, name, price, description, category) 
            VALUES (:shop_id, :name, :price, :description, :category)");
        
        $stmt->bindParam(':shop_id', $shop_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        
        $_SESSION['success'] = 'Food item added successfully';
        header('Location: admin_food_list.php');
        exit();
    }
} catch(PDOException $e) {
    $error = 'Error adding food item';
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
        <h1>Add New Food Item</h1>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Price (AUD)</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div class="form-group">
                <label>Shop</label>
                <select name="shop_id" required>
                    <?php foreach ($shops as $shop): ?>
                    <option value="<?= $shop['id'] ?>"><?= htmlspecialchars($shop['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn-save">Add Item</button>
            <a href="admin_food_list.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>