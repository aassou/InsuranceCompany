<?php
class ContratAutoManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(ContratAuto $contratAuto){
        $query = $this->_db->prepare(' INSERT INTO t_contratauto (
		codeClient, referenceCabinet, idCompagnie, terme, police, avenant, typeAffaire, attestation, quittance, apporteur, idBranche, idUsage, idClasse, idSousClasse, marque, matricule, definitiveProvisoire, puissanceFiscale, nombrePlaces, carburant, dateProduction, dateEffet, nombreMois, dateEcheance, primeRC, defenseRecours, tierce, collision, vol, incendie, brisGlace, individuel, primeNette, taxeAuto, taxePTA, totalTaxe, montantPTA, timbre, accessoires, primeTotale, commissionAuto, commissionPTA, totalCommission, TPSAuto, TPSPTA, totalTPS, created, createdBy)
		VALUES (:codeClient,:referenceCabinet, :idCompagnie, :terme, :police, :avenant, :typeAffaire, :attestation, :quittance, :apporteur, :idBranche, :idUsage, :idClasse, :idSousClasse, :marque, :matricule, :definitiveProvisoire, :puissanceFiscale, :nombrePlaces, :carburant, :dateProduction, :dateEffet, :nombreMois, :dateEcheance, :primeRC, :defenseRecours, :tierce, :collision, :vol, :incendie, :brisGlace, :individuel, :primeNette, :taxeAuto, :taxePTA, :totalTaxe, :montantPTA, :timbre, :accessoires, :primeTotale, :commissionAuto, :commissionPTA, :totalCommission, :TPSAuto, :TPSPTA, :totalTPS, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':codeClient', $contratAuto->codeClient());
		$query->bindValue(':referenceCabinet', $contratAuto->referenceCabinet());
		$query->bindValue(':idCompagnie', $contratAuto->idCompagnie());
		$query->bindValue(':terme', $contratAuto->terme());
		$query->bindValue(':police', $contratAuto->police());
		$query->bindValue(':avenant', $contratAuto->avenant());
		$query->bindValue(':typeAffaire', $contratAuto->typeAffaire());
		$query->bindValue(':attestation', $contratAuto->attestation());
		$query->bindValue(':quittance', $contratAuto->quittance());
		$query->bindValue(':apporteur', $contratAuto->apporteur());
		$query->bindValue(':idBranche', $contratAuto->idBranche());
		$query->bindValue(':idUsage', $contratAuto->idUsage());
		$query->bindValue(':idClasse', $contratAuto->idClasse());
		$query->bindValue(':idSousClasse', $contratAuto->idSousClasse());
		$query->bindValue(':marque', $contratAuto->marque());
		$query->bindValue(':matricule', $contratAuto->matricule());
		$query->bindValue(':definitiveProvisoire', $contratAuto->definitiveProvisoire());
		$query->bindValue(':puissanceFiscale', $contratAuto->puissanceFiscale());
		$query->bindValue(':nombrePlaces', $contratAuto->nombrePlaces());
		$query->bindValue(':carburant', $contratAuto->carburant());
		$query->bindValue(':dateProduction', $contratAuto->dateProduction());
		$query->bindValue(':dateEffet', $contratAuto->dateEffet());
		$query->bindValue(':nombreMois', $contratAuto->nombreMois());
		$query->bindValue(':dateEcheance', $contratAuto->dateEcheance());
		$query->bindValue(':primeRC', $contratAuto->primeRC());
		$query->bindValue(':defenseRecours', $contratAuto->defenseRecours());
		$query->bindValue(':tierce', $contratAuto->tierce());
		$query->bindValue(':collision', $contratAuto->collision());
		$query->bindValue(':vol', $contratAuto->vol());
		$query->bindValue(':incendie', $contratAuto->incendie());
		$query->bindValue(':brisGlace', $contratAuto->brisGlace());
		$query->bindValue(':individuel', $contratAuto->individuel());
		$query->bindValue(':primeNette', $contratAuto->primeNette());
		$query->bindValue(':taxeAuto', $contratAuto->taxeAuto());
		$query->bindValue(':taxePTA', $contratAuto->taxePTA());
		$query->bindValue(':totalTaxe', $contratAuto->totalTaxe());
		$query->bindValue(':montantPTA', $contratAuto->montantPTA());
		$query->bindValue(':timbre', $contratAuto->timbre());
		$query->bindValue(':accessoires', $contratAuto->accessoires());
		$query->bindValue(':primeTotale', $contratAuto->primeTotale());
		$query->bindValue(':commissionAuto', $contratAuto->commissionAuto());
		$query->bindValue(':commissionPTA', $contratAuto->commissionPTA());
		$query->bindValue(':totalCommission', $contratAuto->totalCommission());
		$query->bindValue(':TPSAuto', $contratAuto->TPSAuto());
		$query->bindValue(':TPSPTA', $contratAuto->TPSPTA());
		$query->bindValue(':totalTPS', $contratAuto->totalTPS());
		$query->bindValue(':created', $contratAuto->created());
		$query->bindValue(':createdBy', $contratAuto->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(ContratAuto $contratAuto){
        $query = $this->_db->prepare(' UPDATE t_contratauto SET 
		codeClient=:codeClient, referenceCabinet=:referenceCabinet, idCompagnie=:idCompagnie, 
		terme=:terme, police=:police, avenant=:avenant, typeAffaire=:typeAffaire, attestation=:attestation, 
		quittance=:quittance, apporteur=:apporteur, idBranche=:idBranche, idUsage=:idUsage, idClasse=:idClasse, 
		idSousClasse=:idSousClasse, marque=:marque, matricule=:matricule, definitiveProvisoire=:definitiveProvisoire, 
		puissanceFiscale=:puissanceFiscale, nombrePlaces=:nombrePlaces, carburant=:carburant, 
		dateProduction=:dateProduction, dateEffet=:dateEffet, nombreMois=:nombreMois, dateEcheance=:dateEcheance, 
		primeRC=:primeRC, defenseRecours=:defenseRecours, tierce=:tierce, collision=:collision, vol=:vol, 
		incendie=:incendie, brisGlace=:brisGlace, individuel=:individuel, primeNette=:primeNette, 
		taxeAuto=:taxeAuto, taxePTA=:taxePTA, totalTaxe=:totalTaxe, montantPTA=:montantPTA, timbre=:timbre, 
		accessoires=:accessoires, primeTotale=:primeTotale, commissionAuto=:commissionAuto, 
		commissionPTA=:commissionPTA, totalCommission=:totalCommission, TPSAuto=:TPSAuto, TPSPTA=:TPSPTA, 
		totalTPS=:totalTPS, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $contratAuto->id());
        $query->bindValue(':codeClient', $contratAuto->codeClient());
		$query->bindValue(':referenceCabinet', $contratAuto->referenceCabinet());
		$query->bindValue(':idCompagnie', $contratAuto->idCompagnie());
		$query->bindValue(':terme', $contratAuto->terme());
		$query->bindValue(':police', $contratAuto->police());
		$query->bindValue(':avenant', $contratAuto->avenant());
		$query->bindValue(':typeAffaire', $contratAuto->typeAffaire());
		$query->bindValue(':attestation', $contratAuto->attestation());
		$query->bindValue(':quittance', $contratAuto->quittance());
		$query->bindValue(':apporteur', $contratAuto->apporteur());
		$query->bindValue(':idBranche', $contratAuto->idBranche());
		$query->bindValue(':idUsage', $contratAuto->idUsage());
		$query->bindValue(':idClasse', $contratAuto->idClasse());
		$query->bindValue(':idSousClasse', $contratAuto->idSousClasse());
		$query->bindValue(':marque', $contratAuto->marque());
		$query->bindValue(':matricule', $contratAuto->matricule());
		$query->bindValue(':definitiveProvisoire', $contratAuto->definitiveProvisoire());
		$query->bindValue(':puissanceFiscale', $contratAuto->puissanceFiscale());
		$query->bindValue(':nombrePlaces', $contratAuto->nombrePlaces());
		$query->bindValue(':carburant', $contratAuto->carburant());
		$query->bindValue(':dateProduction', $contratAuto->dateProduction());
		$query->bindValue(':dateEffet', $contratAuto->dateEffet());
		$query->bindValue(':nombreMois', $contratAuto->nombreMois());
		$query->bindValue(':dateEcheance', $contratAuto->dateEcheance());
		$query->bindValue(':primeRC', $contratAuto->primeRC());
		$query->bindValue(':defenseRecours', $contratAuto->defenseRecours());
		$query->bindValue(':tierce', $contratAuto->tierce());
		$query->bindValue(':collision', $contratAuto->collision());
		$query->bindValue(':vol', $contratAuto->vol());
		$query->bindValue(':incendie', $contratAuto->incendie());
		$query->bindValue(':brisGlace', $contratAuto->brisGlace());
		$query->bindValue(':individuel', $contratAuto->individuel());
		$query->bindValue(':primeNette', $contratAuto->primeNette());
		$query->bindValue(':taxeAuto', $contratAuto->taxeAuto());
		$query->bindValue(':taxePTA', $contratAuto->taxePTA());
		$query->bindValue(':totalTaxe', $contratAuto->totalTaxe());
		$query->bindValue(':montantPTA', $contratAuto->montantPTA());
		$query->bindValue(':timbre', $contratAuto->timbre());
		$query->bindValue(':accessoires', $contratAuto->accessoires());
		$query->bindValue(':primeTotale', $contratAuto->primeTotale());
		$query->bindValue(':commissionAuto', $contratAuto->commissionAuto());
		$query->bindValue(':commissionPTA', $contratAuto->commissionPTA());
		$query->bindValue(':totalCommission', $contratAuto->totalCommission());
		$query->bindValue(':TPSAuto', $contratAuto->TPSAuto());
		$query->bindValue(':TPSPTA', $contratAuto->TPSPTA());
		$query->bindValue(':totalTPS', $contratAuto->totalTPS());
		$query->bindValue(':updated', $contratAuto->updated());
		$query->bindValue(':updatedBy', $contratAuto->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_contratauto WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_contratauto
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new ContratAuto($data);
	}

	public function getAll(){
        $contratAutos = array();
		$query = $this->_db->query('SELECT * FROM t_contratauto
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$contratAutos[] = new ContratAuto($data);
		}
		$query->closeCursor();
		return $contratAutos;
	}

	public function getAllByLimits($begin, $end){
        $contratAutos = array();
		$query = $this->_db->prepare('SELECT * FROM t_contratauto ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute(); 
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$contratAutos[] = new ContratAuto($data);
		}
		$query->closeCursor();
		return $contratAutos;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS contratAutosNumber FROM t_contratauto');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $contratAuto = $data['contratAutosNumber'];
        return $contratAuto;
    }

	public function getLastId(){
        $query = $this->_db->query('SELECT id AS last_id FROM t_contratauto ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}
    
    public function exist($element){
        $query = $this->_db->prepare('SELECT attestation FROM t_contratauto WHERE attestation=:attestation');
        $query->bindValue(':attestation', $element, PDO::PARAM_INT);
        $query->execute();
        return (bool) $query->fetchColumn();
    }

}