CREATE TABLE IF NOT EXISTS t_dommagecollision (
	id INT(11) NOT NULL AUTO_INCREMENT,
	codeCompagnie INT(9) DEFAULT NULL,
	codeUsage VARCHAR(50) DEFAULT NULL,
	codeClasse VARCHAR(50) DEFAULT NULL,
	codeSousClasse INT(9) DEFAULT NULL,
	carburant VARCHAR(5) DEFAULT NULL,
	puissanceFiscale INT(12) DEFAULT NULL,
	formuleCollision INT(12) DEFAULT NULL,
	primeFixe DECIMAL(12,2) DEFAULT NULL,
	franchise DECIMAL(12,2) DEFAULT NULL,
	plafond DECIMAL(12,2) DEFAULT NULL,
	tauxCommission DECIMAL(12,2) DEFAULT NULL,
	tauxTPS DECIMAL(12,2) DEFAULT NULL,
	tauxTaxe DECIMAL(12,2) DEFAULT NULL,
	observation VARCHAR(255) DEFAULT NULL,
	created DATETIME DEFAULT NULL,
	createdBy VARCHAR(50) DEFAULT NULL,
	updated DATETIME DEFAULT NULL,
	updatedBy VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;