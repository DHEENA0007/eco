<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GeocodingController extends Controller
{
    /**
     * Reverse geocode to get correct INDIAN PINCODE
     */
    public function reverseGeocode(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
            ]);

            $lat = $request->lat;
            $lng = $request->lng;

            // STEP 1: Extract locality from OSM
            $locality = $this->getLocalityFromOSM($lat, $lng);

            if ($locality) {
                // STEP 2: Accurate pincode using India Post API (Best match)
                $pincode = $this->getPincodeFromIndiaPost($locality);

                if ($pincode) {
                    return response()->json([
                        'success' => true,
                        'pincode' => $pincode,
                        'locality' => $locality,
                        'message' => 'Accurate pincode detected via India Post'
                    ]);
                }
            }

            // STEP 3: Fallback → OSM direct pincode (may be wrong)
            $fallback = $this->getPincodeFromOSM($lat, $lng);

            if ($fallback) {
                return response()->json([
                    'success' => true,
                    'pincode' => $fallback,
                    'locality' => $locality,
                    'message' => 'Pincode detected (fallback OSM)'
                ]);
            }

            // STEP 4: Google Maps fallback
            if (env('GOOGLE_MAPS_API_KEY')) {
                $google = $this->getPincodeFromGoogle($lat, $lng);

                if ($google) {
                    return response()->json([
                        'success' => true,
                        'pincode' => $google,
                        'locality' => $locality,
                        'message' => 'Pincode detected (Google)'
                    ]);
                }
            }

            // FAILED
            return response()->json([
                'success' => false,
                'message' => 'Could not detect pincode'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Extract locality name from OSM
     */
    private function getLocalityFromOSM($lat, $lng)
    {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&lat={$lat}&lon={$lng}";

        $json = file_get_contents($url);
        if (!$json) return null;

        $data = json_decode($json, true);

        return $data['address']['suburb']
            ?? $data['address']['village']
            ?? $data['address']['locality']
            ?? $data['address']['hamlet']
            ?? $data['address']['town']
            ?? $data['address']['city']
            ?? null;
    }

    /**
     * Accurate pincode from India Post API by locality name
     */
    private function getPincodeFromIndiaPost($locality)
    {
        $url = "https://api.postalpincode.in/postoffice/" . urlencode($locality);

        $json = file_get_contents($url);
        if (!$json) return null;

        $data = json_decode($json, true);

        if ($data[0]['Status'] === "Success") {
            // Pick first post office match
            return $data[0]['PostOffice'][0]['Pincode'] ?? null;
        }

        return null;
    }

    /**
     * Fallback → OSM pincode
     */
    private function getPincodeFromOSM($lat, $lng)
    {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}";

        $json = file_get_contents($url);
        if (!$json) return null;

        $data = json_decode($json, true);

        return $data['address']['postcode'] ?? null;
    }

    /**
     * Google Maps fallback
     */
    private function getPincodeFromGoogle($lat, $lng)
    {
        $key = env('GOOGLE_MAPS_API_KEY');
        if (!$key) return null;

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$key}";

        $json = file_get_contents($url);
        if (!$json) return null;

        $data = json_decode($json, true);

        if ($data['status'] === 'OK') {
            foreach ($data['results'][0]['address_components'] as $component) {
                if (in_array('postal_code', $component['types'])) {
                    return $component['long_name'];
                }
            }
        }

        return null;
    }
}
