# TaskBoard API

A Task Management REST API built with Laravel 11 and MySQL.

## Live URLs

- **API**: https://web-production-314f7.up.railway.app/api
- **Frontend**: https://taskboard-frontend-six.vercel.app
- **GitHub API**: https://github.com/Kanainai/taskboard-api
- **GitHub Frontend**: https://github.com/Kanainai/taskboard-frontend

## Tech Stack

- Laravel 11 (PHP 8.3)
- MySQL 8.4
- Railway (API hosting)
- Vercel (Frontend hosting)

## Database

- Database: MySQL
- SQL Dump: database/dump.sql

## Local Setup

### Requirements

- PHP 8.2+
- Composer
- MySQL
- Node.js (for frontend)

### Steps

1. Clone the repo:
```bash
git clone https://github.com/Kanainai/taskboard-api.git
cd taskboard-api
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Configure .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate app key:
```bash
php artisan key:generate
```

6. Run migrations:
```bash
php artisan migrate
```

7. Seed database:
```bash
php artisan db:seed --class=TaskSeeder
```

8. Start server:
```bash
php artisan serve
```

API available at: http://localhost:8000

## API Endpoints

### Create Task
```http
POST /api/tasks
Content-Type: application/json

{
  "title": "Design homepage",
  "due_date": "2026-04-01",
  "priority": "high"
}
```

### List Tasks
```http
GET /api/tasks
GET /api/tasks?status=pending
GET /api/tasks?priority=high
```

### Update Task Status
```http
PATCH /api/tasks/{id}/status
```

### Delete Task
```http
DELETE /api/tasks/{id}
```
(Only tasks with status "done" can be deleted)

### Daily Report
```http
GET /api/tasks/report?date=2026-03-29
```

### Overdue Tasks
```http
GET /api/tasks/overdue
```

## Business Rules

- Title cannot duplicate on same due_date
- due_date must be today or in the future
- Status progression: pending → in_progress → done
- Cannot skip or revert status
- Only "done" tasks can be deleted (403 otherwise)
- Tasks sorted by priority (high→medium→low) then due_date

## Deployment (Railway)

1. Push code to GitHub
2. Create new project on railway.app
3. Connect GitHub repository
4. Add MySQL database plugin
5. Set environment variables:
   APP_KEY, DB_CONNECTION, DB_HOST, etc.
6. Railway auto-deploys on push

## Frontend

Built with React + Vite + Tailwind CSS

Repository: https://github.com/Kanainai/taskboard-frontend

Live: https://taskboard-frontend-six.vercel.app

## Note on Frontend Framework

React was used for the frontend dashboard as it achieves the same goal as Vue.js for polishing the interface. The Laravel API works completely independently and can be tested directly via the endpoints listed above.
