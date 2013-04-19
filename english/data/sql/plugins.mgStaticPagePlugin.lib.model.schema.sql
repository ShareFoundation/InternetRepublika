
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- mg_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mg_page`;


CREATE TABLE `mg_page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`label` VARCHAR(255)  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`title` VARCHAR(255),
	`meta_title` VARCHAR(255),
	`meta_description` TEXT,
	`meta_keywords` TEXT,
	`text` TEXT,
	`is_published` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `mg_page_U_1` (`label`),
	UNIQUE KEY `mg_page_U_2` (`url`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- mg_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mg_content`;


CREATE TABLE `mg_content`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`label` VARCHAR(255)  NOT NULL,
	`title` VARCHAR(255)  NOT NULL,
	`text` TEXT,
	`is_published` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `mg_content_U_1` (`label`)
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
