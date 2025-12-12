-- ========================================
-- Sample Data Script for 6valley E-commerce (FIXED)
-- Generated: 2025-12-12
-- Includes: Categories, Brands, Sellers, Shops, Products with Online Images
-- ========================================

-- First, let's modify table columns to support longer URLs
ALTER TABLE `brands` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `products` MODIFY `thumbnail` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `shops` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `shops` MODIFY `banner` VARCHAR(500) NOT NULL;
ALTER TABLE `shops` MODIFY `bottom_banner` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `shops` MODIFY `offer_banner` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `sellers` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `categories` MODIFY `icon` VARCHAR(500) DEFAULT NULL;

-- ========================================
-- 1. INSERT CATEGORIES
-- ========================================

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `icon_storage_type`, `parent_id`, `position`, `created_at`, `updated_at`, `home_status`, `priority`) VALUES
(1, 'Electronics', 'electronics', 'https://cdn-icons-png.flaticon.com/512/684/684908.png', 'public', 0, 0, NOW(), NOW(), 1, 1),
(2, 'Fashion', 'fashion', 'https://cdn-icons-png.flaticon.com/512/2331/2331966.png', 'public', 0, 1, NOW(), NOW(), 1, 2),
(3, 'Home & Garden', 'home-garden', 'https://cdn-icons-png.flaticon.com/512/1670/1670080.png', 'public', 0, 2, NOW(), NOW(), 1, 3),
(4, 'Sports & Outdoors', 'sports-outdoors', 'https://cdn-icons-png.flaticon.com/512/857/857418.png', 'public', 0, 3, NOW(), NOW(), 1, 4),
(5, 'Books & Media', 'books-media', 'https://cdn-icons-png.flaticon.com/512/2702/2702154.png', 'public', 0, 4, NOW(), NOW(), 1, 5),
(6, 'Smartphones', 'smartphones', NULL, 'public', 1, 0, NOW(), NOW(), 0, NULL),
(7, 'Laptops', 'laptops', NULL, 'public', 1, 1, NOW(), NOW(), 0, NULL),
(8, 'Audio & Headphones', 'audio-headphones', NULL, 'public', 1, 2, NOW(), NOW(), 0, NULL),
(9, 'Men\'s Clothing', 'mens-clothing', NULL, 'public', 2, 0, NOW(), NOW(), 0, NULL),
(10, 'Women\'s Clothing', 'womens-clothing', NULL, 'public', 2, 1, NOW(), NOW(), 0, NULL),
(11, 'Shoes', 'shoes', NULL, 'public', 2, 2, NOW(), NOW(), 0, NULL);

-- ========================================
-- 2. INSERT BRANDS
-- ========================================

INSERT INTO `brands` (`id`, `name`, `image`, `image_storage_type`, `image_alt_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'https://logos-world.net/wp-content/uploads/2020/04/Apple-Logo.png', 'public', 'Apple Brand Logo', 1, NOW(), NOW()),
(2, 'Samsung', 'https://logos-world.net/wp-content/uploads/2020/04/Samsung-Logo.png', 'public', 'Samsung Brand Logo', 1, NOW(), NOW()),
(3, 'Sony', 'https://logos-world.net/wp-content/uploads/2020/04/Sony-Logo.png', 'public', 'Sony Brand Logo', 1, NOW(), NOW()),
(4, 'Nike', 'https://logos-world.net/wp-content/uploads/2020/04/Nike-Logo.png', 'public', 'Nike Brand Logo', 1, NOW(), NOW()),
(5, 'Adidas', 'https://logos-world.net/wp-content/uploads/2020/04/Adidas-Logo.png', 'public', 'Adidas Brand Logo', 1, NOW(), NOW()),
(6, 'Dell', 'https://logos-world.net/wp-content/uploads/2020/06/Dell-Logo.png', 'public', 'Dell Brand Logo', 1, NOW(), NOW()),
(7, 'HP', 'https://logos-world.net/wp-content/uploads/2020/09/HP-Logo.png', 'public', 'HP Brand Logo', 1, NOW(), NOW()),
(8, 'Bose', 'https://logos-world.net/wp-content/uploads/2021/03/Bose-Logo.png', 'public', 'Bose Brand Logo', 1, NOW(), NOW()),
(9, 'LG', 'https://logos-world.net/wp-content/uploads/2020/05/LG-Logo.png', 'public', 'LG Brand Logo', 1, NOW(), NOW()),
(10, 'Canon', 'https://logos-world.net/wp-content/uploads/2020/11/Canon-Logo.png', 'public', 'Canon Brand Logo', 1, NOW(), NOW());

-- ========================================
-- 3. INSERT SELLERS (Vendors)
-- ========================================

INSERT INTO `sellers` (`id`, `f_name`, `l_name`, `phone`, `image`, `email`, `password`, `status`, `created_at`, `updated_at`, `bank_name`, `branch`, `account_no`, `holder_name`, `sales_commission_percentage`, `pos_status`, `minimum_order_amount`, `free_delivery_status`, `free_delivery_over_amount`) VALUES
(1, 'TechWorld', 'Electronics', '+1-555-0101', 'https://ui-avatars.com/api/?name=TechWorld&size=200&background=0D8ABC&color=fff', 'techworld@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Bank of America', 'New York', '1234567890', 'TechWorld LLC', 10.00, 1, 25.00, 1, 100.00),
(2, 'Fashion', 'Hub', '+1-555-0102', 'https://ui-avatars.com/api/?name=Fashion+Hub&size=200&background=FF6B6B&color=fff', 'fashionhub@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Chase Bank', 'Los Angeles', '2345678901', 'Fashion Hub Inc', 12.00, 1, 20.00, 1, 75.00),
(3, 'Sports', 'Arena', '+1-555-0103', 'https://ui-avatars.com/api/?name=Sports+Arena&size=200&background=4ECDC4&color=fff', 'sportsarena@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Wells Fargo', 'Chicago', '3456789012', 'Sports Arena Corp', 8.00, 1, 30.00, 1, 120.00),
(4, 'Premium', 'Gadgets', '+1-555-0104', 'https://ui-avatars.com/api/?name=Premium+Gadgets&size=200&background=95E1D3&color=000', 'premiumgadgets@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Citibank', 'San Francisco', '4567890123', 'Premium Gadgets Ltd', 15.00, 1, 50.00, 1, 150.00),
(5, 'Home', 'Comfort', '+1-555-0105', 'https://ui-avatars.com/api/?name=Home+Comfort&size=200&background=F38181&color=fff', 'homecomfort@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'US Bank', 'Seattle', '5678901234', 'Home Comfort LLC', 10.00, 1, 35.00, 1, 90.00);

-- ========================================
-- 4. INSERT SHOPS
-- ========================================

INSERT INTO `shops` (`id`, `seller_id`, `name`, `slug`, `address`, `contact`, `image`, `image_storage_type`, `bottom_banner`, `bottom_banner_storage_type`, `banner`, `banner_storage_type`, `vacation_status`, `temporary_close`, `created_at`, `updated_at`) VALUES
(1, 1, 'TechWorld Electronics', 'techworld-electronics', '123 Tech Street, Silicon Valley, CA 94025', '+1-555-0101', 'https://images.unsplash.com/photo-1491933382434-500287f9b54b?w=400', 'public', 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=1200', 'public', 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=1200', 'public', 0, 0, NOW(), NOW()),
(2, 2, 'Fashion Hub Store', 'fashion-hub-store', '456 Fashion Ave, New York, NY 10001', '+1-555-0102', 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400', 'public', 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200', 'public', 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200', 'public', 0, 0, NOW(), NOW()),
(3, 3, 'Sports Arena Pro', 'sports-arena-pro', '789 Athletic Blvd, Chicago, IL 60601', '+1-555-0103', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=400', 'public', 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=1200', 'public', 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=1200', 'public', 0, 0, NOW(), NOW()),
(4, 4, 'Premium Gadgets Shop', 'premium-gadgets-shop', '321 Innovation Dr, San Francisco, CA 94102', '+1-555-0104', 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=400', 'public', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200', 'public', 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=1200', 'public', 0, 0, NOW(), NOW()),
(5, 5, 'Home Comfort Depot', 'home-comfort-depot', '654 Lifestyle Lane, Seattle, WA 98101', '+1-555-0105', 'https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?w=400', 'public', 'https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=1200', 'public', 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=1200', 'public', 0, 0, NOW(), NOW());

-- ========================================
-- 5. INSERT PRODUCTS - Electronics
-- ========================================

INSERT INTO `products` (`id`, `added_by`, `user_id`, `name`, `slug`, `product_type`, `category_id`, `sub_category_id`, `brand_id`, `unit`, `min_qty`, `refundable`, `images`, `thumbnail`, `thumbnail_storage_type`, `featured`, `colors`, `variant_product`, `published`, `unit_price`, `purchase_price`, `tax`, `tax_type`, `discount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `status`, `created_at`, `updated_at`, `code`) VALUES

-- iPhone 15 Pro
(1, 'seller', 1, 'iPhone 15 Pro 256GB', 'iphone-15-pro-256gb', 'physical', '6', '1', 1, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=800\",\"https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=800\",\"https://images.unsplash.com/photo-1678652197831-2d180705cd2c?w=800\"]',
'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500', 'public', '1',
'[\"#1C1C1E\",\"#F5F5DC\",\"#4A5568\"]', 0, 1, 1199.00, 950.00, '10', 'percent', '50', 'flat', 45, 1,
'<p>The iPhone 15 Pro features a strong and light titanium design with a textured matte glass back. It also features the Action button, a new way to quickly access useful features. It has the powerful A17 Pro chip and pro camera system with 48MP main camera.</p><ul><li>6.1-inch Super Retina XDR display</li><li>A17 Pro chip with 6-core GPU</li><li>Pro camera system: 48MP Main, 12MP Ultra Wide, 12MP 2x Telephoto</li><li>Up to 29 hours video playback</li></ul>',
1, NOW(), NOW(), 'PHONE-001'),

-- Samsung Galaxy S24
(2, 'seller', 1, 'Samsung Galaxy S24 Ultra 512GB', 'samsung-galaxy-s24-ultra-512gb', 'physical', '6', '1', 2, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=800\",\"https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800\"]',
'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=500', 'public', '1',
'[\"#000000\",\"#E5E5EA\",\"#8E44AD\"]', 0, 1, 1299.00, 1050.00, '10', 'percent', '100', 'flat', 38, 1,
'<p>Meet Galaxy S24 Ultra, the ultimate form of Galaxy Ultra with a new titanium exterior and a 17.25cm (6.8") flat display. It\'s an absolute marvel of design.</p><ul><li>6.8-inch Dynamic AMOLED 2X display</li><li>Snapdragon 8 Gen 3 for Galaxy</li><li>200MP Wide camera with AI Zoom</li><li>Built-in S Pen</li><li>5000mAh battery</li></ul>',
1, NOW(), NOW(), 'PHONE-002'),

-- MacBook Pro
(3, 'seller', 4, 'MacBook Pro 16" M3 Max', 'macbook-pro-16-m3-max', 'physical', '7', '1', 1, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800\",\"https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=800\"]',
'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500', 'public', '1',
'[\"#2C3E50\",\"#ECF0F1\"]', 0, 1, 2499.00, 2100.00, '10', 'percent', '0', 'flat', 22, 1,
'<p>The most powerful MacBook Pro ever. With the M3 Max chip, stunning Liquid Retina XDR display, and all-day battery life.</p><ul><li>16.2-inch Liquid Retina XDR display</li><li>Apple M3 Max chip with 16-core CPU</li><li>Up to 128GB unified memory</li><li>Up to 22 hours battery life</li><li>Three Thunderbolt 4 ports, HDMI, SDXC card slot</li></ul>',
1, NOW(), NOW(), 'LAPTOP-001'),

-- Dell XPS 15
(4, 'seller', 4, 'Dell XPS 15 9530 OLED Laptop', 'dell-xps-15-9530-oled', 'physical', '7', '1', 6, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=800\",\"https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=800\"]',
'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500', 'public', '0',
'[\"#34495E\",\"#95A5A6\"]', 0, 1, 1899.00, 1550.00, '10', 'percent', '100', 'flat', 18, 1,
'<p>Designed with a stunning OLED display and powerful Intel processors, the Dell XPS 15 is perfect for creators and professionals.</p><ul><li>15.6-inch 3.5K OLED InfinityEdge display</li><li>13th Gen Intel Core i7 processor</li><li>32GB DDR5 RAM, 1TB SSD</li><li>NVIDIA GeForce RTX 4050</li><li>Premium machined aluminum chassis</li></ul>',
1, NOW(), NOW(), 'LAPTOP-002'),

-- Sony WH-1000XM5
(5, 'seller', 4, 'Sony WH-1000XM5 Wireless Headphones', 'sony-wh-1000xm5-wireless', 'physical', '8', '1', 3, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800\",\"https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800\"]',
'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500', 'public', '1',
'[\"#000000\",\"#ECF0F1\"]', 0, 1, 399.00, 320.00, '5', 'percent', '20', 'flat', 65, 1,
'<p>Industry-leading noise cancellation with two processors controlling 8 microphones. Up to 30-hour battery life with quick charging.</p><ul><li>Industry-leading noise canceling</li><li>Magnificent sound quality</li><li>Crystal clear hands-free calling</li><li>Up to 30-hour battery life</li><li>Multipoint connection</li></ul>',
1, NOW(), NOW(), 'AUDIO-001'),

-- Bose QuietComfort
(6, 'seller', 4, 'Bose QuietComfort Ultra Headphones', 'bose-quietcomfort-ultra', 'physical', '8', '1', 8, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800\",\"https://images.unsplash.com/photo-1491927570842-0261e477d937?w=800\"]',
'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500', 'public', '0',
'[\"#000000\",\"#FFFFFF\",\"#34495E\"]', 0, 1, 429.00, 350.00, '5', 'percent', '0', 'flat', 42, 1,
'<p>Breakthrough spatialized audio for more immersive listening. World-class noise cancellation. Elevated design and luxe materials.</p><ul><li>Bose Immersive Audio</li><li>World-class noise cancellation</li><li>Up to 24 hours battery life</li><li>Premium comfort with soft ear cushions</li><li>CustomTune technology</li></ul>',
1, NOW(), NOW(), 'AUDIO-002');

-- ========================================
-- 6. INSERT PRODUCTS - Fashion
-- ========================================

INSERT INTO `products` (`id`, `added_by`, `user_id`, `name`, `slug`, `product_type`, `category_id`, `sub_category_id`, `brand_id`, `unit`, `min_qty`, `refundable`, `images`, `thumbnail`, `thumbnail_storage_type`, `featured`, `colors`, `variant_product`, `published`, `unit_price`, `purchase_price`, `tax`, `tax_type`, `discount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `status`, `created_at`, `updated_at`, `code`) VALUES

-- Nike Air Max
(7, 'seller', 2, 'Nike Air Max 270 Men\'s Shoes', 'nike-air-max-270-mens', 'physical', '11', '2', 4, 'pair', 1, 1,
'[\"https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800\",\"https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=800\"]',
'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\",\"#3498DB\"]', 0, 1, 149.99, 90.00, '8', 'percent', '15', 'flat', 125, 1,
'<p>Nike\'s first lifestyle Air Max brings you style, comfort and big attitude. The design draws inspiration from the 180 and 93, and brings it into the future with its large Air unit and bold design.</p><ul><li>Max Air unit for ultimate cushioning</li><li>Mesh upper for breathability</li><li>Rubber outsole for durable traction</li><li>Visible Air Max cushioning</li></ul>',
1, NOW(), NOW(), 'SHOE-001'),

-- Adidas Ultraboost
(8, 'seller', 2, 'Adidas Ultraboost 23 Running Shoes', 'adidas-ultraboost-23', 'physical', '11', '2', 5, 'pair', 1, 1,
'[\"https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=800\",\"https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?w=800\"]',
'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\",\"#E74C3C\"]', 0, 1, 189.99, 120.00, '8', 'percent', '20', 'flat', 98, 1,
'<p>The Adidas Ultraboost 23 delivers unparalleled energy return and comfort with its Boost midsole technology. Perfect for runners seeking maximum performance.</p><ul><li>Boost midsole for energy return</li><li>Primeknit+ upper for adaptive fit</li><li>Continental rubber outsole</li><li>Torsion System for stability</li></ul>',
1, NOW(), NOW(), 'SHOE-002'),

-- Men's T-Shirt
(9, 'seller', 2, 'Nike Dri-FIT Men\'s Training T-Shirt', 'nike-dri-fit-mens-tshirt', 'physical', '9', '2', 4, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800\",\"https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800\"]',
'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500', 'public', '0',
'[\"#000000\",\"#FFFFFF\",\"#3498DB\",\"#E74C3C\"]', 0, 1, 29.99, 15.00, '5', 'percent', '5', 'flat', 250, 1,
'<p>Stay cool and comfortable during your workout with Nike Dri-FIT technology. This classic fit t-shirt is designed to move with you.</p><ul><li>Dri-FIT technology wicks sweat</li><li>Soft, lightweight fabric</li><li>Classic fit for unrestricted movement</li><li>Ribbed crew neck</li></ul>',
1, NOW(), NOW(), 'CLOTH-001'),

-- Women's Dress
(10, 'seller', 2, 'Elegant Summer Maxi Dress', 'elegant-summer-maxi-dress', 'physical', '10', '2', NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800\",\"https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800\"]',
'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=500', 'public', '1',
'[\"#E74C3C\",\"#3498DB\",\"#2ECC71\",\"#F39C12\"]', 0, 1, 79.99, 40.00, '5', 'percent', '10', 'flat', 145, 1,
'<p>Beautiful flowing maxi dress perfect for summer occasions. Features elegant design with comfortable breathable fabric.</p><ul><li>Lightweight breathable fabric</li><li>Adjustable straps</li><li>Side pockets</li><li>Flowy maxi length</li><li>Machine washable</li></ul>',
1, NOW(), NOW(), 'CLOTH-002');

-- ========================================
-- 7. INSERT PRODUCTS - Sports & Home
-- ========================================

INSERT INTO `products` (`id`, `added_by`, `user_id`, `name`, `slug`, `product_type`, `category_id`, `sub_category_id`, `brand_id`, `unit`, `min_qty`, `refundable`, `images`, `thumbnail`, `thumbnail_storage_type`, `featured`, `colors`, `variant_product`, `published`, `unit_price`, `purchase_price`, `tax`, `tax_type`, `discount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `status`, `created_at`, `updated_at`, `code`) VALUES

-- Yoga Mat
(11, 'seller', 3, 'Premium Non-Slip Yoga Mat', 'premium-non-slip-yoga-mat', 'physical', '4', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=800\",\"https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800\"]',
'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=500', 'public', '0',
'[\"#9B59B6\",\"#3498DB\",\"#E91E63\",\"#000000\"]', 0, 1, 39.99, 20.00, '5', 'percent', '5', 'flat', 180, 1,
'<p>High-quality yoga mat with superior grip and cushioning. Perfect for yoga, pilates, and fitness exercises.</p><ul><li>6mm thick for comfort</li><li>Non-slip texture on both sides</li><li>Eco-friendly TPE material</li><li>Includes carrying strap</li><li>Easy to clean</li></ul>',
1, NOW(), NOW(), 'SPORT-001'),

-- Dumbbells Set
(12, 'seller', 3, 'Adjustable Dumbbell Set 50lbs', 'adjustable-dumbbell-set-50lbs', 'physical', '4', NULL, NULL, 'set', 1, 1,
'[\"https://images.unsplash.com/photo-1638376018657-d1aa68c8264e?w=800\",\"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800\"]',
'https://images.unsplash.com/photo-1638376018657-d1aa68c8264e?w=500', 'public', '1',
'[\"#34495E\"]', 0, 1, 299.99, 180.00, '8', 'percent', '50', 'flat', 55, 1,
'<p>Space-saving adjustable dumbbell set that replaces 15 sets of weights. Perfect for home gym enthusiasts.</p><ul><li>Adjustable from 5 to 50 lbs</li><li>Durable cast iron construction</li><li>Compact storage tray</li><li>Easy weight adjustment</li><li>Anti-slip grip handles</li></ul>',
1, NOW(), NOW(), 'SPORT-002'),

-- Smart Coffee Maker
(13, 'seller', 5, 'Smart WiFi Coffee Maker with Grinder', 'smart-wifi-coffee-maker', 'physical', '3', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=800\",\"https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800\"]',
'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500', 'public', '1',
'[\"#2C3E50\",\"#95A5A6\"]', 0, 1, 249.99, 150.00, '8', 'percent', '30', 'flat', 72, 1,
'<p>Advanced coffee maker with built-in grinder and WiFi connectivity. Schedule your coffee from your smartphone.</p><ul><li>Built-in burr grinder</li><li>WiFi and app control</li><li>12-cup thermal carafe</li><li>Programmable brew strength</li><li>Auto-clean function</li></ul>',
1, NOW(), NOW(), 'HOME-001'),

-- Air Purifier
(14, 'seller', 5, 'LG PuriCare 360° Air Purifier', 'lg-puricare-360-air-purifier', 'physical', '3', NULL, 9, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=800\",\"https://images.unsplash.com/photo-1605428894732-f20264cdbd9e?w=800\"]',
'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=500', 'public', '0',
'[\"#FFFFFF\",\"#34495E\"]', 0, 1, 399.99, 280.00, '10', 'percent', '0', 'flat', 38, 1,
'<p>Advanced air purification system with 360-degree filtration. Perfect for large rooms up to 550 sq ft.</p><ul><li>360-degree air intake and outlet</li><li>HEPA 13 filter removes 99.97% particles</li><li>Smart air quality sensor</li><li>WiFi connectivity and app control</li><li>Ultra-quiet operation</li></ul>',
1, NOW(), NOW(), 'HOME-002'),

-- Robot Vacuum
(15, 'seller', 5, 'Smart Robot Vacuum with Mapping', 'smart-robot-vacuum-mapping', 'physical', '3', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1558317374-067fb5f30001?w=800\",\"https://images.unsplash.com/photo-1631735977088-82c6f1f74f5f?w=800\"]',
'https://images.unsplash.com/photo-1558317374-067fb5f30001?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\"]', 0, 1, 449.99, 300.00, '10', 'percent', '50', 'flat', 64, 1,
'<p>Intelligent robot vacuum with laser mapping and zone cleaning. Features both vacuuming and mopping capabilities.</p><ul><li>LiDAR navigation and mapping</li><li>2-in-1 vacuum and mop</li><li>4000Pa strong suction</li><li>App control and scheduling</li><li>Auto-empty dock compatible</li><li>Up to 180 min runtime</li></ul>',
1, NOW(), NOW(), 'HOME-003');

-- ========================================
-- 8. INSERT SELLER WALLETS
-- ========================================

INSERT INTO `seller_wallets` (`id`, `seller_id`, `total_earning`, `withdrawn`, `created_at`, `updated_at`, `commission_given`, `pending_withdraw`, `delivery_charge_earned`, `collected_cash`, `total_tax_collected`) VALUES
(1, 1, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(2, 2, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 3, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 4, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(5, 5, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00);

-- ========================================
-- END OF SAMPLE DATA
-- ========================================
