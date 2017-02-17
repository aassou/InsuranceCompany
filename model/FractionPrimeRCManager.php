<?php
class FractionPrimeRCManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(FractionPrimeRC $fractionPrimeRC){
        $query = $this->_db->prepare(' INSERT INTO t_fractionprimerc (
		codeCompagnie, nombreMois, tauxMois, created, createdBy)
		VALUES (:codeCompagnie, :nombreMois, :tauxMois, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $fractionPrimeRC->codeCompagnie());
		$query->bindValue(':nombreMois', $fractionPrimeRC->nombreMois());
		$query->bindValue(':tauxMois', $fractionPrimeRC->tauxMois());
		$query->bindValue(':created', $fractionPrimeRC->created());
		$query->bindValue(':createdBy', $fractionPrimeRC->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(FractionPrimeRC $fractionPrimeRC){
        $query = $this->_db->prepare(' UPDATE t_fractionprimerc SET 
		codeCompagnie=:codeCompagnie, nombreMois=:nombreMois, tauxMois=:tauxMois, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $fractionPrimeRC->id());
		$query->bindValue(':codeCompagnie', $fractionPrimeRC->codeCompagnie());
		$query->bindValue(':nombreMois', $fractionPrimeRC->nombreMois());
		$query->bindValue(':tauxMois', $fractionPrimeRC->tauxMois());
		$query->bindValue(':updated', $fractionPrimeRC->updated());
		$query->bindValue(':updatedBy', $fractionPrimeRC->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_fractionprimerc
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getFractionPrimeRCById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_fractionprimerc
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new FractionPrimeRC($data);
	}

	public function getFractionPrimeRCs(){
        $fractionPrimeRCs = array();
		$query = $this->_db->query('SELECT * FROM t_fractionprimerc
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$fractionPrimeRCs[] = new FractionPrimeRC($data);
		}
		$query->closeCursor();
		return $fractionPrimeRCs;
	}

	public function getFractionPrimeRCsByLimits($begin, $end){
        $fractionPrimeRCs = array();
		$query = $this->_db->query('SELECT * FROM t_fractionprimerc
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$fractionPrimeRCs[] = new FractionPrimeRC($data);
		}
		$query->closeCursor();
		return $fractionPrimeRCs;
	}

	public function getFractionPrimeRCsNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS fractionPrimeRCsNumber FROM t_fractionprimerc');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $fractionPrimeRC = $data['fractionPrimeRCsNumber'];
        return $fractionPrimeRC;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_fractionprimerc
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}