<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Traits\Response\SendResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Client\ProductResource;
use App\Http\Resources\Client\ServiceResource;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    use SendResponse;

    public function popularProducts()
    {
        $brandId = null;
        if (auth()->guard('client-api')->check()) {
            $client_cars = auth()->guard('client-api')->user()->cars;
            $default_car = $client_cars->where('default', 1)->first();
            if ($default_car)
                $brandId = $default_car->brand_id;
        }

        $records = DB::select("SELECT products.* 
            FROM products
            LEFT JOIN product_brands on products.id = product_brands.product_id
            LEFT JOIN order_products 
            ON products.id = order_products.product_id 
            " . ($brandId ? "WHERE product_brands.brand_id = $brandId" : '') . "
             GROUP BY products.id
            ORDER BY COUNT(order_products.quantity) DESC
            LIMIT 5");

        $records = Product::hydrate($records);
        $records->load('brands');
        return $this->sendResponse(ProductResource::collection($records));
    }

    public function popularServices()
    {
        $brandId = null;
        if (auth()->guard('client-api')->check()) {
            $client_cars = auth()->guard('client-api')->user()->cars;
            $default_car = $client_cars->where('default', 1)->first();
            if ($default_car)
                $brandId = $default_car->brand_id;
        }

        $records = DB::select("SELECT services.*, SUM(bookings.service_quantity) AS total_bookings 
            FROM services
            LEFT JOIN service_brands on services.id = service_brands.service_id
            LEFT JOIN bookings 
            ON services.id = bookings.service_id
            " . ($brandId ? "WHERE service_brands.brand_id = $brandId" : '') . "
            GROUP BY services.id
            ORDER BY total_bookings DESC
            LIMIT 5");

        $records = Service::hydrate($records);
        $records->load('brands');
        return $this->sendResponse(ServiceResource::collection($records));
    }
}
