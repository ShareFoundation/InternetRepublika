
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- inappropriate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `inappropriate`;


CREATE TABLE `inappropriate`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`type` INTEGER default 1,
	`message` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `inappropriate_FI_1` (`post_id`),
	CONSTRAINT `inappropriate_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `inappropriate_FI_2` (`user_id`),
	CONSTRAINT `inappropriate_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- inappropriate_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `inappropriate_comment`;


CREATE TABLE `inappropriate_comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`comment_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `inappropriate_comment_FI_1` (`comment_id`),
	CONSTRAINT `inappropriate_comment_FK_1`
		FOREIGN KEY (`comment_id`)
		REFERENCES `comment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `inappropriate_comment_FI_2` (`user_id`),
	CONSTRAINT `inappropriate_comment_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
