# Inventory Management API

A RESTful Inventory Management API built with Laravel 12 for managing products, stock, stock movements, purchases, sales, authentication, and role-based access control.

## Features

- Authentication with Laravel Sanctum
- Role and permission management with Spatie Laravel Permission
- Product management
- Product stock management
- Stock movement tracking
- Purchase management
- Sales management
- Service Layer architecture
- Form Request validation
- API Resources
- Database transactions
- Row-level locking for stock operations
- Events and listeners
- Caching
- PHPUnit testing

## Tech Stack

- PHP 8.2+
- Laravel 12
- Laravel Sanctum
- Spatie Laravel Permission
- PHPUnit 11
- MySQL / SQLite
- Composer

## Architecture

The project follows a layered approach:

```
Route
  ↓
Controller
  ↓
Form Request
  ↓
Service
  ↓
Model / Database
  ↓
API Resource
```

Controllers are kept lightweight while services contain the main business logic.

## Main Modules

### Authentication

- Register
- Login
- Logout
- Sanctum API tokens
- Role assignment
- Protected routes

### Inventory

- Products
- Product stock
- Stock movements
- Stock quantity updates

Stock movements support incoming and outgoing quantities while keeping product stock synchronized.

### Transactions

#### Purchases

Purchases create transaction records and increase inventory according to purchased quantities.

#### Sales

Sales create transaction records and decrease inventory according to sold quantities.

## Roles & Permissions

The project uses Spatie Laravel Permission.

Current roles:

- **Admin** — full system access
- **Manager** — inventory and transaction management
- **Cashier** — product/stock viewing and sales operations

Examples:

```text
products.view
products.create
products.update
products.delete

stock.view
stock.adjust
stock-movements.view

purchases.view
purchases.create

sales.view
sales.create

users.view
users.create
users.update
users.delete
```

Public registration does not allow the client to choose a privileged role.

## Installation

Clone the repository:

```bash
git clone https://github.com/hadeer-abdulbage16/inventory-api.git
cd inventory-api
```

Install dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

On Windows:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database in `.env`, then run:

```bash
php artisan migrate
```

Run seeders when needed:

```bash
php artisan db:seed
```

Start the application:

```bash
php artisan serve
```

API base URL:

```
http://127.0.0.1:8000/api
```

## Environment Configuration

Example database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory
DB_USERNAME=root
DB_PASSWORD=
```

Never commit your real `.env` file or application secrets.

## Authentication

Register:

```http
POST /api/auth/register
```

Login:

```http
POST /api/auth/login
```

Logout:

```http
POST /api/auth/logout
Authorization: Bearer {token}
```

Authenticated requests use:

```http
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

## Testing

Run the test suite with:

```bash
php artisan test
```

or:

```bash
composer test
```

Tests use an isolated environment configured through `phpunit.xml`.

## API Testing

Postman can be used to test the API.

Typical workflow:

1. Register or create a user.
2. Login and copy the Sanctum token.
3. Use the token as a Bearer Token in Postman.
4. Test protected inventory and transaction endpoints.
5. Verify stock quantities after purchases, sales, and stock movements.

## Project Goals

This project demonstrates practical Laravel backend development, clean separation of responsibilities, authentication, authorization, inventory business rules, database consistency, and automated testing.

## Author

**Hadeer Ramadan**

GitHub: https://github.com/hadeer-abdulbage16
