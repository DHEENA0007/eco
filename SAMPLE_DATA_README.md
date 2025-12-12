# Sample Data Documentation

## Overview
This sample data script populates your 6valley e-commerce database with realistic product data, including online images for products, brands, vendors, and shops.

## How to Import

### Method 1: Command Line
```bash
mysql -u your_username -p your_database_name < sample_data.sql
```

### Method 2: phpMyAdmin
1. Open phpMyAdmin
2. Select your database
3. Go to "Import" tab
4. Choose `sample_data.sql`
5. Click "Go"

### Method 3: Direct SQL Execution
Copy and paste the contents of `sample_data.sql` into your MySQL/phpMyAdmin SQL tab and execute.

## What's Included

### 📦 Categories (11 total)
**Main Categories (5):**
1. Electronics
2. Fashion
3. Home & Garden
4. Sports & Outdoors
5. Books & Media

**Sub-Categories (6):**
- Smartphones (under Electronics)
- Laptops (under Electronics)
- Audio & Headphones (under Electronics)
- Men's Clothing (under Fashion)
- Women's Clothing (under Fashion)
- Shoes (under Fashion)

### 🏷️ Brands (10 total)
1. **Apple** - Premium electronics
2. **Samsung** - Smartphones and electronics
3. **Sony** - Audio and electronics
4. **Nike** - Sports and fashion
5. **Adidas** - Sports and fashion
6. **Dell** - Computers and laptops
7. **HP** - Computers and electronics
8. **Bose** - Premium audio
9. **LG** - Home appliances
10. **Canon** - Cameras and imaging

### 🏪 Vendors/Sellers (5 total)
1. **TechWorld Electronics**
   - Focus: Electronics and gadgets
   - Commission: 10%
   - Free delivery over $100

2. **Fashion Hub**
   - Focus: Clothing and fashion
   - Commission: 12%
   - Free delivery over $75

3. **Sports Arena**
   - Focus: Sports equipment
   - Commission: 8%
   - Free delivery over $120

4. **Premium Gadgets**
   - Focus: High-end electronics
   - Commission: 15%
   - Free delivery over $150

5. **Home Comfort**
   - Focus: Home appliances
   - Commission: 10%
   - Free delivery over $90

### 🛍️ Products (15 total)

#### Electronics (6 products)
1. **iPhone 15 Pro 256GB** - $1,199 (discount: $50)
   - Brand: Apple
   - Stock: 45 units

2. **Samsung Galaxy S24 Ultra 512GB** - $1,299 (discount: $100)
   - Brand: Samsung
   - Stock: 38 units

3. **MacBook Pro 16" M3 Max** - $2,499
   - Brand: Apple
   - Stock: 22 units

4. **Dell XPS 15 9530 OLED** - $1,899 (discount: $100)
   - Brand: Dell
   - Stock: 18 units

5. **Sony WH-1000XM5 Headphones** - $399 (discount: $20)
   - Brand: Sony
   - Stock: 65 units

6. **Bose QuietComfort Ultra** - $429
   - Brand: Bose
   - Stock: 42 units

#### Fashion (4 products)
7. **Nike Air Max 270 Men's Shoes** - $149.99 (discount: $15)
   - Brand: Nike
   - Stock: 125 units

8. **Adidas Ultraboost 23** - $189.99 (discount: $20)
   - Brand: Adidas
   - Stock: 98 units

9. **Nike Dri-FIT Men's T-Shirt** - $29.99 (discount: $5)
   - Brand: Nike
   - Stock: 250 units

10. **Elegant Summer Maxi Dress** - $79.99 (discount: $10)
    - Stock: 145 units

#### Sports & Home (5 products)
11. **Premium Non-Slip Yoga Mat** - $39.99 (discount: $5)
    - Stock: 180 units

12. **Adjustable Dumbbell Set 50lbs** - $299.99 (discount: $50)
    - Stock: 55 units

13. **Smart WiFi Coffee Maker** - $249.99 (discount: $30)
    - Stock: 72 units

14. **LG PuriCare 360° Air Purifier** - $399.99
    - Brand: LG
    - Stock: 38 units

15. **Smart Robot Vacuum** - $449.99 (discount: $50)
    - Stock: 64 units

## Image Sources

### Product Images
- All product images are sourced from **Unsplash.com**
- High-quality, royalty-free images
- Direct URLs to ensure images load properly

### Brand Logos
- Sourced from **logos-world.net**
- Official brand logos in PNG format
- Transparent backgrounds where applicable

### Shop/Seller Images
- Profile images generated using **ui-avatars.com**
- Shop images from **Unsplash.com**
- Banner images from **Unsplash.com**

## Features

### Product Details
✅ Multiple product images (2-3 images per product)
✅ Detailed product descriptions with HTML formatting
✅ Multiple color variants for applicable products
✅ Realistic pricing with purchase price and selling price
✅ Tax rates (5-10% depending on category)
✅ Discounts (flat amounts)
✅ Stock quantities
✅ Product codes for inventory tracking

### Vendor Details
✅ Complete seller profiles with contact info
✅ Bank account details (dummy data)
✅ Commission percentages
✅ Free delivery thresholds
✅ Professional shop images and banners

## Database Tables Populated

- ✅ `categories` - Product categories and subcategories
- ✅ `brands` - Brand information with logos
- ✅ `sellers` - Vendor/seller accounts
- ✅ `shops` - Shop information for each seller
- ✅ `products` - Complete product catalog
- ✅ `seller_wallets` - Wallet initialization for sellers

## Notes

### Default Credentials
All seller passwords are hashed with: `$2y$10$XB8qVHjZw5YE5vIKwL/xMeD4WCTxCrZJvZN8.kJhkVQxZJYZQxZJ.`
(This is a placeholder - you should update these)

### Stock Status
All products have sufficient stock and are published (visible on store)

### Image Reliability
All images use direct URLs from reliable sources. If images don't load:
- Check your internet connection
- Verify the URLs are accessible
- Consider downloading and hosting images locally

## Customization

### To Add More Products
Use this template:
```sql
INSERT INTO `products` (...) VALUES
(ID, 'seller', SELLER_ID, 'Product Name', 'product-slug', 'physical',
'CATEGORY_ID', 'SUB_CATEGORY_ID', BRAND_ID, 'pc', 1, 1,
'["image1.jpg","image2.jpg"]', 'thumbnail.jpg', 'public', '1',
'["#COLOR1","#COLOR2"]', 0, 1, PRICE, COST, 'TAX', 'percent',
'DISCOUNT', 'flat', STOCK, 1, '<p>Description</p>', 1, NOW(), NOW(), 'CODE');
```

### To Modify Existing Data
Simply edit the SQL file before importing, or run UPDATE queries after import.

## Troubleshooting

### Foreign Key Errors
If you get foreign key constraint errors:
```sql
SET FOREIGN_KEY_CHECKS=0;
-- Import data
SET FOREIGN_KEY_CHECKS=1;
```

### Auto-Increment Conflicts
If IDs conflict with existing data, adjust the AUTO_INCREMENT:
```sql
ALTER TABLE products AUTO_INCREMENT = 100;
ALTER TABLE brands AUTO_INCREMENT = 20;
-- etc.
```

### Clear Existing Data
To start fresh (⚠️ WARNING: This deletes data):
```sql
TRUNCATE TABLE products;
TRUNCATE TABLE brands;
TRUNCATE TABLE categories;
TRUNCATE TABLE sellers;
TRUNCATE TABLE shops;
```

## Support

For issues or questions about the sample data, please check:
- Database schema compatibility
- Required table columns match your version
- Image URLs are accessible

---

**Generated:** 2025-12-12
**Database:** 6valley E-commerce Platform
**Total Records:** 46 (11 categories, 10 brands, 5 sellers, 5 shops, 15 products)
