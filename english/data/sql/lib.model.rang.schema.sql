
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- post_visits
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_visits`;


CREATE TABLE `post_visits`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`user_id` INTEGER,
	`cookie_id` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `post_visits_FI_1` (`post_id`),
	CONSTRAINT `post_visits_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_visits_FI_2` (`user_id`),
	CONSTRAINT `post_visits_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- partie_visits
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `partie_visits`;


CREATE TABLE `partie_visits`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`partie_id` INTEGER  NOT NULL,
	`user_id` INTEGER,
	`cookie_id` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `partie_visits_FI_1` (`partie_id`),
	CONSTRAINT `partie_visits_FK_1`
		FOREIGN KEY (`partie_id`)
		REFERENCES `partie` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `partie_visits_FI_2` (`user_id`),
	CONSTRAINT `partie_visits_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- post_daily_stats
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_daily_stats`;


CREATE TABLE `post_daily_stats`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`like` INTEGER default 0 NOT NULL,
	`twitt` INTEGER default 0 NOT NULL,
	`comment` INTEGER default 0 NOT NULL,
	`badge` INTEGER default 0 NOT NULL,
	`views` INTEGER default 0 NOT NULL,
	`current_index` FLOAT default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `post_daily_stats_FI_1` (`post_id`),
	CONSTRAINT `post_daily_stats_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- partie_daily_stats
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `partie_daily_stats`;


CREATE TABLE `partie_daily_stats`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`partie_id` INTEGER  NOT NULL,
	`like` INTEGER default 0 NOT NULL,
	`twitt` INTEGER default 0 NOT NULL,
	`comment` INTEGER default 0 NOT NULL,
	`badge` INTEGER default 0 NOT NULL,
	`views` INTEGER default 0 NOT NULL,
	`current_index` FLOAT default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `partie_daily_stats_FI_1` (`partie_id`),
	CONSTRAINT `partie_daily_stats_FK_1`
		FOREIGN KEY (`partie_id`)
		REFERENCES `partie` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- post_index
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_index`;


CREATE TABLE `post_index`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`daily` FLOAT default 0 NOT NULL,
	`weekly` FLOAT default 0 NOT NULL,
	`total` FLOAT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `post_index_FI_1` (`post_id`),
	CONSTRAINT `post_index_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- partie_index
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `partie_index`;


CREATE TABLE `partie_index`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`partie_id` INTEGER  NOT NULL,
	`daily` FLOAT default 0 NOT NULL,
	`weekly` FLOAT default 0 NOT NULL,
	`total` FLOAT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `partie_index_FI_1` (`partie_id`),
	CONSTRAINT `partie_index_FK_1`
		FOREIGN KEY (`partie_id`)
		REFERENCES `partie` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- partie_custom_points
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `partie_custom_points`;


CREATE TABLE `partie_custom_points`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`partie_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`points` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `partie_custom_points_FI_1` (`partie_id`),
	CONSTRAINT `partie_custom_points_FK_1`
		FOREIGN KEY (`partie_id`)
		REFERENCES `partie` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `partie_custom_points_FI_2` (`user_id`),
	CONSTRAINT `partie_custom_points_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
