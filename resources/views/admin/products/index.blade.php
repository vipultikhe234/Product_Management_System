@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
</div>

<div class="card">
    <div class="form-group">
        <input type="text" id="search" class="form-input" placeholder="Search by Name or SKU..." style="max-width: 300px;">
    </div>
    
    <div class="table-container" id="product-list">
        @include('admin.products.partials.product-list')
    </div>
</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('search');
    const productList = document.getElementById('product-list');
    let timeout = null;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const query = this.value;
            fetch(`{{ route('admin.products.index') }}?search=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                productList.innerHTML = html;
            });
        }, 300);
    });
</script>
@endpush
