-- Main Tables
CREATE TABLE IF NOT EXISTS shops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(100),
    contact VARCHAR(20),
    image VARCHAR(100),
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS food_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shop_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    image VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (shop_id) REFERENCES shops(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Order Tables
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date DATETIME NOT NULL,
    status ENUM('pending', 'preparing', 'ready', 'delivered', 'cancelled') DEFAULT 'pending',
    total_amount DECIMAL(10,2),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    food_item_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (food_item_id) REFERENCES food_items(id)
);

-- Insert Sample Admin
INSERT INTO admins (username, name, password) VALUES 
('admin', 'System Admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password is "password"

-- Insert Sample Shops
INSERT INTO shops (name, description, location, contact, image, featured) VALUES
('Wentworth Tea & Snacks', 'Fresh tea and snacks for your breaks', 'Main Campus', '+61 123456789', 'tea_shop.png', 1),
('Wentworth Bakery', 'Fresh baked goods daily', 'Ground floor', '+61 123456789', 'bakery.png', 1),
('Wentworth Food Court', 'Variety of food options', 'Second floor', '+61 123456789', 'foodcourt.png', 1),
('Wentworth Tiffins', 'Traditional breakfast and lunch', 'Student Hub', '+61 123456789', 'tiffins.png', 1),
('Wentworth Juice Corner', 'Fresh juices and healthy snacks', 'Student hub', '+61 123456789', 'juicecorner.png', 1);

-- Insert Sample Food Items
INSERT INTO food_items (shop_id, name, price, description, category) VALUES
-- Tea & Snacks
(1, 'Herbal Tea', 5.00, 'Assorted herbal teas', 'Beverage'),
(1, 'Chai Latte', 7.00, 'Spiced Indian tea with milk', 'Beverage'),
(1, 'Cinnamon Roll', 4.00, 'Freshly baked cinnamon roll', 'Snack'),
(1, 'Scones with Jam', 5.00, 'Traditional English scones', 'Snack'),

-- Bakery
(2, 'Cheese Sandwich', 8.00, 'Fresh cheese sandwich', 'Sandwich'),
(2, 'Egg Salad Wrap', 12.00, 'Wrap with egg salad', 'Wrap'),
(2, 'Cheese Pizza', 12.00, 'Small cheese pizza', 'Pizza'),
(2, 'French Bread', 4.00, 'Fresh French baguette', 'Bread'),

-- Food Court
(3, 'Carrot Juice', 3.50, 'Freshly squeezed carrot juice', 'Juice'),
(3, 'Mango Smoothie', 5.50, 'Creamy mango smoothie', 'Smoothie'),
(3, 'Pineapple Juice', 4.00, 'Fresh pineapple juice', 'Juice'),
(3, 'Green Juice', 5.00, 'Healthy green vegetable juice', 'Juice'),

-- Tiffins
(4, 'Dal Tadka', 8.00, 'Spiced lentil dish', 'Main'),
(4, 'Paneer Tikka', 10.00, 'Grilled cottage cheese', 'Starter'),
(4, 'Naan Bread', 3.00, 'Traditional Indian bread', 'Bread'),
(4, 'Lassi', 3.50, 'Yogurt based drink', 'Beverage'),

-- Juice Corner
(5, 'Fresh Juice', 5.00, 'Seasonal fresh juice', 'Juice'),
(5, 'Smoothie Bowl', 8.00, 'Fruit and yogurt bowl', 'Breakfast'),
(5, 'Grilled Cheese Sandwich', 7.00, 'Classic grilled cheese', 'Sandwich'),
(5, 'Veggie Burger', 8.50, 'Vegetarian burger with chips', 'Burger');