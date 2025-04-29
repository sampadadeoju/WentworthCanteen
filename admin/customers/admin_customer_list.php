<?php
session_start();
require_once '../core/conn_db.php';
require_once '../security/restricted.php';
require_admin();

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT * FROM customers");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
</head>
<body>
    <?php include '../layout/nav_header_admin.php'; ?>
    <h1>Customer List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['id']) ?></td>
                    <td><?= htmlspecialchars($customer['username']) ?></td>
                    <td><?= htmlspecialchars($customer['name']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td>
                        <a href="admin_customer_detail.php?id=<?= $customer['id'] ?>">View</a>
                        <a href="admin_customer_edit.php?id=<?= $customer['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include '../layout/admin_footer.php'; ?>
</body>
</html>