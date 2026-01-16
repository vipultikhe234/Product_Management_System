<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Laravel Practical</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <style>
        /* Specific header/nav for user since it's different from Admin Sidebar */
        .user-header {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-nav a { margin-left: 1.5rem; font-weight: 600; }
        .user-nav a:hover { color: var(--accent-color); }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .product-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.2s;
        }
        .product-card:hover { transform: translateY(-5px); }
        .product-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .product-title { margin: 0 0 0.5rem 0; font-size: 1.1rem; }
        .product-price { font-size: 1.25rem; font-weight: bold; color: var(--accent-color); margin-bottom: 1rem; }
        .product-meta { color: #94a3b8; font-size: 0.9rem; margin-bottom: 1rem; }
        .main-container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
    </style>
</head>
<body>
    <header class="user-header">
        <a href="{{ route('user.home') }}" style="font-size: 1.5rem; font-weight: bold;">Shop<span style="color:var(--accent-color)">App</span></a>
        <nav class="user-nav flex items-center">
            @auth
                <a href="{{ route('user.home') }}">Home</a>
                <a href="{{ route('user.cart.index') }}">Cart</a>
                <form action="{{ route('user.logout') }}" method="POST" style="display:inline; margin-left: 1.5rem;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.75rem; font-size: 0.9rem;">Logout</button>
                </form>
            @else
                <a href="{{ route('user.login') }}">Login</a>
                <a href="{{ route('user.register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main class="main-container">
        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); color: var(--success-color); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: var(--danger-color); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ $errors->first() }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
