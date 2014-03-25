CREATE TABLE `audittrail` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`table_name` VARCHAR(100) NULL DEFAULT NULL,
	`record_id` INT(11) NULL DEFAULT NULL,
	`message` VARCHAR(200) NULL DEFAULT NULL,
	`timestamp` TIMESTAMP NULL DEFAULT NULL,
	`username` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3;

CREATE TABLE `authassignment` (
	`itemname` VARCHAR(64) NOT NULL,
	`userid` VARCHAR(64) NOT NULL,
	`bizrule` TEXT NULL,
	`data` TEXT NULL,
	PRIMARY KEY (`itemname`, `userid`),
	CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

CREATE TABLE `authitem` (
	`name` VARCHAR(64) NOT NULL,
	`type` INT(11) NOT NULL,
	`description` TEXT NULL,
	`bizrule` TEXT NULL,
	`data` TEXT NULL,
	PRIMARY KEY (`name`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

CREATE TABLE `authitemchild` (
	`parent` VARCHAR(64) NOT NULL,
	`child` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`parent`, `child`),
	INDEX `child` (`child`),
	CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

CREATE TABLE `prize_t` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`desc` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Prize description',
	`offer_date` DATE NULL DEFAULT NULL COMMENT 'Date prize is available on',
	`qty` INT(11) NULL DEFAULT NULL COMMENT 'number of these prizes available',
	`timestamp` TIMESTAMP NULL DEFAULT NULL,
	`reference` VARCHAR(50) NULL DEFAULT NULL COMMENT 'unique string used it identify this record',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `reference` (`reference`)
)
COMMENT='the prize that is offer on #offer_date. '
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=17;

CREATE TABLE `profiles` (
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,
	`lastname` VARCHAR(50) NOT NULL DEFAULT '',
	`firstname` VARCHAR(50) NOT NULL DEFAULT '',
	PRIMARY KEY (`user_id`),
	CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3;

CREATE TABLE `profiles_fields` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`varname` VARCHAR(50) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`field_type` VARCHAR(50) NOT NULL,
	`field_size` VARCHAR(15) NOT NULL DEFAULT '0',
	`field_size_min` VARCHAR(15) NOT NULL DEFAULT '0',
	`required` INT(1) NOT NULL DEFAULT '0',
	`match` VARCHAR(255) NOT NULL DEFAULT '',
	`range` VARCHAR(255) NOT NULL DEFAULT '',
	`error_message` VARCHAR(255) NOT NULL DEFAULT '',
	`other_validator` VARCHAR(5000) NOT NULL DEFAULT '',
	`default` VARCHAR(255) NOT NULL DEFAULT '',
	`widget` VARCHAR(255) NOT NULL DEFAULT '',
	`widgetparams` VARCHAR(5000) NOT NULL DEFAULT '',
	`position` INT(3) NOT NULL DEFAULT '0',
	`visible` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `varname` (`varname`, `widget`, `visible`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3;

CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(20) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	`email` VARCHAR(128) NOT NULL,
	`activkey` VARCHAR(128) NOT NULL DEFAULT '',
	`create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`lastvisit_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`superuser` INT(1) NOT NULL DEFAULT '0',
	`status` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`username`),
	UNIQUE INDEX `email` (`email`),
	INDEX `status` (`status`),
	INDEX `superuser` (`superuser`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=4;

CREATE TABLE `user_entry_t` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`invoice_no` VARCHAR(8) NULL DEFAULT '0',
	`timestamp` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='Invoice number entered by user.'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=54;

CREATE TABLE `winning_number_t` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`invoice_no` VARCHAR(50) NULL DEFAULT '0' COMMENT 'winning invoice number',
	`prize_id` INT(11) NULL DEFAULT NULL,
	`claimed` TINYINT(4) NULL DEFAULT '0' COMMENT '0 : not yet claimed 1:prize claimed',
	`timestamp` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `invoice_no` (`invoice_no`)
)
COMMENT='invoice number corresponding to a prize. '
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=40;

CREATE TABLE `yiilog` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`level` VARCHAR(128) NULL DEFAULT NULL,
	`category` VARCHAR(128) NULL DEFAULT NULL,
	`logtime` INT(11) NULL DEFAULT NULL,
	`message` TEXT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=414;
