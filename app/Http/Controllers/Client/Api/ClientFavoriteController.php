<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\Client\ProductResource;
use App\Http\Resources\Client\ServiceResource;
use App\Http\Resources\Client\FavoriteResource;
use App\Http\Requests\Client\Api\ClientFavoriteProductRequest;
use App\Http\Requests\Client\Api\ClientFavoriteServiceRequest;

class ClientFavoriteController extends Controller
{
    use SendResponse;

    public function toggleFavoriteServices(ClientFavoriteServiceRequest $request)
    {
        $client = auth()->guard('client-api')->user();
        $service_id = $request->service_id;

        if ($client->favoriteServices->contains($service_id)) {
            $client->favoriteServices()->detach($service_id);
        } else {
            $client->favoriteServices()->attach($service_id);
        }

        return $this->SuccessMessage('تم بنجاح');
    }

    public function toggleFavoriteProducts(ClientFavoriteProductRequest $request)
    {
        $client = auth()->guard('client-api')->user();
        $product_id = $request->product_id;

        if ($client->favoriteProducts->contains($product_id)) {
            $client->favoriteProducts()->detach($product_id);
        } else {
            $client->favoriteProducts()->attach($product_id);
        }

        return $this->SuccessMessage('تم بنجاح');
    }

    public function favorite(FormRequest $request)
    {
        $client = auth()->guard('client-api')->user();
        $products = $client->favoriteProducts()->with('category')->get();
        $services = $client->favoriteServices()->with('category')->get();

        $concatenatedCollection = $products->concat($services);
        return $this->sendResponse(
            FavoriteResource::collection($concatenatedCollection->paginate($request->per_page ?? 10)),
            withmeta: true,
        );
    }

    public function favoriteServices(FormRequest $request)
    {
        $client = auth()->guard('client-api')->user();
        return $this->sendResponse(
            ServiceResource::collection($client->favoriteServices()->with('category')->paginate($request->per_page ?? 10)),
            withmeta: true,
        );
    }

    public function favoriteProducts(FormRequest $request)
    {
        $client = auth()->guard('client-api')->user();
        return $this->sendResponse(
            ProductResource::collection($client->favoriteProducts()->with('category')->paginate($request->per_page ?? 10)),
            withmeta: true,
        );
    }
}
