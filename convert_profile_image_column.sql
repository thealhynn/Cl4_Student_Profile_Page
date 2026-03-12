-- If you already ran the migration with LONGBLOB, use this to convert it to VARCHAR(255)
-- This will clear existing binary image data and prepare the column for filename storage

-- Option 1: If the column already exists as LONGBLOB, modify it
ALTER TABLE `users` MODIFY COLUMN `profile_image` VARCHAR(255) NULL;

-- Option 2: If you need to clear existing binary data first
UPDATE `users` SET `profile_image` = NULL WHERE `profile_image` IS NOT NULL;
ALTER TABLE `users` MODIFY COLUMN `profile_image` VARCHAR(255) NULL;

-- Verify the change
DESCRIBE `users`;
