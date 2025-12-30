# Mini CRM (Laravel 12)

Mini CRM for collecting and processing website feedback.

## Requirements

- Docker
- Docker Compose

## Installation

1. Add domain to `/etc/hosts`:
   127.0.0.1 smartcrm

2. Clone the repository:
   git clone https://github.com/Andreywp/smartcrm


3. Go to project directory:
   cd project

4. Copy environment file:
   cp .env.example .env


5. Check `.env` configuration:
   APP_URL=https://smartcrm
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=smartcrm_ecommerce_db
   DB_USERNAME=root
   DB_PASSWORD=root123

6. Build and start containers:
   docker compose up -d --build


7. Install dependencies and run migrations:
   docker compose exec -u 1000 app composer install
   docker compose exec -u 1000 app php artisan migrate --seed


8. Build frontend assets:
   docker exec -it smartcrm_app bash
   npm run build


## Access

- Widget:  
  https://smartcrm/widget

- Login page:  
  https://smartcrm/login

## Test Users

### Admin
- Email: admin@example.com
- Password: password

### Manager
- Email: manager@example.com
- Password: password

Only **Manager** can access the admin panel.

## Widget Usage

Widget is available at:
https://smartcrm/widget


Embed example:
```html
<iframe 
    src="https://smartcrm/widget" 
    width="100%" 
    height="420" 
    frameborder="0">
</iframe>

API Endpoints
Create ticket

POST /api/tickets

Payload:
{
  "name": "John Doe",
  "email": "john@mail.com",
  "phone": "+49123456789",
  "subject": "Payment issue",
  "message": "Payment does not work"
}

Ticket statistics

GET /api/tickets/statistics

Response:
{
  "today": 2,
  "week": 5,
  "month": 12
}

Notes

Business validation is handled via FormRequest
Ticket submission is limited to one per day per email or phone
Files are handled using spatie/laravel-medialibrary
Roles and permissions via spatie/laravel-permission
Simple Blade-based admin panel


