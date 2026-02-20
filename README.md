# Restaurant API

RESTful API developed in Laravel for complete management of a restaurant system, covering menu control, orders, tables, reservations, inventory, payments, and system users.

* Current Version - v1.0.0

## 🛠️ Technologies
- PHP
- Laravel
- MySQL
- REST API
- Eloquent ORM

## 📂 Main Features

### 🍽️ Menu Management
- Create, update, and delete categories
- Manage menu items
- Associate items with categories
- Control product availability

### 🧾 Orders
- Create orders per table or customer
- Associate items with orders
- Order status control (open, preparing, finished)
- Relationship between orders and menu items

### 💳 Payments
- Register payments per order
- Support for multiple payment methods
- Direct association between payment and order

### 🪑 Tables and Reservations
- Table registration and management
- Control of available and occupied tables
- Reservation system
- Association between reservations, customers, and tables

### 📦 Inventory and Suppliers
- Inventory control
- Supplier registration
- Relationship between suppliers and inventory items
- Stock quantity updates

### 👥 People and Users
- Customer registration
- Employee management
- System user control
- Role-based responsibility separation

### ⏰ Business Hours
- Restaurant opening and closing time control

## 🧠 Applied Concepts
- MVC Architecture
- RESTful APIs
- Repository Pattern
- Eloquent Relationships (One-to-One, One-to-Many)
- Data validation
- Migrations and Seeders
- Separation of concerns
- Clean and organized code practices

## ▶️ How to Run the Project

```bash
git clone https://github.com/andreidasilvamoreira/api-restaurant-laravel
composer install
cp .env.example .env

php artisan key:generate
php artisan migrate
php artisan serve

