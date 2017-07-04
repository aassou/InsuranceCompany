<?php
class AssurancesFrontiersManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(AssurancesFrontiers $assurancesFrontiers){
        $query = $this->_db->prepare(' INSERT INTO t_assurancesfrontiers (
		police, attestation, idUsage, dateEffet, duree, dateExpiration, proprietaire, passeport, 
		adresse, permis, datePermis, categorie, immatriculation, moteur, chassis, marque, type, 
		poidsTotalCharge, nombrePlaces, remorque, immatriculationRemorque, cylindre, intermediaire, 
		souscripteur, passeportSouscripteur, pays, created, createdBy)
		VALUES (:police, :attestation, :idUsage, :dateEffet, :duree, :dateExpiration, :proprietaire, :passeport, 
        :adresse, :permis, :datePermis, :categorie, :immatriculation, :moteur, :chassis, :marque, :type, 
        :poidsTotalCharge, :nombrePlaces, :remorque, :immatriculationRemorque, :cylindre, :intermediaire, 
        :souscripteur, :passeportSouscripteur, :pays, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':police', $assurancesFrontiers->police());
		$query->bindValue(':attestation', $assurancesFrontiers->attestation());
		$query->bindValue(':idUsage', $assurancesFrontiers->idUsage());
		$query->bindValue(':dateEffet', $assurancesFrontiers->dateEffet());
		$query->bindValue(':duree', $assurancesFrontiers->duree());
		$query->bindValue(':dateExpiration', $assurancesFrontiers->dateExpiration());
		$query->bindValue(':proprietaire', $assurancesFrontiers->proprietaire());
		$query->bindValue(':passeport', $assurancesFrontiers->passeport());
		$query->bindValue(':adresse', $assurancesFrontiers->adresse());
        $query->bindValue(':souscripteur', $assurancesFrontiers->souscripteur());
        $query->bindValue(':passeportSouscripteur', $assurancesFrontiers->passeportSouscripteur());
        $query->bindValue(':pays', $assurancesFrontiers->pays());
		$query->bindValue(':permis', $assurancesFrontiers->permis());
		$query->bindValue(':datePermis', $assurancesFrontiers->datePermis());
		$query->bindValue(':categorie', $assurancesFrontiers->categorie());
		$query->bindValue(':immatriculation', $assurancesFrontiers->immatriculation());
		$query->bindValue(':moteur', $assurancesFrontiers->moteur());
		$query->bindValue(':chassis', $assurancesFrontiers->chassis());
		$query->bindValue(':marque', $assurancesFrontiers->marque());
		$query->bindValue(':type', $assurancesFrontiers->type());
		$query->bindValue(':poidsTotalCharge', $assurancesFrontiers->poidsTotalCharge());
		$query->bindValue(':nombrePlaces', $assurancesFrontiers->nombrePlaces());
		$query->bindValue(':remorque', $assurancesFrontiers->remorque());
		$query->bindValue(':immatriculationRemorque', $assurancesFrontiers->immatriculationRemorque());
		$query->bindValue(':cylindre', $assurancesFrontiers->cylindre());
		$query->bindValue(':intermediaire', $assurancesFrontiers->intermediaire());
		$query->bindValue(':created', $assurancesFrontiers->created());
		$query->bindValue(':createdBy', $assurancesFrontiers->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(AssurancesFrontiers $assurancesFrontiers){
        $query = $this->_db->prepare(' UPDATE t_assurancesfrontiers SET 
		police=:police, attestation=:attestation, idUsage=:idUsage, dateEffet=:dateEffet, duree=:duree, 
		dateExpiration=:dateExpiration, proprietaire=:proprietaire, passeport=:passeport, 
		adresse=:adresse, permis=:permis, datePermis=:datePermis, categorie=:categorie, 
		immatriculation=:immatriculation, moteur=:moteur, chassis=:chassis, marque=:marque, type=:type, 
		poidsTotalCharge=:poidsTotalCharge, nombrePlaces=:nombrePlaces, 
		remorque=:remorque, immatriculationRemorque=:immatriculationRemorque, cylindre=:cylindre, 
		intermediaire=:intermediaire, souscripteur=:souscripteur, 
		passeportSouscripteur=:passeportSouscripteur, pays=:pays updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $assurancesFrontiers->id());
		$query->bindValue(':police', $assurancesFrontiers->police());
		$query->bindValue(':attestation', $assurancesFrontiers->attestation());
		$query->bindValue(':idUsage', $assurancesFrontiers->idUsage());
		$query->bindValue(':dateEffet', $assurancesFrontiers->dateEffet());
		$query->bindValue(':duree', $assurancesFrontiers->duree());
		$query->bindValue(':dateExpiration', $assurancesFrontiers->dateExpiration());
		$query->bindValue(':proprietaire', $assurancesFrontiers->proprietaire());
		$query->bindValue(':passeport', $assurancesFrontiers->passeport());
		$query->bindValue(':adresse', $assurancesFrontiers->adresse());
        $query->bindValue(':souscripteur', $assurancesFrontiers->souscripteur());
        $query->bindValue(':passeportSouscripteur', $assurancesFrontiers->passeportSouscripteur());
        $query->bindValue(':pays', $assurancesFrontiers->pays());
		$query->bindValue(':permis', $assurancesFrontiers->permis());
		$query->bindValue(':datePermis', $assurancesFrontiers->datePermis());
		$query->bindValue(':categorie', $assurancesFrontiers->categorie());
		$query->bindValue(':immatriculation', $assurancesFrontiers->immatriculation());
		$query->bindValue(':moteur', $assurancesFrontiers->moteur());
		$query->bindValue(':chassis', $assurancesFrontiers->chassis());
		$query->bindValue(':marque', $assurancesFrontiers->marque());
		$query->bindValue(':type', $assurancesFrontiers->type());
		$query->bindValue(':poidsTotalCharge', $assurancesFrontiers->poidsTotalCharge());
		$query->bindValue(':nombrePlaces', $assurancesFrontiers->nombrePlaces());
		$query->bindValue(':remorque', $assurancesFrontiers->remorque());
		$query->bindValue(':immatriculationRemorque', $assurancesFrontiers->immatriculationRemorque());
		$query->bindValue(':cylindre', $assurancesFrontiers->cylindre());
		$query->bindValue(':intermediaire', $assurancesFrontiers->intermediaire());
		$query->bindValue(':updated', $assurancesFrontiers->updated());
		$query->bindValue(':updatedBy', $assurancesFrontiers->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_assurancesfrontiers
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_assurancesfrontiers
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new AssurancesFrontiers($data);
	}

	public function getAll(){
        $assurancesFrontierss = array();
		$query = $this->_db->query('SELECT * FROM t_assurancesfrontiers
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$assurancesFrontierss[] = new AssurancesFrontiers($data);
		}
		$query->closeCursor();
		return $assurancesFrontierss;
	}

	public function getAllByLimits($begin, $end){
        $assurancesFrontierss = array();
		$query = $this->_db->query('SELECT * FROM t_assurancesfrontiers
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$assurancesFrontierss[] = new AssurancesFrontiers($data);
		}
		$query->closeCursor();
		return $assurancesFrontierss;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS assurancesFrontierssNumber FROM t_assurancesfrontiers');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $assurancesFrontiers = $data['assurancesFrontierssNumber'];
        return $assurancesFrontiers;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_assurancesfrontiers
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}