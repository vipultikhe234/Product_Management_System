# 🛍️ Laravel E-Commerce Application

A robust, full-stack E-Commerce solution built with **Laravel 10**, featuring a premium **Admin Dashboard**, a customer-facing **Shopping Interface**, and a strictly typed **REST API**. Designed with a focus on clean architecture, security, and performance.

## 🚀 Key Features

### 🔐 Admin Panel (Web)
*   **Secure Authentication**: Dedicated admin login with custom guards.
*   **Product Management (CRUD)**:
    *   Real-time AJAX search (Name/SKU).
    *   Stock management and status toggling.
    *   Server-side validation using Form Requests.
*   **Premium UI**: Custom-built **Dark Mode** interface using optimized Vanilla CSS (No bulky frameworks).

### 🛒 Customer Web Interface
*   **User Accounts**: Registration, Login, and Session management.
*   **Product Catalog**:
    *   Browse curated products (Indian Market context).
    *   Smart search functionality.
    *   Real-time availability checks.
*   **Shopping Cart**:
    *   Add/Update/Remove items.
    *   Dynamic subtotal calculation.
    *   Stock validation before checkout.
*   **Checkout System**:
    *   Transnational order processing.
    *   Automatic stock deduction.
    *   Order history tracking.

### 🔌 REST API (Mobile Ready)
*   **Sanctum Security**: Token-based authentication for external clients/mobile apps.
*   **Endpoints**:
    *   `POST /api/register` & `/api/login`
    *   `GET /api/cart`
    *   `POST /api/cart/items`
    *   `POST /api/cart/checkout`
*   **Validation**: Standardized JSON responses with HTTP status codes.

---

## 🛠️ Technology Stack
*   **Framework**: Laravel 10.x
*   **Language**: PHP 8.1+
*   **Database**: MySQL / PostgreSQL
*   **Frontend**: Blade Templates, Vanilla CSS (Custom Design System)
*   **Testing**: PHPUnit (Feature & Unit Tests)
*   **API Auth**: Laravel Sanctum

---

## 📦 Database & Seeders
The application comes pre-seeded with 15+ curated products relevant to the Indian market, ensuring a realistic testing environment.

**Sample Products Included:**
*   *Electronics*: OnePlus Nord CE 3, Boat Airdopes 141
*   *Fashion*: Men's Kurta, Kanjivaram Silk Saree, Titan Watch
*   *Grocery*: Tata Tea Gold, India Gate Basmati Rice, Amul Butter
*   *Lifestyle*: Wildcraft Backpack, Yoga Mat

---

## ⚙️ Installation & Setup

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/yourusername/laravel-ecommerce-task.git
    cd laravel-ecommerce-task
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Environment Configuration**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Edit `.env` and configure your database credentials (DB_DATABASE, DB_USERNAME, etc).*

4.  **Migrate & Seed**
    This command creates tables and populates the database with the Admin user and Indian products.
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Run Application**
    ```bash
    php artisan serve
    ```

---

## 🔑 Access Credentials

### Admin Portal
*   **URL**: `http://127.0.0.1:8000/admin/login`
*   **Email**: `admin@admin.com`
*   **Password**: `password`

### Customer Portal
*   **URL**: `http://127.0.0.1:8000/login`
*   **Account**: *Register a new account or use the seed data if applicable.*

---

## 🧪 Testing
The project includes automated feature tests for critical business logic (Cart Merging, Stock Validation).

```bash
php artisan test
```

## 📡 API Documentation
A detailed **Postman Collection** is included in the root directory: `PostmanCollection.json`. Import this file into Postman to test the API endpoints directly.
