@extends('user.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1>All Products</h1>
    <form action="{{ route('user.home') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" class="form-input" placeholder="Search products..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="product-grid">
    @foreach($products as $product)
    <div class="product-card">
        <!-- Placeholder Image using gradient -->
        <div style="height: 150px; background: linear-gradient(45deg, #1e293b, #334155); display: flex; align-items: center; justify-content: center; color: #64748b;">
             Product Image
        </div>
        <div class="product-body">
            <h3 class="product-title">{{ $product->name }}</h3>
            <div class="product-meta">{{ $product->sku }}</div>
            <div class="product-price">₹{{ $product->price }}</div>
            
            <div style="margin-top: auto;">
                @if($product->stock > 0)
                    <form action="{{ route('user.cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex gap-4">
                            <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="form-input" style="width: 70px;">
                            <button type="submit" class="btn btn-primary" style="flex: 1;">Add to Cart</button>
                        </div>
                    </form>
                @else
                   <button disabled class="btn" style="width: 100%; background: #334155; cursor: not-allowed;">Out of Stock</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top: 2rem;">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
