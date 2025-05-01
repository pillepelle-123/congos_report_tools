CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
	 firstname VARCHAR(255),
	 avatar VARCHAR(255),
	 avatar_crop VARCHAR(255),
    created DATETIME,
    modified DATETIME
);




-- CREATE TABLE `users` (
  -- `id` int NOT NULL AUTO_INCREMENT,
  -- `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  -- `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  -- `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  -- `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  -- `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  -- `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  -- PRIMARY KEY (`id`),
  -- UNIQUE KEY `username` (`username`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
