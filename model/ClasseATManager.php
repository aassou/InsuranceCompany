<?php
class ClasseATManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(ClasseAT $classeAT){
        $query = $this->_db->prepare(' INSERT INTO t_classeat (
		code, libelle, created, createdBy)
		VALUES (:code, :libelle, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $classeAT->code());
		$query->bindValue(':libelle', $classeAT->libelle());
		$query->bindValue(':created', $classeAT->created());
		$query->bindValue(':createdBy', $classeAT->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(ClasseAT $classeAT){
        $query = $this->_db->prepare(' UPDATE t_classeat SET 
		code=:code, libelle=:libelle, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $classeAT->id());
		$query->bindValue(':code', $classeAT->code());
		$query->bindValue(':libelle', $classeAT->libelle());
		$query->bindValue(':updated', $classeAT->updated());
		$query->bindValue(':updatedBy', $classeAT->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_classeat
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getClasseATById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_classeat
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new ClasseAT($data);
	}

	public function getClasseATs(){
        $classeATs = array();
		$query = $this->_db->query('SELECT * FROM t_classeat
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$classeATs[] = new ClasseAT($data);
		}
		$query->closeCursor();
		return $classeATs;
	}

	public function getClasseATsByLimits($begin, $end){
        $classeATs = array();
		$query = $this->_db->query('SELECT * FROM t_classeat
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$classeATs[] = new ClasseAT($data);
		}
		$query->closeCursor();
		return $classeATs;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_classeat
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}