-- TaskBoard Database Dump
-- Database: task_manager
-- Generated: March 2026
-- MySQL Version: 8.4

-- Create tasks table
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `status` enum('pending','in_progress','done') NOT NULL DEFAULT 'pending',
  `assigned_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
INSERT INTO `tasks` (`title`, `due_date`, `priority`, `status`, `assigned_to`, `created_at`, `updated_at`) VALUES
('Design homepage', '2026-04-02', 'high', 'pending', 'Rose Mwau', NOW(), NOW()),
('Fix login bug', '2026-04-03', 'high', 'pending', 'Rose Mwau', NOW(), NOW()),
('Write unit tests', '2026-04-04', 'medium', 'pending', 'Rose Mwau', NOW(), NOW()),
('Update documentation', '2026-04-07', 'low', 'pending', 'Rose Mwau', NOW(), NOW()),
('Code review PR #123', '2026-04-05', 'high', 'pending', 'Rose Mwau', NOW(), NOW()),
('Refactor authentication', '2026-04-11', 'medium', 'pending', 'Rose Mwau', NOW(), NOW()),
('Setup CI/CD pipeline', '2026-04-06', 'high', 'pending', 'Rose Mwau', NOW(), NOW()),
('Database optimization', '2026-04-08', 'medium', 'pending', 'Rose Mwau', NOW(), NOW()),
('Security audit', '2026-04-03', 'high', 'pending', 'Rose Mwau', NOW(), NOW()),
('Mobile responsive fixes', '2026-04-10', 'medium', 'pending', 'Rose Mwau', NOW(), NOW()),
('API documentation', '2026-04-09', 'low', 'pending', 'Rose Mwau', NOW(), NOW()),
('Performance testing', '2026-04-01', 'medium', 'in_progress', 'Rose Mwau', NOW(), NOW()),
('User feedback analysis', '2026-04-06', 'low', 'done', 'Rose Mwau', NOW(), NOW()),
('Deploy to staging', '2026-04-02', 'high', 'in_progress', 'Rose Mwau', NOW(), NOW()),
('Write a proposal', '2026-04-05', 'medium', 'pending', 'Rose Mwau', NOW(), NOW());

-- To import this dump:
-- mysql -u root -p task_manager < dump.sql

-- To run locally:
-- 1. Create database: CREATE DATABASE task_manager;
-- 2. Import: mysql -u root -p task_manager < dump.sql
-- 3. Run: php artisan serve
