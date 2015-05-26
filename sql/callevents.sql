/*This table contains contact information*/
CREATE TABLE IF NOT EXISTS `contact` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`firstName` TINYTEXT NOT NULL COLLATE 'utf8_bin',
	`lastName` TINYTEXT NOT NULL COLLATE 'utf8_bin',
	`phone` TINYTEXT NOT NULL COLLATE 'utf8_bin',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_bin'
ENGINE=MyISAM;

/*This table contains notes which are inserted when calls are placed.*/
CREATE TABLE IF NOT EXISTS `note` (
	`customerId` INT(10) UNSIGNED NOT NULL,
	`notes` TEXT NULL COLLATE 'utf8_bin'
)
COLLATE='utf8_bin'
ENGINE=MyISAM;

INSERT INTO `contact` (`firstName`, `lastName`, `phone`) VALUES ('Alan', 'John', '002');
INSERT INTO `contact` (`firstName`, `lastName`, `phone`) VALUES ('John', 'Doe', '003');