
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post`;


CREATE TABLE `post`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`partie_id` INTEGER  NOT NULL,
	`replica_post_id` INTEGER,
	`type` INTEGER default 1 NOT NULL,
	`title` VARCHAR(255),
	`url` VARCHAR(255),
	`text` TEXT,
	`photo_file` VARCHAR(255),
	`photo_url` VARCHAR(255),
	`quote` TEXT,
	`quote_author` VARCHAR(255),
	`link_title` VARCHAR(255),
	`link_url` VARCHAR(255),
	`link_image` VARCHAR(255),
	`video_url` VARCHAR(255),
	`total_index` FLOAT default 0 NOT NULL,
	`best_badge_1` INTEGER  NOT NULL,
	`best_badge_2` INTEGER  NOT NULL,
	`is_published` TINYINT default 1 NOT NULL,
	`is_featured` TINYINT default 0 NOT NULL,
	`comments_count` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `post_FI_1` (`partie_id`),
	CONSTRAINT `post_FK_1`
		FOREIGN KEY (`partie_id`)
		REFERENCES `partie` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_FI_2` (`replica_post_id`),
	CONSTRAINT `post_FK_2`
		FOREIGN KEY (`replica_post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- post_poll_answer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_poll_answer`;


CREATE TABLE `post_poll_answer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`answer` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `post_poll_answer_FI_1` (`post_id`),
	CONSTRAINT `post_poll_answer_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- post_poll_vote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_poll_vote`;


CREATE TABLE `post_poll_vote`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`answer_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `post_poll_vote_FI_1` (`post_id`),
	CONSTRAINT `post_poll_vote_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_poll_vote_FI_2` (`user_id`),
	CONSTRAINT `post_poll_vote_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_poll_vote_FI_3` (`answer_id`),
	CONSTRAINT `post_poll_vote_FK_3`
		FOREIGN KEY (`answer_id`)
		REFERENCES `post_poll_answer` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
