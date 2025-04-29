<div class="shop-card">
    <img src="assets/img/<?= htmlspecialchars($shop['image']) ?>" alt="<?= htmlspecialchars($shop['name']) ?>">
    <div class="shop-info">
        <h3><?= htmlspecialchars($shop['name']) ?></h3>
        <p class="shop-description"><?= htmlspecialchars($shop['description']) ?></p>
        <div class="shop-meta">
            <span class="location"><?= htmlspecialchars($shop['location']) ?></span>
            <a href="menu/shop_list.php?id=<?= $shop['id'] ?>" class="btn-visit-shop">Visit Shop</a>
        </div>
    </div>
</div>