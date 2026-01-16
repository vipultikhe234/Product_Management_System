@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1>Edit Product</h1>
    <a href="{{ route('admin.products.index') }}" class="btn">Back</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $product->name) }}" required minlength="3">
            @error('name') <span style="color: var(--danger-color)">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-input" value="{{ old('sku', $product->sku) }}" required>
            @error('sku') <span style="color: var(--danger-color)">{{ $message }}</span> @enderror
        </div>
        <div class="flex gap-4">
            <div class="form-group" style="flex:1;">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-input" value="{{ old('price', $product->price) }}" required>
                @error('price') <span style="color: var(--danger-color)">{{ $message }}</span> @enderror
            </div>
            <div class="form-group" style="flex:1;">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-input" value="{{ old('stock', $product->stock) }}" required min="0">
                @error('stock') <span style="color: var(--danger-color)">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="flex items-center gap-4" style="color: white; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
