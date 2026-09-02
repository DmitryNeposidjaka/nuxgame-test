# NuxGame

Laravel 13 test task with PostgreSQL and Docker (Laravel Sail).

## Requirements

- Docker
- Docker Compose
- Git
- Composer (only needed to install PHP dependencies before Sail is available)

## Installation

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd nuxgame
```

Install PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Make sure PostgreSQL is configured in `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

For locally generated links, keep:

```env
APP_URL=http://localhost
```

Start the Docker containers:

```bash
./vendor/bin/sail up -d
```

Generate the application key:

```bash
./vendor/bin/sail artisan key:generate
```

Run database migrations:

```bash
./vendor/bin/sail artisan migrate
```

Install frontend dependencies:

```bash
./vendor/bin/sail npm install
```

Build frontend assets:

```bash
./vendor/bin/sail npm run build
```

The application is now available at:

```text
http://localhost
```

## How to test the flow

1. Open `http://localhost`.
2. Enter a username and phone number and click **Register**.
3. After successful registration, a unique link is generated and displayed below the form.
4. Open the generated link to access **Page A**.
5. The link is valid for **7 days**. Expired or deactivated links cannot access Page A.
6. On Page A you can:
    - click **I'm Feeling Lucky** to generate a random number from 1 to 1000;
    - see the result (`Win` or `Lose`) and the win amount;
    - click **History** to view the last 3 game results;
    - click **Regenerate Link** to deactivate the current link and create a new one;
    - click **Deactivate Link** to disable the current link.

## Game rules

- Even number → `Win`
- Odd number → `Lose`
- Lose amount → `0`

For a winning number:

- `> 900` → 70%
- `> 600` → 50%
- `> 300` → 30%
- `<= 300` → 10%

The generated result, win status, and win amount are stored in the database so historical results remain consistent even if game rules change later.

## Useful commands

Stop containers:

```bash
./vendor/bin/sail stop
```

Start containers again:

```bash
./vendor/bin/sail up -d
```

Run migrations:

```bash
./vendor/bin/sail artisan migrate
```

Reset the database completely:

```bash
./vendor/bin/sail artisan migrate:fresh
```

Run tests:

```bash
./vendor/bin/sail artisan test
```
