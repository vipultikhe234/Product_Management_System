<<<<<<< HEAD
# Product Management System
=======
# 🛍️ Laravel E-Commerce Application
>>>>>>> d38dbef10ba421074d2ee956d0ec7be1b2da6f2b

Laravel-based e-commerce application with Admin Panel and Customer API.

## Features

### Admin Panel
- Authentication
- Product CRUD operations
- Search functionality
- Stock management
- Active status toggle

### Customer API
- User authentication (Sanctum)
- Shopping cart management
- Checkout with stock validation
- Multi-language support (English, Hindi)

## Tech Stack
- Laravel 10
- MySQL
- Laravel Sanctum
- Multi-language support

## Setup

1. **Install dependencies**
   ```bash
   composer install
   ```

2. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your database credentials.

3. **Run migrations**
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Start server**
   ```bash
   php artisan serve
   ```

## Credentials

Admin: `admin@admin.com` / `password`

## API Response Format
```json
{
    "status": 1,
    "message": "Success message",
    "data": {}
}
```

## Language Support
Send `Accept-Language` header with `en` or `hi`:
```bash
curl -H "Accept-Language: hi" http://localhost:8000/api/cart
```

## Testing
```bash
php artisan test
```
