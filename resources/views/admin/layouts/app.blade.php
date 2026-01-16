<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Laravel Practical</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    @guest('admin')
        @yield('content')
    @else
        <div class="app-container">
            <aside class="sidebar">
                <h2 style="color: var(--accent-color);">Admin Panel</h2>
                <nav style="margin-top: 2rem;">
                    <a href="{{ route('admin.products.index') }}" style="display: block; padding: 0.75rem 0; color: white;">Products</a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: auto;">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 2rem;">Logout</button>
                    </form>
                </nav>
            </aside>
            <main class="main-content">
                @if(session('success'))
                    <div style="background: rgba(34, 197, 94, 0.2); color: var(--success-color); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    @endguest

    @stack('scripts')
</body>
</html>
