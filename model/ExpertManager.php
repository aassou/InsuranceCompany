<?php
class ExpertManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Expert $expert){
        $query = $this->_db->prepare(' INSERT INTO t_expert (
		code, nom, adresse, ville, tel1, tel2, fax, created, createdBy)
		VALUES (:code, :nom, :adresse, :ville, :tel1, :tel2, :fax, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $expert->code());
		$query->bindValue(':nom', $expert->nom());
		$query->bindValue(':adresse', $expert->adresse());
		$query->bindValue(':ville', $expert->ville());
		$query->bindValue(':tel1', $expert->tel1());
		$query->bindValue(':tel2', $expert->tel2());
		$query->bindValue(':fax', $expert->fax());
		$query->bindValue(':created', $expert->created());
		$query->bindValue(':createdBy', $expert->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Expert $expert){
        $query = $this->_db->prepare(' UPDATE t_expert SET 
		code=:code, nom=:nom, adresse=:adresse, ville=:ville, tel1=:tel1, tel2=:tel2, fax=:fax, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $expert->id());
		$query->bindValue(':code', $expert->code());
		$query->bindValue(':nom', $expert->nom());
		$query->bindValue(':adresse', $expert->adresse());
		$query->bindValue(':ville', $expert->ville());
		$query->bindValue(':tel1', $expert->tel1());
		$query->bindValue(':tel2', $expert->tel2());
		$query->bindValue(':fax', $expert->fax());
		$query->bindValue(':updated', $expert->updated());
		$query->bindValue(':updatedBy', $expert->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_expert
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getExpertById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_expert
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Expert($data);
	}

	public function getExperts(){
        $experts = array();
		$query = $this->_db->query('SELECT * FROM t_expert
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$experts[] = new Expert($data);
		}
		$query->closeCursor();
		return $experts;
	}

	public function getExpertsByLimits($begin, $end){
        $experts = array();
		$query = $this->_db->query('SELECT * FROM t_expert
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$experts[] = new Expert($data);
		}
		$query->closeCursor();
		return $experts;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_expert
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}