<?php
class BanqueManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Banque $banque){
        $query = $this->_db->prepare(' INSERT INTO t_banque (
		code, raisonSociale, nomContact, tel1, tel2, fax, email, adresse, rue, created, createdBy)
		VALUES (:code, :raisonSociale, :nomContact, :tel1, :tel2, :fax, :email, :adresse, :rue, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $banque->code());
		$query->bindValue(':raisonSociale', $banque->raisonSociale());
		$query->bindValue(':nomContact', $banque->nomContact());
		$query->bindValue(':tel1', $banque->tel1());
		$query->bindValue(':tel2', $banque->tel2());
		$query->bindValue(':fax', $banque->fax());
		$query->bindValue(':email', $banque->email());
		$query->bindValue(':adresse', $banque->adresse());
		$query->bindValue(':rue', $banque->rue());
		$query->bindValue(':created', $banque->created());
		$query->bindValue(':createdBy', $banque->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Banque $banque){
        $query = $this->_db->prepare(' UPDATE t_banque SET 
		code=:code, raisonSociale=:raisonSociale, nomContact=:nomContact, tel1=:tel1, tel2=:tel2, fax=:fax, email=:email, adresse=:adresse, rue=:rue, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $banque->id());
		$query->bindValue(':code', $banque->code());
		$query->bindValue(':raisonSociale', $banque->raisonSociale());
		$query->bindValue(':nomContact', $banque->nomContact());
		$query->bindValue(':tel1', $banque->tel1());
		$query->bindValue(':tel2', $banque->tel2());
		$query->bindValue(':fax', $banque->fax());
		$query->bindValue(':email', $banque->email());
		$query->bindValue(':adresse', $banque->adresse());
		$query->bindValue(':rue', $banque->rue());
		$query->bindValue(':updated', $banque->updated());
		$query->bindValue(':updatedBy', $banque->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_banque
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getBanqueById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_banque
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Banque($data);
	}

	public function getBanques(){
        $banques = array();
		$query = $this->_db->query('SELECT * FROM t_banque
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$banques[] = new Banque($data);
		}
		$query->closeCursor();
		return $banques;
	}

	public function getBanquesByLimits($begin, $end){
        $banques = array();
		$query = $this->_db->query('SELECT * FROM t_banque
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$banques[] = new Banque($data);
		}
		$query->closeCursor();
		return $banques;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_banque
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}