# 📍 Location-Based Product Filtering - Complete Implementation Guide

## Overview
This system allows customers to see products available in their area based on pincode matching between user location and shop location.

---

## ✅ Implementation Completed

### 1. Database Setup ✓

#### Migrations Created:
- **`add_pincode_to_shops_table`**: Adds `pincode` column to shops table
- **`add_pincode_latitude_longitude_to_users_table`**: Adds location fields to users table

#### Fields Added:
- **shops** table:
  - `pincode` (string, 10 chars, nullable)

- **users** table:
  - `pincode` (string, 10 chars, nullable)
  - `latitude` (decimal 10,7, nullable)
  - `longitude` (decimal 10,7, nullable)

**Run command:**
```bash
php artisan migrate
```
✅ Already executed successfully

---

### 2. Models Updated ✓

#### Shop Model (`app/Models/Shop.php`)
- Added `pincode` to `$fillable` array

#### User Model (`app/Models/User.php`)
- Added `pincode`, `latitude`, `longitude` to `$fillable` array

---

### 3. Location Permission System ✓

#### Modal Created
**File:** `resources/themes/theme_aster/theme-views/layouts/partials/modal/_location-permission.blade.php`

**Features:**
- Modern, user-friendly UI
- Request location permission button
- Loading state with spinner
- Success/error messages
- Manual pincode entry fallback
- Skip option

**Triggers:**
- Automatically shows after user login
- Only shows if user doesn't have pincode set

---

### 4. JavaScript Location Service ✓

**File:** `public/themes/theme_aster/public/assets/js/location-service.js`

**Features:**
- Uses browser Geolocation API
- Reverse geocoding with OpenStreetMap Nominatim API
- Automatic pincode detection
- Manual pincode entry
- LocalStorage backup
- Comprehensive error handling

**Key Functions:**
- `requestLocation()` - Request browser location
- `reversGeocode()` - Convert coordinates to pincode
- `savePincodeToServer()` - Save to database via API
- `saveManualPincode()` - Handle manual entry

---

### 5. Backend API ✓

#### Route Added
**File:** `routes/web/routes.php`
```php
Route::post('save-location', 'saveLocation')->name('save-location');
```

**Endpoint:** `POST /customer/save-location`

#### Controller Method
**File:** `app/Http/Controllers/Customer/SystemController.php`

**Method:** `saveLocation(Request $request)`

**Accepts:**
- `pincode` (required, string, max:10)
- `latitude` (optional, numeric)
- `longitude` (optional, numeric)

**Returns:** JSON response with success/error

---

### 6. Product Filtering Logic ✓

**File:** `app/Utils/ProductManager.php`

**Method:** `getProductListData()`

**Filter Applied:**
```php
->when(auth('customer')->check() && auth('customer')->user()->pincode, function ($query) {
    $userPincode = auth('customer')->user()->pincode;
    return $query->whereHas('seller.shop', function ($shopQuery) use ($userPincode) {
        $shopQuery->where('pincode', $userPincode)
                 ->orWhereNull('pincode'); // Show products from shops without pincode
    });
})
```

**Logic:**
- If user is logged in AND has pincode set:
  - Show products from shops with MATCHING pincode
  - Also show products from shops WITHOUT pincode (to avoid empty results)
- If user not logged in OR no pincode:
  - Show ALL products (normal behavior)

---

### 7. Translation Keys ✓

**File:** `resources/lang/en/messages.php`

**Added Keys:**
- `enable_location_services`
- `find_products_near_you`
- `allow_location_access_to_see_products_available_in_your_area`
- `detecting_your_location`
- `location_detected_successfully`
- `pincode`
- `or_enter_pincode_manually`
- `enter_your_pincode`
- `save`
- `allow_location_access`
- `skip_for_now`

---

## 🚀 How It Works

### User Flow:

1. **User logs in**
   → System checks if user has pincode

2. **No pincode found**
   → Location permission modal shows automatically (after 1 second)

3. **User clicks "Allow Location Access"**
   → Browser requests geolocation permission

4. **Location granted**
   → JavaScript gets lat/long coordinates
   → Reverse geocodes to pincode via Nominatim API
   → Saves to database via `/customer/save-location`
   → Stores in session & localStorage
   → Page reloads

5. **Location denied or failed**
   → Manual pincode entry form appears
   → User enters 6-digit pincode
   → Saves to database
   → Page reloads

6. **Products filtered**
   → All product listings now show only products from shops with matching pincode
   → Products from shops without pincode also shown (fallback)

---

## 🔧 Admin Setup Required

### For Sellers/Shops:

Sellers need to add their pincode to their shop settings. You'll need to add a pincode field in:

1. **Seller Registration/Edit Form**
2. **Admin Shop Management**

Example implementation:
```blade
<div class="form-group">
    <label>Pincode *</label>
    <input type="text" name="pincode" class="form-control"
           pattern="[0-9]{6}" maxlength="6"
           value="{{ old('pincode', $shop->pincode) }}" required>
</div>
```

---

## 📊 Database Queries

### Check users with pincode:
```sql
SELECT id, name, pincode, latitude, longitude FROM users WHERE pincode IS NOT NULL;
```

### Check shops with pincode:
```sql
SELECT id, name, pincode FROM shops WHERE pincode IS NOT NULL;
```

### See location-filtered products for a user:
```sql
SELECT p.* FROM products p
JOIN shops s ON p.user_id = s.seller_id
WHERE s.pincode = '600001' OR s.pincode IS NULL;
```

---

## 🎨 Customization Options

### Change Geocoding Provider

Currently using OpenStreetMap Nominatim (free, no API key needed).

To use Google Maps Geocoding API:

**In `location-service.js`, replace `reversGeocode()` with:**
```javascript
async reversGeocode(latitude, longitude) {
    const apiKey = 'YOUR_GOOGLE_API_KEY';
    const response = await fetch(
        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`
    );
    const data = await response.json();

    // Extract pincode from Google response
    const postalCode = data.results[0]?.address_components?.find(
        component => component.types.includes('postal_code')
    )?.long_name;

    return postalCode;
}
```

### Adjust Filter Logic

**To show ONLY exact pincode matches (no fallback):**

In `ProductManager.php`, change:
```php
$shopQuery->where('pincode', $userPincode);
// Remove: ->orWhereNull('pincode')
```

**To expand to nearby pincodes:**
```php
// Get first 3 digits of pincode
$pincodePrefix = substr($userPincode, 0, 3);
$shopQuery->where('pincode', 'LIKE', $pincodePrefix . '%')
         ->orWhereNull('pincode');
```

---

## 🧪 Testing

### Test Location Permission:
1. Login as customer
2. Clear browser localStorage: `localStorage.removeItem('userPincode')`
3. Refresh page
4. Modal should appear

### Test Manual Pincode:
1. Deny location permission
2. Enter pincode manually: `600001`
3. Should save and reload

### Test Product Filtering:
1. Set user pincode: `600001`
2. Create shop with same pincode
3. Add product to that shop
4. Login as user
5. Should see that product

---

## 🛠️ Troubleshooting

### Modal not showing:
- Check browser console for errors
- Verify user is authenticated
- Check if pincode already set in database

### Reverse geocoding fails:
- Check network tab for API call
- Nominatim has rate limits (1 req/second)
- May need to implement caching or use paid service

### Products still showing all items:
- Check user has pincode in database
- Verify shop has pincode set
- Check `ProductManager.php` filter is applied

### HTTPS required for geolocation:
- Browser geolocation requires HTTPS
- Use `https://` in production
- Localhost works without HTTPS

---

## 📝 Files Modified/Created

### Created:
1. `database/migrations/2025_12_12_150311_add_pincode_to_shops_table.php`
2. `database/migrations/2025_12_12_150329_add_pincode_latitude_longitude_to_users_table.php`
3. `resources/themes/theme_aster/theme-views/layouts/partials/modal/_location-permission.blade.php`
4. `public/themes/theme_aster/public/assets/js/location-service.js`

### Modified:
1. `app/Models/Shop.php`
2. `app/Models/User.php`
3. `app/Http/Controllers/Customer/SystemController.php`
4. `routes/web/routes.php`
5. `app/Utils/ProductManager.php`
6. `resources/themes/theme_aster/theme-views/layouts/app.blade.php`
7. `resources/lang/en/messages.php`

---

## ✨ Features Summary

✅ Automatic location detection
✅ Manual pincode entry fallback
✅ Reverse geocoding (coordinates → pincode)
✅ Session & localStorage caching
✅ Product filtering by pincode
✅ Fallback for shops without pincode
✅ Beautiful, responsive UI
✅ Multi-language support
✅ Error handling
✅ AJAX API integration

---

## 🎯 Next Steps (Optional Enhancements)

1. **Add pincode field to seller dashboard**
2. **Show pincode in shop profile**
3. **Add "Change Location" button in header**
4. **Display current location in user profile**
5. **Add location icon/badge on filtered products**
6. **Create admin panel to manage pincodes**
7. **Add delivery radius calculation**
8. **Implement pincode-based shipping costs**

---

## 📞 Support

For issues or questions about this implementation, check:
- Laravel logs: `storage/logs/laravel.log`
- Browser console for JavaScript errors
- Network tab for API calls

---

**Implementation completed successfully! 🎉**

The location-based product filtering system is now fully functional.
