<?php
class ClasseManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Classe $classe){
        $query = $this->_db->prepare(' INSERT INTO t_classe (
		code, designation, created, createdBy)
		VALUES (:code, :designation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $classe->code());
		$query->bindValue(':designation', $classe->designation());
		$query->bindValue(':created', $classe->created());
		$query->bindValue(':createdBy', $classe->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Classe $classe){
        $query = $this->_db->prepare('UPDATE t_classe SET 
		code=:code, designation=:designation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $classe->id());
		$query->bindValue(':code', $classe->code());
		$query->bindValue(':designation', $classe->designation());
		$query->bindValue(':updated', $classe->updated());
		$query->bindValue(':updatedBy', $classe->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare('DELETE FROM t_classe WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_classe WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Classe($data);
	}

	public function getAll(){
        $classes = array();
		$query = $this->_db->query('SELECT * FROM t_classe ORDER BY code ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$classes[] = new Classe($data);
		}
		$query->closeCursor();
		return $classes;
	}

	public function getAllByLimits($begin, $end){
        $classes = array();
		$query = $this->_db->prepare('SELECT * FROM t_classe ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute(); 
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$classes[] = new Classe($data);
		}
		$query->closeCursor();
		return $classes;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_classe ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}