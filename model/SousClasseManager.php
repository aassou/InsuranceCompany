<?php
class SousClasseManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(SousClasse $sousClasse){
        $query = $this->_db->prepare(' INSERT INTO t_sousclasse (
		code, designation, codeClasse, created, createdBy)
		VALUES (:code, :designation, :codeClasse, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $sousClasse->code());
		$query->bindValue(':designation', $sousClasse->designation());
		$query->bindValue(':codeClasse', $sousClasse->codeClasse());
		$query->bindValue(':created', $sousClasse->created());
		$query->bindValue(':createdBy', $sousClasse->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(SousClasse $sousClasse){
        $query = $this->_db->prepare(' UPDATE t_sousclasse SET 
		code=:code, designation=:designation, codeClasse=:codeClasse, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $sousClasse->id());
		$query->bindValue(':code', $sousClasse->code());
		$query->bindValue(':designation', $sousClasse->designation());
		$query->bindValue(':codeClasse', $sousClasse->codeClasse());
		$query->bindValue(':updated', $sousClasse->updated());
		$query->bindValue(':updatedBy', $sousClasse->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_sousclasse
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_sousclasse
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new SousClasse($data);
	}

	public function getAll(){
        $sousClasses = array();
		$query = $this->_db->query('SELECT * FROM t_sousclasse
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$sousClasses[] = new SousClasse($data);
		}
		$query->closeCursor();
		return $sousClasses;
	}

	public function getAllByLimits($begin, $end){
        $sousClasses = array();
		$query = $this->_db->prepare('SELECT * FROM t_sousclasse ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$sousClasses[] = new SousClasse($data);
		}
		$query->closeCursor();
		return $sousClasses;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_sousclasse
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}