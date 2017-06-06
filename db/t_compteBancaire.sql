CREATE TABLE IF NOT EXISTS t_comptebancaire (
	id INT(11) NOT NULL AUTO_INCREMENT,
	numero VARCHAR(255) DEFAULT NULL,
	designation VARCHAR(255) DEFAULT NULL,
	dateCreation DATE DEFAULT NULL,
	created DATETIME DEFAULT NULL,
	createdBy VARCHAR(50) DEFAULT NULL,
	updated DATETIME DEFAULT NULL,
	updatedBy VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;