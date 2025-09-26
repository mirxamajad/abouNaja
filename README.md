# Expense Module (Laravel 12)

Self-contained Expense Management module built in a modular architecture under `Modules/Expenses/`.  
Includes Service layer, Repository pattern, Form Requests, Resources, Events/Listeners, Feature test, Scribe docs, and seeders.

---

## Requirements

- PHP 8.2+ with extensions: `pdo_mysql`, `intl`, `zip`, `xml`  
- Composer  
- Database: MySQL 8 (recommended) or SQLite  

---

## Quick Start

### 1. Copy environment file
cp .env.example .env

### 2. Update `.env` file
For MySQL:
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
SESSION_DRIVER=file
CACHE_STORE=file

For SQLite (alternative, no DB server required):
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_STORE=file

---

### 3. Install dependencies and generate key
composer install
composer dump-autoload
php artisan key:generate

---

### 4. Run migrations
php artisan migrate

---

### 5. Serve the app
php artisan serve

- Base URL: http://127.0.0.1:8000  
- Health: http://127.0.0.1:8000/api/health  

---

## API Reference
Base URL: http://127.0.0.1:8000/api

Endpoints:
- GET /health – Service health check  
- GET /expenses – List expenses (filters: category, date_from, date_to, per_page)  
- POST /expenses – Create expense  
- GET /expenses/{id} – Show expense  
- PUT /expenses/{id} – Update expense  
- DELETE /expenses/{id} – Delete expense  

Example (curl):
curl -s -X POST http://127.0.0.1:8000/api/expenses   -H "Content-Type: application/json"   -d '{"title":"Lunch","amount":12.5,"category":"food","expense_date":"2025-09-25","notes":"Caesar salad"}'

Docs: 
- Postman Collection: postman/Expenses.postman_collection.json  

---

## Seeding

Seed demo expenses:
php artisan db:seed --class=ExpensesSeeder

Default count: 50 (edit in database/seeders/ExpensesSeeder.php):
Expense::factory()->count(50)->create();

## Architecture & Decisions

- Modular structure – all domain, HTTP, and infrastructure code for expenses is under `Modules/Expenses/`.  
- Service layer – business logic in `ExpenseService`.  
- Repository pattern – `ExpenseRepositoryInterface` with Eloquent implementation.  
- Form Requests – request validation for create/update.  
- Resources – API formatting with `ExpenseResource` & `ExpenseCollection`.  
- Events & Listeners – `ExpenseCreated` + notification logger.  
- HTTP Status Codes – proper Symfony HttpFoundation codes.  

---

## Testing

Feature test included:  
tests/Feature/ExpensesApiTest.php

Run tests:
php artisan test

Tests use in-memory SQLite (see phpunit.xml).

---
