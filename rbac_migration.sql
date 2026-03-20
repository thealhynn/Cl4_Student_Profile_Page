-- ============================================================
-- rbac_migration.sql
-- RBAC Activity — Run this in phpMyAdmin or MySQL CLI
-- ============================================================

-- 1. Create roles table
CREATE TABLE IF NOT EXISTS `roles` (
    `id`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50)  NOT NULL UNIQUE,
    `label`       VARCHAR(100) NOT NULL,
    `description` TEXT         NULL,
    `created_at`  DATETIME     NULL,
    `updated_at`  DATETIME     NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Add role_id to users (skip if already exists)
ALTER TABLE `users`
    ADD COLUMN IF NOT EXISTS `role_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `email`;

-- 3. Add foreign key (skip if already exists)
ALTER TABLE `users`
    ADD CONSTRAINT `fk_users_role_id`
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
    ON DELETE SET NULL ON UPDATE CASCADE;

-- 4. Insert core roles
INSERT IGNORE INTO `roles` (`name`, `label`, `description`, `created_at`, `updated_at`) VALUES
('admin',       'Administrator',         'Full access to all modules.',                          NOW(), NOW()),
('teacher',     'Teacher',               'Access to dashboard, students, and items.',            NOW(), NOW()),
('student',     'Student',               'Access to own dashboard and profile only.',            NOW(), NOW()),
('coordinator', 'Department Coordinator','Challenge role — requires CoordinatorFilter.php.',     NOW(), NOW());

-- 5. Insert demo users (password = Password1)
-- BCrypt hash of "Password1"
SET @hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.';

INSERT IGNORE INTO `users` (`name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
('Admin User',           'admin@school.edu',       @hash, (SELECT id FROM roles WHERE name='admin'),       NOW(), NOW()),
('Teacher Cruz',         'teacher@school.edu',     @hash, (SELECT id FROM roles WHERE name='teacher'),     NOW(), NOW()),
('Student Reyes',        'student@school.edu',     @hash, (SELECT id FROM roles WHERE name='student'),     NOW(), NOW()),
('Coordinator Bautista', 'coordinator@school.edu', @hash, (SELECT id FROM roles WHERE name='coordinator'), NOW(), NOW());
