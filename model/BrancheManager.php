<?php
class BrancheManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Branche $branche){
        $query = $this->_db->prepare(' INSERT INTO t_branche (
		code, designation, tauxTaxe, tauxCommission, tauxTPS, idCompagnie, created, createdBy)
		VALUES (:code, :designation, :tauxTaxe, :tauxCommission, :tauxTPS, :idCompagnie, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $branche->code());
		$query->bindValue(':designation', $branche->designation());
		$query->bindValue(':tauxTaxe', $branche->tauxTaxe());
		$query->bindValue(':tauxCommission', $branche->tauxCommission());
		$query->bindValue(':tauxTPS', $branche->tauxTPS());
		$query->bindValue(':idCompagnie', $branche->idCompagnie());
		$query->bindValue(':created', $branche->created());
		$query->bindValue(':createdBy', $branche->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Branche $branche){
        $query = $this->_db->prepare(' UPDATE t_branche SET 
		code=:code, designation=:designation, tauxTaxe=:tauxTaxe, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, idCompagnie=:idCompagnie, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $branche->id());
		$query->bindValue(':code', $branche->code());
		$query->bindValue(':designation', $branche->designation());
		$query->bindValue(':tauxTaxe', $branche->tauxTaxe());
		$query->bindValue(':tauxCommission', $branche->tauxCommission());
		$query->bindValue(':tauxTPS', $branche->tauxTPS());
		$query->bindValue(':idCompagnie', $branche->idCompagnie());
		$query->bindValue(':updated', $branche->updated());
		$query->bindValue(':updatedBy', $branche->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_branche
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getBrancheById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_branche
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Branche($data);
	}

	public function getBranches(){
        $branches = array();
		$query = $this->_db->query('SELECT * FROM t_branche
        ORDER BY idCompagnie ASC, code ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$branches[] = new Branche($data);
		}
		$query->closeCursor();
		return $branches;
	}

	public function getBranchesByLimits($begin, $end){
        $branches = array();
		$query = $this->_db->query('SELECT * FROM t_branche
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$branches[] = new Branche($data);
		}
		$query->closeCursor();
		return $branches;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_branche
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}