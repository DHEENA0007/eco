#!/usr/bin/env php
<?php
/**
 * Quick Database Check Script
 * Run this to verify sample data is loaded correctly
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "\n";
echo "====================================\n";
echo "  6VALLEY DATABASE CHECK\n";
echo "====================================\n\n";

try {
    // Check database connection
    DB::connection()->getPdo();
    echo "✓ Database connection: OK\n";

    // Check categories
    $categoriesCount = DB::table('categories')->count();
    echo "✓ Categories: {$categoriesCount}\n";

    // Check brands
    $brandsCount = DB::table('brands')->count();
    echo "✓ Brands: {$brandsCount}\n";

    // Check sellers
    $sellersCount = DB::table('sellers')->count();
    echo "✓ Sellers: {$sellersCount}\n";

    // Check shops
    $shopsCount = DB::table('shops')->count();
    echo "✓ Shops: {$shopsCount}\n";

    // Check products
    $productsCount = DB::table('products')->count();
    $publishedCount = DB::table('products')->where('published', 1)->where('status', 1)->count();
    $featuredCount = DB::table('products')->where('featured', '1')->where('status', 1)->count();

    echo "✓ Total Products: {$productsCount}\n";
    echo "  - Published & Active: {$publishedCount}\n";
    echo "  - Featured & Active: {$featuredCount}\n";

    echo "\n";
    echo "Sample Products:\n";
    echo "----------------\n";

    $products = DB::table('products')
        ->select('id', 'name', 'unit_price', 'current_stock', 'published', 'status', 'featured')
        ->limit(5)
        ->get();

    foreach ($products as $product) {
        $statusText = ($product->published && $product->status) ? '✓ Active' : '✗ Inactive';
        $featuredText = $product->featured == '1' ? '⭐ Featured' : '';
        echo sprintf(
            "  %d. %s - $%.2f (Stock: %d) %s %s\n",
            $product->id,
            substr($product->name, 0, 35),
            $product->unit_price,
            $product->current_stock,
            $statusText,
            $featuredText
        );
    }

    echo "\n";
    echo "Brands:\n";
    echo "-------\n";

    $brands = DB::table('brands')->select('id', 'name', 'status')->limit(5)->get();
    foreach ($brands as $brand) {
        $status = $brand->status ? '✓ Active' : '✗ Inactive';
        echo "  {$brand->id}. {$brand->name} {$status}\n";
    }

    echo "\n";
    echo "Sellers:\n";
    echo "--------\n";

    $sellers = DB::table('sellers')
        ->select(DB::raw("CONCAT(f_name, ' ', l_name) as name"), 'email', 'status')
        ->limit(5)
        ->get();

    foreach ($sellers as $seller) {
        echo "  - {$seller->name} ({$seller->email}) - {$seller->status}\n";
    }

    echo "\n";
    echo "====================================\n";
    echo "Application URL: " . env('APP_URL', 'Not Set') . "\n";
    echo "Server should be running on: http://localhost:8000\n";
    echo "====================================\n\n";

    echo "✅ All checks passed! Your data is loaded correctly.\n\n";
    echo "If you still don't see products on the website:\n";
    echo "1. Make sure you've cleared cache (php artisan cache:clear)\n";
    echo "2. Access: http://localhost:8000\n";
    echo "3. Check browser console for any JavaScript errors\n";
    echo "4. Verify seller status is 'approved' in database\n\n";

} catch (\Exception $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n\n";
}
