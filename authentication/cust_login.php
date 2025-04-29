<?php
session_start();
require_once '../core/conn_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    try {
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->prepare("SELECT * FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($customer = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $customer['password'])) {
                $_SESSION['user_id'] = $customer['id'];
                $_SESSION['user_name'] = $customer['name'];
                header('Location: ../index.php');
                exit();
            }
        }
        $error = 'Invalid email or password';
    } catch(PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        $error = 'Login failed. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h2>Customer Login</h2>
            <?php if(isset($error)): ?>
                <div class="alert"><?= $error ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="cust_regist.php">Register</a></p>
        </form>
    </div>
</body>
</html>