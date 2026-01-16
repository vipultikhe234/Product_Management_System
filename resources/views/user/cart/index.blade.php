@extends('user.layouts.app')

@section('content')
<h1>Shopping Cart</h1>

@if(!$cart || $cart->items->isEmpty())
    <div class="card" style="text-align: center; padding: 4rem;">
        <h2 style="color: #94a3b8;">Your cart is empty</h2>
        <a href="{{ route('user.home') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Continue Shopping</a>
    </div>
@else
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr>
                    <td>
                        <div style="font-weight: bold;">{{ $item->product->name }}</div>
                        <div style="font-size: 0.8rem; color: #94a3b8;">{{ $item->product->sku }}</div>
                    </td>
                    <td>₹{{ $item->product->price }}</td>
                    <td>
                        <form action="{{ route('user.cart.update', $item) }}" method="POST" class="flex gap-4 items-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="qty" value="{{ $item->qty }}" min="1" max="{{ $item->product->stock }}" class="form-input" style="width: 70px; padding: 0.25rem;">
                            <button type="submit" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; background: #334155;">Update</button>
                        </form>
                    </td>
                    <td>₹{{ number_format($item->qty * $item->product->price, 2) }}</td>
                    <td>
                        <form action="{{ route('user.cart.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="flex justify-between items-center" style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
             <a href="{{ route('user.home') }}" class="btn" style="background: transparent; border: 1px solid var(--border-color); color: var(--text-color);">Continue Shopping</a>
             <div style="text-align: right;">
                 <div style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Total: ₹{{ number_format($total, 2) }}</div>
                 <form action="{{ route('user.cart.checkout') }}" method="POST">
                     @csrf
                     <button type="submit" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.75rem 2rem;">Checkout</button>
                 </form>
             </div>
        </div>
    </div>
@endif
@endsection
