<nav class="main-nav">
    <div class="nav-brand">
        <a href="/BasicCanteen/" style="display: flex; align-items: center; text-decoration: none; color: white;">
            <img src="/BasicCanteen/assets/img/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <?= $_SESSION['canteen_name'] ?? 'WentworthCanteen' ?>
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="/BasicCanteen/index.php">Home</a></li>
        <li><a href="/BasicCanteen/menu/shop_list.php">Canteen Menu</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="/BasicCanteen/customer/cust_order_history.php">Order History</a></li>
            <li><a href="/BasicCanteen/customer/cust_cart.php">My Cart</a></li>
            <li class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></li>
            <li><a href="/BasicCanteen/authentication/logout.php">Log Out</a></li>
        <?php else: ?>
            <li><a href="/BasicCanteen/authentication/cust_login.php">Login</a></li>
            <li><a href="/BasicCanteen/authentication/cust_regist.php">Register</a></li>
        <?php endif; ?>
    </ul>
    <div class="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
</nav>