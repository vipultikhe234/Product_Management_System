<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>₹{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <form action="{{ route('admin.products.toggle', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn" style="padding: 0.25rem 0.5rem; background: {{ $product->is_active ? 'var(--success-color)' : '#94a3b8' }}; color: black; font-size: 0.8rem;">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline; margin-left: 0.5rem;" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="margin-top: 1rem;">
    {{ $products->links('pagination::bootstrap-5') }} 
    {{-- Note: Standard pagination view might need publishing or customization for pure CSS, sticking to default simple --}}
</div>
