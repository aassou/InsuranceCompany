<?php
class RegionManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Region $region){
        $query = $this->_db->prepare(' INSERT INTO t_region (
		code, designation, created, createdBy)
		VALUES (:code, :designation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $region->code());
		$query->bindValue(':designation', $region->designation());
		$query->bindValue(':created', $region->created());
		$query->bindValue(':createdBy', $region->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Region $region){
        $query = $this->_db->prepare(' UPDATE t_region SET 
		code=:code, designation=:designation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $region->id());
		$query->bindValue(':code', $region->code());
		$query->bindValue(':designation', $region->designation());
		$query->bindValue(':updated', $region->updated());
		$query->bindValue(':updatedBy', $region->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_region
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_region
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Region($data);
	}

	public function getAll(){
        $regions = array();
		$query = $this->_db->query('SELECT * FROM t_region
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$regions[] = new Region($data);
		}
		$query->closeCursor();
		return $regions;
	}

	public function getAllByLimits($begin, $end){
        $regions = array();
		$query = $this->_db->query('SELECT * FROM t_region
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$regions[] = new Region($data);
		}
		$query->closeCursor();
		return $regions;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_region
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}