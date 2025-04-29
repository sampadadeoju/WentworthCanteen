<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <p><?= htmlspecialchars($_SESSION['canteen_name'] ?? 'Basic Canteen') ?> provides quality food services for the institution.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="/BasicCanteen/">Home</a></li>
                <li><a href="/BasicCanteen/menu/shop_list.php">Shops</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="/BasicCanteen/customer/cust_order_history.php">Order History</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: info@WentworthCanteen.edu.au</p>
            <p>Phone: +61 123456789</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($_SESSION['canteen_name'] ?? 'Basic Canteen') ?>. All rights reserved.</p>
    </div>
</footer>