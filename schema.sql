-- ==========================================
-- Trello Clone MySQL Database Schema & Seed
-- ==========================================

CREATE DATABASE IF NOT EXISTS `trello_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `trello_db`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Workspaces Table
CREATE TABLE IF NOT EXISTS `workspaces` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `owner_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`owner_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Boards Table
CREATE TABLE IF NOT EXISTS `boards` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `workspace_id` INT NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `background_color` VARCHAR(50) DEFAULT '#4f46e5',
  `created_by` INT NOT NULL,
  `is_archived` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`workspace_id`) REFERENCES `workspaces`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Board Members Table
CREATE TABLE IF NOT EXISTS `board_members` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `board_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `role` ENUM('admin', 'member', 'viewer') DEFAULT 'member',
  `joined_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`board_id`) REFERENCES `boards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_board_user` (`board_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Lists Table
CREATE TABLE IF NOT EXISTS `lists` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `board_id` INT NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `position` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`board_id`) REFERENCES `boards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Cards Table
CREATE TABLE IF NOT EXISTS `cards` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `list_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `position` INT NOT NULL DEFAULT 0,
  `due_date` DATETIME DEFAULT NULL,
  `is_completed` TINYINT(1) DEFAULT 0,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`list_id`) REFERENCES `lists`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Labels Table
CREATE TABLE IF NOT EXISTS `labels` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `board_id` INT NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `color` VARCHAR(20) NOT NULL,
  FOREIGN KEY (`board_id`) REFERENCES `boards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Card Labels Junction Table
CREATE TABLE IF NOT EXISTS `card_labels` (
  `card_id` INT NOT NULL,
  `label_id` INT NOT NULL,
  PRIMARY KEY (`card_id`, `label_id`),
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`label_id`) REFERENCES `labels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Card Assignees Junction Table
CREATE TABLE IF NOT EXISTS `card_assignees` (
  `card_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`card_id`, `user_id`),
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Checklists Table
CREATE TABLE IF NOT EXISTS `checklists` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `card_id` INT NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. Checklist Items Table
CREATE TABLE IF NOT EXISTS `checklist_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `checklist_id` INT NOT NULL,
  `content` VARCHAR(255) NOT NULL,
  `is_checked` TINYINT(1) DEFAULT 0,
  `position` INT DEFAULT 0,
  FOREIGN KEY (`checklist_id`) REFERENCES `checklists`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. Comments Table
CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `card_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `comment_text` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 13. Attachments Table
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `card_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_type` VARCHAR(50) DEFAULT NULL,
  `file_size` INT DEFAULT NULL,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 14. Activity Logs Table
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `board_id` INT NOT NULL,
  `card_id` INT DEFAULT NULL,
  `user_id` INT NOT NULL,
  `action` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`board_id`) REFERENCES `boards`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`card_id`) REFERENCES `cards`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 15. Notifications Table
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 16. System Settings Table
CREATE TABLE IF NOT EXISTS `system_settings` (
  `setting_key` VARCHAR(100) PRIMARY KEY,
  `setting_value` TEXT DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Sample Seed Data
-- ==========================================

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role`, `status`) VALUES
(1, 'Admin User', 'admin@trello.com', '$2y$10$e9H6c0z...hashed', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80', 'admin', 'active'),
(2, 'Mahad Bukhari', 'mahad@trello.com', '$2y$10$e9H6c0z...hashed', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80', 'user', 'active'),
(3, 'Sarah Connor', 'sarah@trello.com', '$2y$10$e9H6c0z...hashed', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80', 'user', 'active'),
(4, 'Alex Johnson', 'alex@trello.com', '$2y$10$e9H6c0z...hashed', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80', 'user', 'active');

INSERT INTO `workspaces` (`id`, `name`, `description`, `owner_id`) VALUES
(1, 'Engineering Team', 'Core product development and API integrations workspace.', 1),
(2, 'Marketing & Operations', 'Brand campaigns, SEO, and social media scheduling.', 2);

INSERT INTO `boards` (`id`, `workspace_id`, `title`, `description`, `background_color`, `created_by`) VALUES
(1, 1, 'Sprint 24 - Core Architecture', 'Q3 Major Release Sprint Board for MVC and UI Refactoring.', '#4f46e5', 1),
(2, 1, 'Bug Triage & Polish', 'Customer reported issues and quick wins.', '#0284c7', 2),
(3, 2, 'Q4 Growth Marketing', 'Social ad campaigns and launch strategy.', '#059669', 3);

INSERT INTO `board_members` (`board_id`, `user_id`, `role`) VALUES
(1, 1, 'admin'),
(1, 2, 'member'),
(1, 3, 'member'),
(2, 2, 'admin'),
(3, 3, 'admin');

INSERT INTO `lists` (`id`, `board_id`, `title`, `position`) VALUES
(1, 1, 'Backlog', 1),
(2, 1, 'In Progress', 2),
(3, 1, 'Review & QA', 3),
(4, 1, 'Done', 4);

INSERT INTO `cards` (`id`, `list_id`, `title`, `description`, `position`, `due_date`, `is_completed`, `created_by`) VALUES
(1, 1, 'Design System & CSS Variables', 'Implement core enterprise color palette, Inter font, and layout structure.', 1, '2026-07-28 17:00:00', 0, 1),
(2, 1, 'Database Schema Blueprint', 'Write full SQL DDL script covering all 16 tables and relations.', 2, '2026-07-25 12:00:00', 1, 1),
(3, 2, 'Drag-and-Drop Card Functionality', 'Implement plain HTML5 drag events in user.js for board card reordering.', 1, '2026-07-30 18:00:00', 0, 2),
(4, 2, 'Card Detail Modal & Tabs', 'Build interactive modal with checklists, comments timeline, and labels.', 2, '2026-07-29 15:00:00', 0, 3),
(5, 3, 'Admin Panel Metrics Table', 'Display platform stats, active boards, and user management tables.', 1, '2026-08-01 10:00:00', 0, 1),
(6, 4, 'Custom Router & Controller Framework', 'Lightweight core PHP MVC architecture setup without database layer.', 1, '2026-07-23 20:00:00', 1, 2);

INSERT INTO `labels` (`id`, `board_id`, `name`, `color`) VALUES
(1, 1, 'Feature', '#6366f1'),
(2, 1, 'High Priority', '#ef4444'),
(3, 1, 'Design', '#10b981'),
(4, 1, 'Backend', '#f59e0b');

INSERT INTO `card_labels` (`card_id`, `label_id`) VALUES
(1, 1), (1, 3),
(3, 1), (3, 2),
(4, 3);

INSERT INTO `card_assignees` (`card_id`, `user_id`) VALUES
(1, 2), (1, 3),
(3, 2),
(4, 3), (4, 4);

INSERT INTO `checklists` (`id`, `card_id`, `title`) VALUES
(1, 3, 'HTML5 Drag & Drop Implementation Steps');

INSERT INTO `checklist_items` (`id`, `checklist_id`, `content`, `is_checked`, `position`) VALUES
(1, 1, 'Attach draggable=true to card containers', 1, 1),
(2, 1, 'Handle dragstart and dragend opacity feedback', 1, 2),
(3, 1, 'Add dragover and drop event handlers on lists', 0, 3),
(4, 1, 'Calculate insert position before adjacent cards', 0, 4);

INSERT INTO `comments` (`id`, `card_id`, `user_id`, `comment_text`) VALUES
(1, 3, 2, 'I have added the drag start listeners and styling helper classes.'),
(2, 3, 3, 'Awesome! Modal triggers are working smoothly alongside card clicks.');

INSERT INTO `system_settings` (`setting_key`, `setting_value`) VALUES
('app_title', 'Trello SaaS Workspaces'),
('max_boards_per_workspace', '25'),
('allow_public_registration', 'true'),
('theme_mode', 'light');
