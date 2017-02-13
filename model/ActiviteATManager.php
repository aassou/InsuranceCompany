<?php
class ActiviteATManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(ActiviteAT $activiteAT){
        $query = $this->_db->prepare(' INSERT INTO t_activiteAT (
		codeCompagnie, codeClasse, codeActivite, description, taux, created, createdBy)
		VALUES (:codeCompagnie, :codeClasse, :codeActivite, :description, :taux, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $activiteAT->codeCompagnie());
		$query->bindValue(':codeClasse', $activiteAT->codeClasse());
		$query->bindValue(':codeActivite', $activiteAT->codeActivite());
		$query->bindValue(':description', $activiteAT->description());
		$query->bindValue(':taux', $activiteAT->taux());
		$query->bindValue(':created', $activiteAT->created());
		$query->bindValue(':createdBy', $activiteAT->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(ActiviteAT $activiteAT){
        $query = $this->_db->prepare(' UPDATE t_activiteAT SET 
		codeCompagnie=:codeCompagnie, codeClasse=:codeClasse, codeActivite=:codeActivite, description=:description, taux=:taux, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $activiteAT->id());
		$query->bindValue(':codeCompagnie', $activiteAT->codeCompagnie());
		$query->bindValue(':codeClasse', $activiteAT->codeClasse());
		$query->bindValue(':codeActivite', $activiteAT->codeActivite());
		$query->bindValue(':description', $activiteAT->description());
		$query->bindValue(':taux', $activiteAT->taux());
		$query->bindValue(':updated', $activiteAT->updated());
		$query->bindValue(':updatedBy', $activiteAT->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_activiteAT
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getActiviteATById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_activiteAT
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new ActiviteAT($data);
	}

	public function getActiviteATs(){
        $activiteATs = array();
		$query = $this->_db->query('SELECT * FROM t_activiteAT
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$activiteATs[] = new ActiviteAT($data);
		}
		$query->closeCursor();
		return $activiteATs;
	}

	public function getActiviteATsByLimits($begin, $end){
        $activiteATs = array();
		$query = $this->_db->query('SELECT * FROM t_activiteAT
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$activiteATs[] = new ActiviteAT($data);
		}
		$query->closeCursor();
		return $activiteATs;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_activiteAT
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}