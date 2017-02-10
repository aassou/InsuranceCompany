<?php
class CodeReglementSinistreManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(CodeReglementSinistre $codeReglementSinistre){
        $query = $this->_db->prepare(' INSERT INTO t_codereglementsinistre (
		code, libelle, created, createdBy)
		VALUES (:code, :libelle, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $codeReglementSinistre->code());
		$query->bindValue(':libelle', $codeReglementSinistre->libelle());
		$query->bindValue(':created', $codeReglementSinistre->created());
		$query->bindValue(':createdBy', $codeReglementSinistre->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(CodeReglementSinistre $codeReglementSinistre){
        $query = $this->_db->prepare(' UPDATE t_codereglementsinistre SET 
		code=:code, libelle=:libelle, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $codeReglementSinistre->id());
		$query->bindValue(':code', $codeReglementSinistre->code());
		$query->bindValue(':libelle', $codeReglementSinistre->libelle());
		$query->bindValue(':updated', $codeReglementSinistre->updated());
		$query->bindValue(':updatedBy', $codeReglementSinistre->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_codereglementsinistre
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getCodeReglementSinistreById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_codereglementsinistre
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new CodeReglementSinistre($data);
	}

	public function getCodeReglementSinistres(){
        $codeReglementSinistres = array();
		$query = $this->_db->query('SELECT * FROM t_codereglementsinistre
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$codeReglementSinistres[] = new CodeReglementSinistre($data);
		}
		$query->closeCursor();
		return $codeReglementSinistres;
	}

	public function getCodeReglementSinistresByLimits($begin, $end){
        $codeReglementSinistres = array();
		$query = $this->_db->query('SELECT * FROM t_codereglementsinistre
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$codeReglementSinistres[] = new CodeReglementSinistre($data);
		}
		$query->closeCursor();
		return $codeReglementSinistres;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_codereglementsinistre
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}