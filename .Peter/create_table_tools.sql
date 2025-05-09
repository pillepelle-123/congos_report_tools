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


INSERT INTO `tools` (`id`,`name`,`description`,`icon`,`plugin`,`controller`,`action`,`active`,`created`,`modified`) VALUES (DEFAULT,'Query Expander','Erweitere Queries um Kopien von bestehenden Data Items und ändere deren Namen und Expression mittels Search & Replace.','/img/icons/app_query_expander_ffffff.svg','QueryExpander','QueryExpander','queries',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

-- INSERT INTO `tools` (`id`,`name`,`description`,`icon`,`plugin`,`controller`,`action`,`active`,`created`,`modified`) VALUES (1,'Query Expander','Erweitere Queries um Kopien von bestehenden Data Items und ändere deren Namen und Expression mittels Search & Replace.','/img/icons/app_query_expander_ffffff.svg','QueryExpander','QueryExpander','queries',0,'2025-05-08 00:00:00','2025-05-08 00:00:00');

