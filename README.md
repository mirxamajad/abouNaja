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

