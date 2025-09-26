## Run without Docker (Local PHP)

If you prefer to run the API without Docker, ensure you have PHP 8.2+ and Composer installed.

### Option A: MySQL (recommended)

1. Copy env and set app URL
```
copy .env.example .env
```
Edit `.env` and set:
```
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password

SESSION_DRIVER=file
CACHE_STORE=file
```

2. Install dependencies and generate key
- POST `/api/expenses` – Create expense
- GET `/api/expenses/{id}` – Show expense
- PUT `/api/expenses/{id}` – Update expense
- DELETE `/api/expenses/{id}` – Delete expense

Request validation via Form Requests. Responses are formatted with Laravel Resources.

## Module Structure

```
Modules/Expenses/
  Domain/
    Enums/ExpenseCategory.php
    Models/Expense.php
  Database/migrations/2025_09_26_000000_create_expenses_table.php
  Events/ExpenseCreated.php
  Http/
    Controllers/ExpenseController.php
    Requests/{Store,Update}ExpenseRequest.php
    Resources/{ExpenseResource,ExpenseCollection}.php
  Listeners/SendExpenseCreatedNotification.php
  Providers/ExpensesServiceProvider.php
  Repositories/
    ExpenseRepositoryInterface.php
    Eloquent/ExpenseRepository.php
  Services/ExpenseService.php
  routes/api.php
```

## Architecture & Decisions

- **Modular structure**: All domain, http, and infrastructure code for expenses is isolated under `Modules/Expenses/`.
- **Service layer (mandatory)**: Business logic centralized in `ExpenseService`.
- **Repository pattern (optional)**: `ExpenseRepositoryInterface` with Eloquent implementation for testability and clear boundaries.
- **Form Requests**: Input validation for create/update.
- **Resources**: Consistent API formatting using `ExpenseResource` and `ExpenseCollection`.
- **Events**: `ExpenseCreated` event with a demo listener that logs creation. Can be extended to notifications.
- **HTTP Status Codes**: Uses Symfony HttpFoundation response codes.

## Database

`docker-compose.yml` provisions MySQL 8.0:

- Host: `db`
- Port: `3306` (exposed as `3307` on host)
- DB: `expense`
- User/Pass: `expense/expense`

`.env.example` is preconfigured for MySQL. After copying to `.env`, run migrations.

## Testing

Feature test included:

`tests/Feature/ExpensesApiTest.php`

Run tests:
```
docker exec -it expense_app php artisan test
```

By default, tests use an in-memory sqlite database as configured in `phpunit.xml`.

## Optional Bonuses

- OpenAPI/Swagger (Scribe) can be added if desired. Command to install:
```
docker exec -it expense_app composer require knuckleswtf/scribe --dev
```

## Assumptions

- No authentication required (per assessment).
- Categories implemented as Enum; no dedicated Category module.

## Time Spent

- Scaffolding & Dockerization: ~30-40 min
- Module implementation (CRUD, Service, Repo, Events): ~40-60 min
- Tests & README: ~20-30 min
