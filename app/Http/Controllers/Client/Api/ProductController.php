<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Product as Model;
use App\Http\Requests\Client\Api\ProductRequest as FormRequest;
use App\Http\Resources\Client\ProductResource as Resource;

class ProductController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource
        );
    }

    public function relations(): array
    {
        return [
            'category',
            'brands'
        ];
    }

    public function customWhen(): array
    {
        return [
            'condition' => true,
            'callback' => function ($q) {
                if (auth()->guard('client-api')->check()) {
                    $client_cars = auth()->guard('client-api')->user()->cars;
                    $default_car = $client_cars->where('default', 1)->first();

                    if ($default_car) {
                        $q->where('status', 1)->whereHas('brands', function ($q) use ($default_car) {
                            $q->where('brands.id', $default_car->brand_id);
                        });
                    }
                } else {
                    $q->where('status', 1);
                }
            },
        ];
    }
}
