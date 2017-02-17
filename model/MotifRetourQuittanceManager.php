<?php
class MotifRetourQuittanceManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(MotifRetourQuittance $motifRetourQuittance){
        $query = $this->_db->prepare(' INSERT INTO t_motifretourquittance (
		code, libelle, created, createdBy)
		VALUES (:code, :libelle, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $motifRetourQuittance->code());
		$query->bindValue(':libelle', $motifRetourQuittance->libelle());
		$query->bindValue(':created', $motifRetourQuittance->created());
		$query->bindValue(':createdBy', $motifRetourQuittance->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(MotifRetourQuittance $motifRetourQuittance){
        $query = $this->_db->prepare(' UPDATE t_motifretourquittance SET 
		code=:code, libelle=:libelle, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $motifRetourQuittance->id());
		$query->bindValue(':code', $motifRetourQuittance->code());
		$query->bindValue(':libelle', $motifRetourQuittance->libelle());
		$query->bindValue(':updated', $motifRetourQuittance->updated());
		$query->bindValue(':updatedBy', $motifRetourQuittance->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_motifretourquittance
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getMotifRetourQuittanceById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_motifretourquittance
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new MotifRetourQuittance($data);
	}

	public function getMotifRetourQuittances(){
        $motifRetourQuittances = array();
		$query = $this->_db->query('SELECT * FROM t_motifretourquittance
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$motifRetourQuittances[] = new MotifRetourQuittance($data);
		}
		$query->closeCursor();
		return $motifRetourQuittances;
	}

	public function getMotifRetourQuittancesByLimits($begin, $end){
        $motifRetourQuittances = array();
		$query = $this->_db->query('SELECT * FROM t_motifretourquittance
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$motifRetourQuittances[] = new MotifRetourQuittance($data);
		}
		$query->closeCursor();
		return $motifRetourQuittances;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_motifretourquittance
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}