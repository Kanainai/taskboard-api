# Task Manager API

A Laravel 11 REST API for managing tasks with priority levels and status tracking.

## Tech Stack

- Laravel 11
- PHP 8.3
- MySQL
- RESTful API architecture

## Features

- Create tasks with title, due date, and priority
- Update task status (pending → in_progress → done)
- Delete completed tasks
- Filter tasks by status and priority
- Daily task reports grouped by priority and status
- Overdue task tracking
- CORS enabled for frontend integration

## Local Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL
- Git

### Installation Steps

1. Clone the repository
```bash
git clone <repository-url>
cd task-manager-api
```

2. Install dependencies
```bash
composer install
```

3. Configure environment
```bash
cp .env.example .env
```

4. Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate application key
```bash
php artisan key:generate
```

6. Create database
```bash
mysql -u root -p
CREATE DATABASE task_manager;
exit;
```

7. Run migrations and seed database

**Option A: Using migrations and seeder (recommended for development)**
```bash
php artisan migrate
php artisan db:seed --class=TaskSeeder
```

**Option B: Import database dump (includes sample data)**
```bash
mysql -u root task_manager < database/dump.sql
```

8. Start development server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## API Endpoints

### Create Task
```bash
POST /api/tasks
Content-Type: application/json

{
  "title": "Design homepage",
  "due_date": "2026-04-01",
  "priority": "high"
}

# Response: 201 Created
{
  "id": 1,
  "title": "Design homepage",
  "due_date": "2026-04-01",
  "priority": "high",
  "status": "pending",
  "created_at": "2026-03-28T10:00:00.000000Z",
  "updated_at": "2026-03-28T10:00:00.000000Z"
}
```

### List Tasks
```bash
GET /api/tasks
# Optional query parameters: ?status=pending&priority=high

# Response: 200 OK
[
  {
    "id": 1,
    "title": "Design homepage",
    "due_date": "2026-04-01",
    "priority": "high",
    "status": "pending",
    "created_at": "2026-03-28T10:00:00.000000Z",
    "updated_at": "2026-03-28T10:00:00.000000Z"
  }
]
```

### Update Task Status
```bash
PATCH /api/tasks/1/status

# Response: 200 OK
{
  "id": 1,
  "title": "Design homepage",
  "due_date": "2026-04-01",
  "priority": "high",
  "status": "in_progress",
  "created_at": "2026-03-28T10:00:00.000000Z",
  "updated_at": "2026-03-28T10:00:00.000000Z"
}
```

### Delete Task
```bash
DELETE /api/tasks/1
# Note: Only tasks with status "done" can be deleted

# Response: 204 No Content
```

### Get Daily Report
```bash
GET /api/tasks/report?date=2026-03-28

# Response: 200 OK
{
  "date": "2026-03-28",
  "summary": {
    "high": {
      "pending": 2,
      "in_progress": 1,
      "done": 0
    },
    "medium": {
      "pending": 3,
      "in_progress": 0,
      "done": 1
    },
    "low": {
      "pending": 1,
      "in_progress": 0,
      "done": 2
    }
  }
}
```

### Get Overdue Tasks
```bash
GET /api/tasks/overdue

# Response: 200 OK
[
  {
    "id": 9,
    "title": "Update dependencies",
    "due_date": "2026-03-26",
    "priority": "low",
    "status": "pending",
    "created_at": "2026-03-28T10:00:00.000000Z",
    "updated_at": "2026-03-28T10:00:00.000000Z"
  }
]
```

## Database

### Database Dump

A MySQL dump file is included in `database/dump.sql` with the complete database schema and sample data. This can be used to quickly set up the database without running migrations and seeders.

**To import the dump:**
```bash
mysql -u root task_manager < database/dump.sql
```

**To create a new dump (after making changes):**
```bash
mysqldump -u root task_manager > database/dump.sql
```

### Database Schema

**tasks table:**
- `id` - Primary key
- `title` - Task title (string, required)
- `due_date` - Due date (date, required)
- `priority` - Priority level (enum: low, medium, high)
- `status` - Current status (enum: pending, in_progress, done)
- `assigned_to` - Assignee name (string, nullable)
- `created_at` - Timestamp
- `updated_at` - Timestamp

## Business Rules

1. **Task Creation**
   - Title is required
   - Due date must be today or in the future
   - Priority must be: low, medium, or high
   - No duplicate titles on the same due date

2. **Status Updates**
   - Status can only move forward: pending → in_progress → done
   - Cannot skip statuses or revert

3. **Task Deletion**
   - Only tasks with status "done" can be deleted
   - Returns 403 Forbidden if status is not "done"

4. **Task Sorting**
   - Sorted by priority (high → medium → low)
   - Then by due date (ascending)

## Deployment

### Railway Deployment

1. Push code to GitHub
2. Connect repository to Railway
3. Add MySQL database service
4. Set environment variables in Railway dashboard
5. Deploy automatically on push

### Live URLs

- API: `[Your Railway URL]`
- Dashboard: `[Your Vercel URL]`

## Testing

Run the test suite:
```bash
php artisan test
```

## License

This project is open-sourced software licensed under the MIT license.

## Screenshots

[Add screenshots of API responses using Postman or similar tools]
