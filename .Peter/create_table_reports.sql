CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    xml longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	 user_id INT NOT NULL,
    created DATETIME,
    modified DATETIME
);

-- bin/cake bake migration CreateReports name:string xml:longtext user_id:integer created modified


-- CREATE TABLE `reports` (
  -- `id` int NOT NULL AUTO_INCREMENT,
  -- `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dummy',
  -- `report_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  -- `report_xml` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  -- `upload_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  -- PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



