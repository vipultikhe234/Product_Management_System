<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\CheckoutRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = Cart::where('user_id', $request->user()->id)
                    ->with('items.product')
                    ->first();

        if (!$cart) {
            return ApiResponseHelper::success(
                __('message.CART_EMPTY'), 
                'data', 
                ['items' => [], 'total' => 0]
            );
        }

        $total = $cart->items->sum(function ($item) {
            return $item->qty * $item->product->price;
        });

        return ApiResponseHelper::success(
            __('message.CART_RETRIEVED'), 
            'data', 
            [
                'items' => $cart->items,
                'total' => $total
            ]
        );
    }

    public function store(AddToCartRequest $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);
        $product = Product::findOrFail($request->product_id);

        $existingItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($existingItem) {
            $existingItem->increment('qty', $request->qty);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'price_at_time' => $product->price
            ]);
        }

        return ApiResponseHelper::success(__('message.ITEM_ADDED'), 'data', []);
    }

    public function update(Request $request, $productId)
    {
        $request->validate(['qty' => 'required|integer|min:1']);
        
        $cart = Cart::where('user_id', $request->user()->id)->firstOrFail();
        
        $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $productId)
                        ->firstOrFail();

        $cartItem->update(['qty' => $request->qty]);

        return ApiResponseHelper::success(__('message.CART_UPDATED'), 'data', []);
    }
    
    public function destroy(Request $request, $productId)
    {
        $cart = Cart::where('user_id', $request->user()->id)->firstOrFail();
        
        CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->delete();

        return ApiResponseHelper::success(__('message.ITEM_REMOVED'), 'data', []);
    }

    public function checkout(CheckoutRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $cart = Cart::where('user_id', $request->user()->id)->with('items.product')->first();

                if (!$cart || $cart->items->isEmpty()) {
                    return ApiResponseHelper::error(__('message.CART_EMPTY'), 400);
                }

                $total = 0;
                // Check stock
                foreach ($cart->items as $item) {
                    if ($item->product->stock < $item->qty) {
                        return ApiResponseHelper::error(__('message.INSUFFICIENT_STOCK', ['product' => $item->product->name]), 400);
                    }
                    $total += $item->qty * $item->product->price;
                }

                // Deduct stock and create order
                $order = Order::create([
                    'user_id' => $request->user()->id,
                    'total_amount' => $total,
                    'status' => 'completed',
                ]);

                foreach ($cart->items as $item) {
                    $item->product->decrement('stock', $item->qty);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->qty,
                        'price' => $item->product->price,
                    ]);
                }

                // Clear cart
                $cart->items()->delete();
                $cart->delete();

                return ApiResponseHelper::success(__('message.ORDER_PLACED'), 'data', ['order_id' => $order->id]);
            });
        } catch (\Exception $e) {
            return ApiResponseHelper::internalServerError($e->getMessage());
        }
    }
}
