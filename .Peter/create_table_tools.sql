CREATE TABLE tools (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name tinytext NOT NULL,
    description text,
	 icon text,
	 plugin tinytext,
    controller tinytext,
    action tinytext,
	 active bool,
    created DATETIME,
    modified DATETIME
);


INSERT INTO `congos_report_tools`.`tools` (`id`, `name`, `description`, `icon`, `plugin`, `controller`, `action`, `created`, `modified`) VALUES (DEFAULT, 'Query Expander', 'Erweitere Queries um Kopien von bestehenden Data Items und ändere deren Namen und Expression mittels Search & Replace.', 'Tools/QueryExpander', 'QueryExpander', 'queries', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

