CREATE TABLE IF NOT EXISTS t_cheque (
	id INT(11) NOT NULL AUTO_INCREMENT,
	dateRecu DATE DEFAULT NULL,
	numero VARCHAR(100) DEFAULT NULL,
	designationSociete VARCHAR(100) DEFAULT NULL,
	designationPersonne VARCHAR(100) DEFAULT NULL,
	montant DECIMAL(12,2) DEFAULT NULL,
	status VARCHAR(10) DEFAULT NULL,
	url TEXT DEFAULT NULL,
	compteBancaire VARCHAR(100) DEFAULT NULL,
	created DATETIME DEFAULT NULL,
	createdBy VARCHAR(50) DEFAULT NULL,
	updated DATETIME DEFAULT NULL,
	updatedBy VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;