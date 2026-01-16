<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with('items.product')
                    ->first();
        
        $total = $cart ? $cart->items->sum(fn($item) => $item->qty * $item->product->price) : 0;

        return view('user.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if(!$product->is_active || $product->stock < $request->qty) {
            return back()->withErrors(['msg' => 'Product not available or insufficient stock.']);
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($item) {
            $item->increment('qty', $request->qty);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'price_at_time' => $product->price
            ]);
        }

        return redirect()->route('user.cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request, CartItem $item)
    {
        // Simple check to ensure user owns this cart item via cart
        if($item->cart->user_id !== Auth::id()) abort(403);

        $request->validate(['qty' => 'required|integer|min:1']);
        
        // Stock check could be added here
        
        $item->update(['qty' => $request->qty]);
        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $item)
    {
        if($item->cart->user_id !== Auth::id()) abort(403);
        $item->delete();
        return back()->with('success', 'Item removed.');
    }

    public function checkout(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();

            if (!$cart || $cart->items->isEmpty()) {
                return back()->withErrors(['msg' => 'Cart is empty']);
            }

            $total = 0;
            foreach ($cart->items as $item) {
                if ($item->product->stock < $item->qty) {
                    return back()->withErrors(['msg' => "Insufficient stock for: " . $item->product->name]);
                }
                $total += $item->qty * $item->product->price;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
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

            $cart->items()->delete();
            $cart->delete();

            return redirect()->route('user.home')->with('success', 'Order placed successfully! Order ID: #' . $order->id);
        });
    }
}
