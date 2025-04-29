<?php
require_once '../../security/restricted.php';
require_admin();
require_once '../../core/conn_db.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Get customer data
    $stmt = $conn->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_input($_POST['name']);
        $email = sanitize_input($_POST['email']);
        
        $stmt = $conn->prepare("UPDATE customers SET name = :name, email = :email WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        
        $_SESSION['success'] = 'Customer updated successfully';
        header('Location: admin_customer_list.php');
        exit();
    }

} catch(PDOException $e) {
    die("Error updating customer");
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
        <h1>Edit Customer</h1>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($customer['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
            </div>
            <button type="submit" class="btn-save">Save Changes</button>
            <a href="admin_customer_list.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>