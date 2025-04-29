<?php
session_start();
require_once '../core/conn_db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: cust_login.php');
    exit();
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Assuming you have a function to get item details
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT * FROM food_items WHERE id = :id");
    $stmt->bindParam(':id', $item_id);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $_SESSION['cart'][$item_id] = [
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $quantity
        ];
    }
}

// Display cart contents
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/head.php'; ?>
    <style>
        .cart-container {
            min-height: calc(100vh - 300px);
            padding: 2rem 0;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .cart-items {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .item-info {
            flex: 2;
        }
        
        .item-price {
            flex: 1;
            text-align: right;
            font-weight: bold;
            color: #e74c3c;
        }
        
        .item-quantity {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 0.3rem;
        }
        
        .btn-update {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn-remove {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .cart-summary {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            text-align: right;
        }
        
        .cart-total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .btn-checkout {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .btn-checkout:hover {
            background: #219653;
        }
        
        .empty-cart {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn-continue {
            display: inline-block;
            margin-top: 1rem;
            background: #3498db;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include '../includes/nav_header.php'; ?>
    
    <main class="cart-container">
        <h1>My Cart</h1>
        
        <?php if(empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Your cart is empty</p>
                <a href="/BasicCanteen/menu/shop_list.php" class="btn-continue">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $item_id => $item): ?>
                <div class="cart-item">
                    <div class="item-info">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                    </div>
                    <div class="item-price">
                        <?= number_format($item['price'], 2) ?> AUD
                    </div>
                    <form method="POST" class="item-quantity">
                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                        <button type="submit" name="update_quantity" class="btn-update">Update</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                        <button type="submit" name="remove_item" class="btn-remove">Remove</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <div class="cart-total">
                    Total: <?= number_format($cart_total, 2) ?> AUD
                </div>
                <a href="/BasicCanteen/order/add_order.php" class="btn-checkout">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>
