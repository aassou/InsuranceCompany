<?php
class CarteVerteManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(CarteVerte $carteVerte){
        $query = $this->_db->prepare(' INSERT INTO t_carteVerte (
		dateEffet, dateExpiration, immatriculation, categorie, marque, numeroPolice, souscripteur, adresse, created, createdBy)
		VALUES (:dateEffet, :dateExpiration, :immatriculation, :categorie, :marque, :numeroPolice, :souscripteur, :adresse, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':dateEffet', $carteVerte->dateEffet());
		$query->bindValue(':dateExpiration', $carteVerte->dateExpiration());
		$query->bindValue(':immatriculation', $carteVerte->immatriculation());
		$query->bindValue(':categorie', $carteVerte->categorie());
		$query->bindValue(':marque', $carteVerte->marque());
		$query->bindValue(':numeroPolice', $carteVerte->numeroPolice());
		$query->bindValue(':souscripteur', $carteVerte->souscripteur());
		$query->bindValue(':adresse', $carteVerte->adresse());
		$query->bindValue(':created', $carteVerte->created());
		$query->bindValue(':createdBy', $carteVerte->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(CarteVerte $carteVerte){
        $query = $this->_db->prepare(' UPDATE t_carteVerte SET 
		dateEffet=:dateEffet, dateExpiration=:dateExpiration, immatriculation=:immatriculation, categorie=:categorie, marque=:marque, numeroPolice=:numeroPolice, souscripteur=:souscripteur, adresse=:adresse, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $carteVerte->id());
		$query->bindValue(':dateEffet', $carteVerte->dateEffet());
		$query->bindValue(':dateExpiration', $carteVerte->dateExpiration());
		$query->bindValue(':immatriculation', $carteVerte->immatriculation());
		$query->bindValue(':categorie', $carteVerte->categorie());
		$query->bindValue(':marque', $carteVerte->marque());
		$query->bindValue(':numeroPolice', $carteVerte->numeroPolice());
		$query->bindValue(':souscripteur', $carteVerte->souscripteur());
		$query->bindValue(':adresse', $carteVerte->adresse());
		$query->bindValue(':updated', $carteVerte->updated());
		$query->bindValue(':updatedBy', $carteVerte->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_carteVerte
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_carteVerte
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new CarteVerte($data);
	}

	public function getAll(){
        $carteVertes = array();
		$query = $this->_db->query('SELECT * FROM t_carteVerte
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$carteVertes[] = new CarteVerte($data);
		}
		$query->closeCursor();
		return $carteVertes;
	}

	public function getAllByLimits($begin, $end){
        $carteVertes = array();
		$query = $this->_db->query('SELECT * FROM t_carteVerte
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$carteVertes[] = new CarteVerte($data);
		}
		$query->closeCursor();
		return $carteVertes;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS carteVertesNumber FROM t_carteVerte');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $carteVerte = $data['carteVertesNumber'];
        return $carteVerte;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_carteVerte
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}