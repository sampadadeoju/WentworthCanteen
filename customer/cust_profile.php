<?php
require_once '../core/conn_db.php';
require_once '../security/restricted.php';
require_customer();

try {
    $db = new Database();
    $conn = $db->connect();
    
    // Get customer details
    $stmt = $conn->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Handle profile update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_input($_POST['name']);
        $email = sanitize_input($_POST['email']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        
        // Verify current password if changing password
        if (!empty($new_password)) {
            if (!password_verify($current_password, $customer['password'])) {
                $error = 'Current password is incorrect';
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $update_sql = "UPDATE customers SET name = :name, email = :email, password = :password WHERE id = :id";
            }
        } else {
            $update_sql = "UPDATE customers SET name = :name, email = :email WHERE id = :id";
        }
        
        if (!isset($error)) {
            $stmt = $conn->prepare($update_sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $_SESSION['user_id']);
            
            if (isset($hashed_password)) {
                $stmt->bindParam(':password', $hashed_password);
            }
            
            $stmt->execute();
            $_SESSION['user_name'] = $name;
            $_SESSION['success'] = 'Profile updated successfully';
            header('Location: cust_profile.php');
            exit();
        }
    }

} catch(PDOException $e) {
    error_log("Profile Error: " . $e->getMessage());
    $error = 'Error updating profile. Please try again.';
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
</head>
<body>
    <?php include '../includes/nav_header.php'; ?>
    
    <main class="profile-container">
        <h1>My Profile</h1>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if(isset($error)): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($customer['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Current Password (only needed if changing password)</label>
                <input type="password" name="current_password">
            </div>
            <div class="form-group">
                <label>New Password (leave blank to keep current)</label>
                <input type="password" name="new_password">
            </div>
            <button type="submit" class="btn-save">Save Changes</button>
        </form>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>