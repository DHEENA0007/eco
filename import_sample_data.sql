-- ========================================
-- Sample Data Import Script for 6valley E-commerce
-- Generated: 2025-12-12
-- Skips categories (already exist)
-- Adds: Brands, Sellers, Shops, Products with Online Images
-- ========================================

-- First, modify table columns to support longer URLs
ALTER TABLE `brands` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `products` MODIFY `thumbnail` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `shops` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `shops` MODIFY `banner` VARCHAR(500) NOT NULL;
ALTER TABLE `shops` MODIFY `bottom_banner` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `shops` MODIFY `offer_banner` VARCHAR(500) DEFAULT NULL;
ALTER TABLE `sellers` MODIFY `image` VARCHAR(500) NOT NULL DEFAULT 'def.png';
ALTER TABLE `categories` MODIFY `icon` VARCHAR(500) DEFAULT NULL;

-- ========================================
-- 1. INSERT BRANDS
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
-- 2. INSERT SELLERS (Vendors)
-- ========================================

INSERT INTO `sellers` (`id`, `f_name`, `l_name`, `phone`, `image`, `email`, `password`, `status`, `created_at`, `updated_at`, `bank_name`, `branch`, `account_no`, `holder_name`, `sales_commission_percentage`, `pos_status`, `minimum_order_amount`, `free_delivery_status`, `free_delivery_over_amount`) VALUES
(1, 'TechWorld', 'Electronics', '+1-555-0101', 'https://ui-avatars.com/api/?name=TechWorld&size=200&background=0D8ABC&color=fff', 'techworld@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Bank of America', 'New York', '1234567890', 'TechWorld LLC', 10.00, 1, 25.00, 1, 100.00),
(2, 'Fashion', 'Hub', '+1-555-0102', 'https://ui-avatars.com/api/?name=Fashion+Hub&size=200&background=FF6B6B&color=fff', 'fashionhub@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Chase Bank', 'Los Angeles', '2345678901', 'Fashion Hub Inc', 12.00, 1, 20.00, 1, 75.00),
(3, 'Sports', 'Arena', '+1-555-0103', 'https://ui-avatars.com/api/?name=Sports+Arena&size=200&background=4ECDC4&color=fff', 'sportsarena@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Wells Fargo', 'Chicago', '3456789012', 'Sports Arena Corp', 8.00, 1, 30.00, 1, 120.00),
(4, 'Premium', 'Gadgets', '+1-555-0104', 'https://ui-avatars.com/api/?name=Premium+Gadgets&size=200&background=95E1D3&color=000', 'premiumgadgets@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'Citibank', 'San Francisco', '4567890123', 'Premium Gadgets Ltd', 15.00, 1, 50.00, 1, 150.00),
(5, 'Home', 'Comfort', '+1-555-0105', 'https://ui-avatars.com/api/?name=Home+Comfort&size=200&background=F38181&color=fff', 'homecomfort@example.com', '$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.', 'approved', NOW(), NOW(), 'US Bank', 'Seattle', '5678901234', 'Home Comfort LLC', 10.00, 1, 35.00, 1, 90.00);

-- ========================================
-- 3. INSERT SHOPS
-- ========================================

INSERT INTO `shops` (`id`, `seller_id`, `name`, `slug`, `address`, `contact`, `image`, `image_storage_type`, `bottom_banner`, `bottom_banner_storage_type`, `banner`, `banner_storage_type`, `vacation_status`, `temporary_close`, `created_at`, `updated_at`) VALUES
(1, 1, 'TechWorld Electronics', 'techworld-electronics', '123 Tech Street, Silicon Valley, CA 94025', '+1-555-0101', 'https://images.unsplash.com/photo-1491933382434-500287f9b54b?w=400', 'public', 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=1200', 'public', 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=1200', 'public', 0, 0, NOW(), NOW()),
(2, 2, 'Fashion Hub Store', 'fashion-hub-store', '456 Fashion Ave, New York, NY 10001', '+1-555-0102', 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400', 'public', 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200', 'public', 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200', 'public', 0, 0, NOW(), NOW()),
(3, 3, 'Sports Arena Pro', 'sports-arena-pro', '789 Athletic Blvd, Chicago, IL 60601', '+1-555-0103', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=400', 'public', 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=1200', 'public', 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=1200', 'public', 0, 0, NOW(), NOW()),
(4, 4, 'Premium Gadgets Shop', 'premium-gadgets-shop', '321 Innovation Dr, San Francisco, CA 94102', '+1-555-0104', 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=400', 'public', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200', 'public', 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=1200', 'public', 0, 0, NOW(), NOW()),
(5, 5, 'Home Comfort Depot', 'home-comfort-depot', '654 Lifestyle Lane, Seattle, WA 98101', '+1-555-0105', 'https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?w=400', 'public', 'https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=1200', 'public', 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=1200', 'public', 0, 0, NOW(), NOW());

-- ========================================
-- 4. INSERT PRODUCTS - Electronics
-- ========================================

INSERT INTO `products` (`id`, `added_by`, `user_id`, `name`, `slug`, `product_type`, `category_id`, `sub_category_id`, `brand_id`, `unit`, `min_qty`, `refundable`, `images`, `color_image`, `thumbnail`, `thumbnail_storage_type`, `featured`, `colors`, `variant_product`, `published`, `unit_price`, `purchase_price`, `tax`, `tax_type`, `discount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `status`, `created_at`, `updated_at`, `code`) VALUES

(1, 'seller', 1, 'iPhone 15 Pro 256GB', 'iphone-15-pro-256gb', 'physical', '6', '1', 1, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=800\",\"https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=800\"]',
'[]',
'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500', 'public', '1',
'[\"#1C1C1E\",\"#F5F5DC\",\"#4A5568\"]', 0, 1, 1199.00, 950.00, '10', 'percent', '50', 'flat', 45, 1,
'<p>The iPhone 15 Pro features titanium design with A17 Pro chip and 48MP camera system.</p>', 1, NOW(), NOW(), 'PHONE-001'),

(2, 'seller', 1, 'Samsung Galaxy S24 Ultra 512GB', 'samsung-galaxy-s24-ultra-512gb', 'physical', '6', '1', 2, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=800\",\"https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800\"]',
'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=500', 'public', '1',
'[\"#000000\",\"#E5E5EA\",\"#8E44AD\"]', 0, 1, 1299.00, 1050.00, '10', 'percent', '100', 'flat', 38, 1,
'<p>Galaxy S24 Ultra with titanium exterior, 200MP camera, and built-in S Pen.</p>', 1, NOW(), NOW(), 'PHONE-002'),

(3, 'seller', 4, 'MacBook Pro 16" M3 Max', 'macbook-pro-16-m3-max', 'physical', '7', '1', 1, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800\",\"https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=800\"]',
'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500', 'public', '1',
'[\"#2C3E50\",\"#ECF0F1\"]', 0, 1, 2499.00, 2100.00, '10', 'percent', '0', 'flat', 22, 1,
'<p>Most powerful MacBook Pro with M3 Max chip and Liquid Retina XDR display.</p>', 1, NOW(), NOW(), 'LAPTOP-001'),

(4, 'seller', 4, 'Dell XPS 15 9530 OLED Laptop', 'dell-xps-15-9530-oled', 'physical', '7', '1', 6, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=800\",\"https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=800\"]',
'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500', 'public', '0',
'[\"#34495E\",\"#95A5A6\"]', 0, 1, 1899.00, 1550.00, '10', 'percent', '100', 'flat', 18, 1,
'<p>Dell XPS 15 with stunning 3.5K OLED display and Intel Core i7 processor.</p>', 1, NOW(), NOW(), 'LAPTOP-002'),

(5, 'seller', 4, 'Sony WH-1000XM5 Wireless Headphones', 'sony-wh-1000xm5-wireless', 'physical', '8', '1', 3, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800\",\"https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800\"]',
'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500', 'public', '1',
'[\"#000000\",\"#ECF0F1\"]', 0, 1, 399.00, 320.00, '5', 'percent', '20', 'flat', 65, 1,
'<p>Industry-leading noise cancellation with 30-hour battery life.</p>', 1, NOW(), NOW(), 'AUDIO-001'),

(6, 'seller', 4, 'Bose QuietComfort Ultra Headphones', 'bose-quietcomfort-ultra', 'physical', '8', '1', 8, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800\",\"https://images.unsplash.com/photo-1491927570842-0261e477d937?w=800\"]',
'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500', 'public', '0',
'[\"#000000\",\"#FFFFFF\",\"#34495E\"]', 0, 1, 429.00, 350.00, '5', 'percent', '0', 'flat', 42, 1,
'<p>Bose Immersive Audio with world-class noise cancellation.</p>', 1, NOW(), NOW(), 'AUDIO-002'),

(7, 'seller', 2, 'Nike Air Max 270 Men\'s Shoes', 'nike-air-max-270-mens', 'physical', '11', '2', 4, 'pair', 1, 1,
'[\"https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800\",\"https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=800\"]',
'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\",\"#3498DB\"]', 0, 1, 149.99, 90.00, '8', 'percent', '15', 'flat', 125, 1,
'<p>Nike Air Max 270 with maximum cushioning and bold design.</p>', 1, NOW(), NOW(), 'SHOE-001'),

(8, 'seller', 2, 'Adidas Ultraboost 23 Running Shoes', 'adidas-ultraboost-23', 'physical', '11', '2', 5, 'pair', 1, 1,
'[\"https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=800\",\"https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?w=800\"]',
'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\",\"#E74C3C\"]', 0, 1, 189.99, 120.00, '8', 'percent', '20', 'flat', 98, 1,
'<p>Adidas Ultraboost 23 with energy-returning Boost technology.</p>', 1, NOW(), NOW(), 'SHOE-002'),

(9, 'seller', 2, 'Nike Dri-FIT Men\'s Training T-Shirt', 'nike-dri-fit-mens-tshirt', 'physical', '9', '2', 4, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800\",\"https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800\"]',
'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500', 'public', '0',
'[\"#000000\",\"#FFFFFF\",\"#3498DB\",\"#E74C3C\"]', 0, 1, 29.99, 15.00, '5', 'percent', '5', 'flat', 250, 1,
'<p>Nike Dri-FIT technology wicks sweat for comfort during workouts.</p>', 1, NOW(), NOW(), 'CLOTH-001'),

(10, 'seller', 2, 'Elegant Summer Maxi Dress', 'elegant-summer-maxi-dress', 'physical', '10', '2', NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800\",\"https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800\"]',
'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=500', 'public', '1',
'[\"#E74C3C\",\"#3498DB\",\"#2ECC71\",\"#F39C12\"]', 0, 1, 79.99, 40.00, '5', 'percent', '10', 'flat', 145, 1,
'<p>Beautiful flowing maxi dress perfect for summer with breathable fabric.</p>', 1, NOW(), NOW(), 'CLOTH-002'),

(11, 'seller', 3, 'Premium Non-Slip Yoga Mat', 'premium-non-slip-yoga-mat', 'physical', '4', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=800\",\"https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800\"]',
'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=500', 'public', '0',
'[\"#9B59B6\",\"#3498DB\",\"#E91E63\",\"#000000\"]', 0, 1, 39.99, 20.00, '5', 'percent', '5', 'flat', 180, 1,
'<p>High-quality yoga mat with superior grip and 6mm cushioning.</p>', 1, NOW(), NOW(), 'SPORT-001'),

(12, 'seller', 3, 'Adjustable Dumbbell Set 50lbs', 'adjustable-dumbbell-set-50lbs', 'physical', '4', NULL, NULL, 'set', 1, 1,
'[\"https://images.unsplash.com/photo-1638376018657-d1aa68c8264e?w=800\",\"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800\"]',
'https://images.unsplash.com/photo-1638376018657-d1aa68c8264e?w=500', 'public', '1',
'[\"#34495E\"]', 0, 1, 299.99, 180.00, '8', 'percent', '50', 'flat', 55, 1,
'<p>Space-saving adjustable dumbbells from 5 to 50 lbs.</p>', 1, NOW(), NOW(), 'SPORT-002'),

(13, 'seller', 5, 'Smart WiFi Coffee Maker with Grinder', 'smart-wifi-coffee-maker', 'physical', '3', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=800\",\"https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800\"]',
'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500', 'public', '1',
'[\"#2C3E50\",\"#95A5A6\"]', 0, 1, 249.99, 150.00, '8', 'percent', '30', 'flat', 72, 1,
'<p>Smart coffee maker with built-in grinder and WiFi app control.</p>', 1, NOW(), NOW(), 'HOME-001'),

(14, 'seller', 5, 'LG PuriCare 360° Air Purifier', 'lg-puricare-360-air-purifier', 'physical', '3', NULL, 9, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=800\",\"https://images.unsplash.com/photo-1605428894732-f20264cdbd9e?w=800\"]',
'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=500', 'public', '0',
'[\"#FFFFFF\",\"#34495E\"]', 0, 1, 399.99, 280.00, '10', 'percent', '0', 'flat', 38, 1,
'<p>LG PuriCare with 360-degree filtration and HEPA 13 filter.</p>', 1, NOW(), NOW(), 'HOME-002'),

(15, 'seller', 5, 'Smart Robot Vacuum with Mapping', 'smart-robot-vacuum-mapping', 'physical', '3', NULL, NULL, 'pc', 1, 1,
'[\"https://images.unsplash.com/photo-1558317374-067fb5f30001?w=800\",\"https://images.unsplash.com/photo-1631735977088-82c6f1f74f5f?w=800\"]',
'https://images.unsplash.com/photo-1558317374-067fb5f30001?w=500', 'public', '1',
'[\"#000000\",\"#FFFFFF\"]', 0, 1, 449.99, 300.00, '10', 'percent', '50', 'flat', 64, 1,
'<p>Smart robot vacuum with LiDAR mapping and 2-in-1 vacuum and mop.</p>', 1, NOW(), NOW(), 'HOME-003');

-- ========================================
-- 5. INSERT SELLER WALLETS
-- ========================================

INSERT INTO `seller_wallets` (`id`, `seller_id`, `total_earning`, `withdrawn`, `created_at`, `updated_at`, `commission_given`, `pending_withdraw`, `delivery_charge_earned`, `collected_cash`, `total_tax_collected`) VALUES
(1, 1, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(2, 2, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 3, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 4, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00),
(5, 5, 0, 0, NOW(), NOW(), 0.00, 0.00, 0.00, 0.00, 0.00);

-- ========================================
-- DATA IMPORT COMPLETE!
-- ========================================
-- Summary:
-- ✓ 10 Brands
-- ✓ 5 Sellers (Vendors)
-- ✓ 5 Shops
-- ✓ 15 Products
-- ✓ 5 Seller Wallets
-- ========================================
