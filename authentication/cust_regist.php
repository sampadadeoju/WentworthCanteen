<?php
session_start();
require_once '../core/conn_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    try {
        $db = new Database();
        $conn = $db->connect();
        
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            $error = 'Email already registered';
        } else {
            $stmt = $conn->prepare("INSERT INTO customers (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();
            
            $_SESSION['success'] = 'Registration successful. Please login.';
            header('Location: cust_login.php');
            exit();
        }
    } catch(PDOException $e) {
        error_log("Registration Error: " . $e->getMessage());
        $error = 'Registration failed. Please try again.';
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
            <h2>Customer Registration</h2>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <div class="alert"><?= $error ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required minlength="6">
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="cust_login.php">Login</a></p>
        </form>
    </div>
</body>
</html>