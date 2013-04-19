
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- badge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `badge`;


CREATE TABLE `badge`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_id` INTEGER  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`place_count` INTEGER default 0,
	`image` VARCHAR(255),
	`style` VARCHAR(255),
	`order` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `badge_FI_1` (`type_id`),
	CONSTRAINT `badge_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `badge_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- badge_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `badge_type`;


CREATE TABLE `badge_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- post_badge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_badge`;


CREATE TABLE `post_badge`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`badge_id` INTEGER  NOT NULL,
	`post_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`type_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `post_badge_FI_1` (`badge_id`),
	CONSTRAINT `post_badge_FK_1`
		FOREIGN KEY (`badge_id`)
		REFERENCES `badge` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_badge_FI_2` (`post_id`),
	CONSTRAINT `post_badge_FK_2`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_badge_FI_3` (`user_id`),
	CONSTRAINT `post_badge_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_badge_FI_4` (`type_id`),
	CONSTRAINT `post_badge_FK_4`
		FOREIGN KEY (`type_id`)
		REFERENCES `badge_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
