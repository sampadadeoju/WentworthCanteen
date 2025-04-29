<?php
require_once '../../security/restricted.php';
require_admin();
require_once '../../core/conn_db.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Handle delete action
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM food_items WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['success'] = 'Item deleted successfully';
        header('Location: admin_food_list.php');
        exit();
    }
    
    // Get all food items with shop names
    $stmt = $conn->query("
        SELECT f.*, s.name as shop_name 
        FROM food_items f
        JOIN shops s ON f.shop_id = s.id
        ORDER BY s.name, f.name
    ");
    $food_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    error_log("Food List Error: " . $e->getMessage());
    die("Error loading food items");
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
        <h1>Food Items Management</h1>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <a href="admin_food_add.php" class="btn-add">Add New Food Item</a>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (AUD)</th>
                    <th>Shop</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($food_items as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= htmlspecialchars($item['shop_name']) ?></td>
                    <td class="actions">
                        <a href="admin_food_edit.php?id=<?= $item['id'] ?>" class="btn-edit">Edit</a>
                        <form method="POST" onsubmit="return confirm('Are you sure?')">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="delete" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>