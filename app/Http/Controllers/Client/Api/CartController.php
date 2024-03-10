<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Cart as Model;
use App\Http\Requests\Client\Api\CartRequest as FormRequest;
use App\Http\Resources\Client\CartResource as Resource;
use App\Http\Resources\Client\CartResource;

class CartController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource,
            hasDelete: true
        );
    }

    public function relations(): array
    {
        return [
            'product',
        ];
    }

    public function getUserCart()
    {
        $client = auth()->guard('client-api')->user();
        $cart = $client->cart()->with('product')->paginate($this->request->per_page ?? 10);

        return $this->sendResponse(
            CartResource::collection($cart),
            withmeta: true,
        );
    }

    public function store()
    {
        $client_cart = auth()->guard('client-api')->user()->cart;
        $cart_product = $client_cart->where('product_id', $this->request->product_id)->first();

        if ($cart_product) {
            $cart_product->update([
                'quantity' => $cart_product->quantity + $this->request->quantity,
                'total_price' => ($cart_product->quantity + $this->request->quantity) * $cart_product->product->price
            ]);

            if (!empty($this->relations()))
                $record = $cart_product->load(...$this->relations());

            return $this->sendResponse(new $this->resource($record), __('client.successfully_added'), true, 201);
        };

        return parent::store();
    }
}
