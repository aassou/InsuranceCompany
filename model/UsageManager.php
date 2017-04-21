<?php
class UsageManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Usage $usage){
        $query = $this->_db->prepare(' INSERT INTO t_usage (
		code, designation, created, createdBy)
		VALUES (:code, :designation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $usage->code());
		$query->bindValue(':designation', $usage->designation());
		$query->bindValue(':created', $usage->created());
		$query->bindValue(':createdBy', $usage->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Usage $usage){
        $query = $this->_db->prepare(' UPDATE t_usage SET 
		code=:code, designation=:designation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $usage->id());
		$query->bindValue(':code', $usage->code());
		$query->bindValue(':designation', $usage->designation());
		$query->bindValue(':updated', $usage->updated());
		$query->bindValue(':updatedBy', $usage->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_usage
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_usage
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Usage($data);
	}

	public function getAll(){
        $usages = array();
		$query = $this->_db->query('SELECT * FROM t_usage
        ORDER BY code ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$usages[] = new Usage($data);
		}
		$query->closeCursor();
		return $usages;
	}

	public function getAllByLimits($begin, $end){
        $usages = array();
		$query = $this->_db->prepare('SELECT * FROM t_usage ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$usages[] = new Usage($data);
		}
		$query->closeCursor();
		return $usages;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_usage
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}