<?php
class CompteBancaireManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(CompteBancaire $compteBancaire){
        $query = $this->_db->prepare(' INSERT INTO t_comptebancaire (
		numero, designation, dateCreation, created, createdBy)
		VALUES (:numero, :designation, :dateCreation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':numero', $compteBancaire->numero());
		$query->bindValue(':designation', $compteBancaire->designation());
		$query->bindValue(':dateCreation', $compteBancaire->dateCreation());
		$query->bindValue(':created', $compteBancaire->created());
		$query->bindValue(':createdBy', $compteBancaire->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(CompteBancaire $compteBancaire){
        $query = $this->_db->prepare(' UPDATE t_comptebancaire SET 
		numero=:numero, designation=:designation, dateCreation=:dateCreation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $compteBancaire->id());
		$query->bindValue(':numero', $compteBancaire->numero());
		$query->bindValue(':designation', $compteBancaire->designation());
		$query->bindValue(':dateCreation', $compteBancaire->dateCreation());
		$query->bindValue(':updated', $compteBancaire->updated());
		$query->bindValue(':updatedBy', $compteBancaire->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_comptebancaire
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_comptebancaire
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new CompteBancaire($data);
	}

	public function getAll(){
        $compteBancaires = array();
		$query = $this->_db->query('SELECT * FROM t_comptebancaire
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$compteBancaires[] = new CompteBancaire($data);
		}
		$query->closeCursor();
		return $compteBancaires;
	}

	public function getAllByLimits($begin, $end){
        $compteBancaires = array();
		$query = $this->_db->query('SELECT * FROM t_comptebancaire
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$compteBancaires[] = new CompteBancaire($data);
		}
		$query->closeCursor();
		return $compteBancaires;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS compteBancairesNumber FROM t_comptebancaire');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $compteBancaire = $data['compteBancairesNumber'];
        return $compteBancaire;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_comptebancaire
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}