<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LocationBasedVendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pincodes = [
            '641601', '641602', '641603', '641604', '641605',
            '641606', '641607', '641652', '641654', '641655',
            '641662', '641663', '641664', '641665', '641666',
            '641667', '641668', '641670', '641687', '642102'
        ];

        $vendorNames = [
            'Green Valley Store', 'City Mart', 'Express Bazaar', 'Super Shop',
            'Quick Store', 'Daily Needs', 'Fresh Market', 'Corner Shop',
            'Elite Store', 'Smart Bazaar', 'Prime Mart', 'Golden Store',
            'Royal Shop', 'Modern Bazaar', 'Urban Store', 'Metro Mart',
            'Central Store', 'Mega Shop', 'Happy Store', 'Best Mart'
        ];

        $productTemplates = [
            ['name' => 'Organic Rice', 'price' => 85, 'category' => 'Grocery'],
            ['name' => 'Fresh Vegetables Bundle', 'price' => 120, 'category' => 'Grocery'],
            ['name' => 'Premium Tea Powder', 'price' => 250, 'category' => 'Grocery'],
            ['name' => 'Cooking Oil 1L', 'price' => 180, 'category' => 'Grocery'],
            ['name' => 'Wheat Flour 5kg', 'price' => 200, 'category' => 'Grocery'],
            ['name' => 'Basmati Rice 5kg', 'price' => 450, 'category' => 'Grocery'],
            ['name' => 'Sugar 1kg', 'price' => 45, 'category' => 'Grocery'],
            ['name' => 'Fresh Milk 1L', 'price' => 60, 'category' => 'Dairy'],
            ['name' => 'Bread', 'price' => 35, 'category' => 'Bakery'],
            ['name' => 'Eggs 12pcs', 'price' => 72, 'category' => 'Dairy'],
        ];

        // Get or create default category and brand
        $category = Category::where('name', 'Grocery')->first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Grocery',
                'slug' => 'grocery',
                'priority' => 0,
            ]);
        }

        $brand = Brand::where('name', 'Generic')->first();
        if (!$brand) {
            $brand = Brand::create([
                'name' => 'Generic',
                'image' => 'def.png',
            ]);
        }

        foreach ($pincodes as $index => $pincode) {
            // Create Seller
            $seller = Seller::create([
                'f_name' => $vendorNames[$index],
                'l_name' => 'Owner',
                'phone' => '9' . str_pad($index + 1, 9, '0', STR_PAD_LEFT),
                'email' => 'vendor' . $pincode . '@example.com',
                'password' => Hash::make('12345678'),
                'status' => 'approved',
                'pos_status' => 1,
            ]);

            // Create Shop
            $shop = Shop::create([
                'seller_id' => $seller->id,
                'name' => $vendorNames[$index],
                'slug' => Str::slug($vendorNames[$index] . '-' . $pincode),
                'address' => 'Pincode Area ' . $pincode . ', Tamil Nadu, India',
                'pincode' => $pincode,
                'contact' => '9' . str_pad($index + 1, 9, '0', STR_PAD_LEFT),
                'image' => 'def.png',
                'banner' => 'def.png',
                'vacation_status' => 0,
                'temporary_close' => 0,
            ]);

            // Create 5 products for each vendor
            $productCount = rand(3, 5);
            for ($i = 0; $i < $productCount; $i++) {
                $template = $productTemplates[array_rand($productTemplates)];
                $productName = $template['name'] . ' - ' . substr($shop->name, 0, 15);

                Product::create([
                    'name' => $productName,
                    'slug' => Str::slug($productName . '-' . time() . '-' . $i),
                    'added_by' => 'seller',
                    'user_id' => $seller->id,
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'product_type' => 'physical',
                    'unit' => 'pc',
                    'min_qty' => 1,
                    'current_stock' => rand(50, 200),
                    'unit_price' => $template['price'],
                    'purchase_price' => $template['price'] * 0.8,
                    'tax' => 0,
                    'tax_type' => 'percent',
                    'tax_model' => 'include',
                    'discount' => rand(0, 20),
                    'discount_type' => 'percent',
                    'thumbnail' => 'def.png',
                    'status' => 1,
                    'request_status' => 1,
                    'featured' => rand(0, 1),
                    'details' => 'High quality ' . $template['name'] . ' available at ' . $shop->name . '. Delivery available in pincode ' . $pincode . ' area.',
                    'video_provider' => 'youtube',
                    'video_url' => null,
                    'shipping_cost' => 0,
                    'multiply_qty' => 0,
                    'code' => 'P' . $pincode . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                ]);
            }

            $this->command->info("Created vendor: {$vendorNames[$index]} with pincode {$pincode} and {$productCount} products");
        }

        $this->command->info('Successfully created ' . count($pincodes) . ' vendors with products for location-based filtering!');
    }
}
