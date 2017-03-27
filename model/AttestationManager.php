<?php
class AttestationManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Attestation $attestation){
        $query = $this->_db->prepare(' INSERT INTO t_attestation (
		codeCompagnie, numeroDebut, numeroFin, codeUsage, dateReception, nombreAttestation, nombreUtilise, created, createdBy)
		VALUES (:codeCompagnie, :numeroDebut, :numeroFin, :codeUsage, :dateReception, :nombreAttestation, :nombreUtilise, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $attestation->codeCompagnie());
		$query->bindValue(':numeroDebut', $attestation->numeroDebut());
		$query->bindValue(':numeroFin', $attestation->numeroFin());
		$query->bindValue(':codeUsage', $attestation->codeUsage());
		$query->bindValue(':dateReception', $attestation->dateReception());
		$query->bindValue(':nombreAttestation', $attestation->nombreAttestation());
		$query->bindValue(':nombreUtilise', $attestation->nombreUtilise());
		$query->bindValue(':created', $attestation->created());
		$query->bindValue(':createdBy', $attestation->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Attestation $attestation){
        $query = $this->_db->prepare(' UPDATE t_attestation SET 
		codeCompagnie=:codeCompagnie, numeroDebut=:numeroDebut, numeroFin=:numeroFin, codeUsage=:codeUsage, dateReception=:dateReception, nombreAttestation=:nombreAttestation, nombreUtilise=:nombreUtilise, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $attestation->id());
		$query->bindValue(':codeCompagnie', $attestation->codeCompagnie());
		$query->bindValue(':numeroDebut', $attestation->numeroDebut());
		$query->bindValue(':numeroFin', $attestation->numeroFin());
		$query->bindValue(':codeUsage', $attestation->codeUsage());
		$query->bindValue(':dateReception', $attestation->dateReception());
		$query->bindValue(':nombreAttestation', $attestation->nombreAttestation());
		$query->bindValue(':nombreUtilise', $attestation->nombreUtilise());
		$query->bindValue(':updated', $attestation->updated());
		$query->bindValue(':updatedBy', $attestation->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_attestation
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_attestation
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Attestation($data);
	}

	public function getAll(){
        $attestations = array();
		$query = $this->_db->query('SELECT * FROM t_attestation
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$attestations[] = new Attestation($data);
		}
		$query->closeCursor();
		return $attestations;
	}

	public function getAllByLimits($begin, $end){
        $attestations = array();
		$query = $this->_db->query('SELECT * FROM t_attestation
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$attestations[] = new Attestation($data);
		}
		$query->closeCursor();
		return $attestations;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS attestationsNumber FROM t_attestation');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $attestation = $data['attestationsNumber'];
        return $attestation;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_attestation
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}