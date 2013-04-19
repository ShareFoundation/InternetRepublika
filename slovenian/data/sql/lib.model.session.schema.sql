
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;


CREATE TABLE `session`
(
	`sess_id` VARCHAR(128)  NOT NULL,
	`sess_data` TEXT,
	`sess_time` INTEGER,
	`sess_user` INTEGER,
	PRIMARY KEY (`sess_id`)
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
