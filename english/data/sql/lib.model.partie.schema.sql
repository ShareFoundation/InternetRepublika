
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- partie
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `partie`;


CREATE TABLE `partie`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`bio` TEXT(1000)  NOT NULL,
	`logo` VARCHAR(255),
	`url` VARCHAR(255),
	`facebook_page` TEXT,
	`total_index` FLOAT default 0 NOT NULL,
	`is_published` TINYINT default 1 NOT NULL,
	`comments_count` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `partie_FI_1` (`user_id`),
	CONSTRAINT `partie_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
