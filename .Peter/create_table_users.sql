CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `secret` varchar(32) DEFAULT NULL,
  `secret_verified` tinyint DEFAULT NULL,
  `tos_date` datetime DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `is_superuser` tinyint NOT NULL DEFAULT '0',
  `role` varchar(255) DEFAULT 'user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `additional_data` text,
  `last_login` datetime DEFAULT NULL,
  `lockout_time` datetime DEFAULT NULL,
  `login_token` varchar(32) DEFAULT NULL,
  `login_token_date` datetime DEFAULT NULL,
  `token_send_requested` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `login_token` (`login_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




-- #####################################################
-- ################# ALT ALT ###########################
-- #####################################################
-- CREATE TABLE users (
    -- id INT AUTO_INCREMENT PRIMARY KEY,
    -- email VARCHAR(255) NOT NULL,
    -- password VARCHAR(255) NOT NULL,
	 -- firstname VARCHAR(255),
	 -- avatar VARCHAR(255),
	 -- avatar_crop VARCHAR(255),
    -- created DATETIME,
    -- modified DATETIME
-- );




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
