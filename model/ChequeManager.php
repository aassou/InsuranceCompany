<?php
class ChequeManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Cheque $cheque){
        $query = $this->_db->prepare(' INSERT INTO t_cheque (
		dateRecu, numero, designationSociete, designationPersonne, montant, status, url, compteBancaire, created, createdBy)
		VALUES (:dateRecu, :numero, :designationSociete, :designationPersonne, :montant, :status, :url, :compteBancaire, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':dateRecu', $cheque->dateRecu());
		$query->bindValue(':numero', $cheque->numero());
		$query->bindValue(':designationSociete', $cheque->designationSociete());
		$query->bindValue(':designationPersonne', $cheque->designationPersonne());
		$query->bindValue(':montant', $cheque->montant());
		$query->bindValue(':status', $cheque->status());
		$query->bindValue(':url', $cheque->url());
		$query->bindValue(':compteBancaire', $cheque->compteBancaire());
		$query->bindValue(':created', $cheque->created());
		$query->bindValue(':createdBy', $cheque->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Cheque $cheque){
        $query = $this->_db->prepare(' UPDATE t_cheque SET 
		dateRecu=:dateRecu, numero=:numero, designationSociete=:designationSociete, designationPersonne=:designationPersonne, montant=:montant, status=:status, url=:url, compteBancaire=:compteBancaire, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $cheque->id());
		$query->bindValue(':dateRecu', $cheque->dateRecu());
		$query->bindValue(':numero', $cheque->numero());
		$query->bindValue(':designationSociete', $cheque->designationSociete());
		$query->bindValue(':designationPersonne', $cheque->designationPersonne());
		$query->bindValue(':montant', $cheque->montant());
		$query->bindValue(':status', $cheque->status());
		$query->bindValue(':url', $cheque->url());
		$query->bindValue(':compteBancaire', $cheque->compteBancaire());
		$query->bindValue(':updated', $cheque->updated());
		$query->bindValue(':updatedBy', $cheque->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_cheque
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_cheque
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Cheque($data);
	}

	public function getAll(){
        $cheques = array();
		$query = $this->_db->query('SELECT * FROM t_cheque
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$cheques[] = new Cheque($data);
		}
		$query->closeCursor();
		return $cheques;
	}

	public function getAllByLimits($begin, $end){
        $cheques = array();
		$query = $this->_db->query('SELECT * FROM t_cheque
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$cheques[] = new Cheque($data);
		}
		$query->closeCursor();
		return $cheques;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS chequesNumber FROM t_cheque');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $cheque = $data['chequesNumber'];
        return $cheque;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_cheque
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}