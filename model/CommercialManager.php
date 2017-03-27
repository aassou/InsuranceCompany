<?php
class CommercialManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Commercial $commercial){
        $query = $this->_db->prepare(' INSERT INTO t_commercial (
		code, raisonSocial, nomContact, Adresse, Rue, tel1, tel2, email, created, createdBy)
		VALUES (:code, :raisonSocial, :nomContact, :Adresse, :Rue, :tel1, :tel2, :email, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $commercial->code());
		$query->bindValue(':raisonSocial', $commercial->raisonSocial());
		$query->bindValue(':nomContact', $commercial->nomContact());
		$query->bindValue(':Adresse', $commercial->Adresse());
		$query->bindValue(':Rue', $commercial->Rue());
		$query->bindValue(':tel1', $commercial->tel1());
		$query->bindValue(':tel2', $commercial->tel2());
		$query->bindValue(':email', $commercial->email());
		$query->bindValue(':created', $commercial->created());
		$query->bindValue(':createdBy', $commercial->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Commercial $commercial){
        $query = $this->_db->prepare(' UPDATE t_commercial SET 
		code=:code, raisonSocial=:raisonSocial, nomContact=:nomContact, Adresse=:Adresse, Rue=:Rue, 
		tel1=:tel1, tel2=:tel2, email=:email, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $commercial->id());
		$query->bindValue(':code', $commercial->code());
		$query->bindValue(':raisonSocial', $commercial->raisonSocial());
		$query->bindValue(':nomContact', $commercial->nomContact());
		$query->bindValue(':Adresse', $commercial->Adresse());
		$query->bindValue(':Rue', $commercial->Rue());
		$query->bindValue(':tel1', $commercial->tel1());
		$query->bindValue(':tel2', $commercial->tel2());
		$query->bindValue(':email', $commercial->email());
		$query->bindValue(':updated', $commercial->updated());
		$query->bindValue(':updatedBy', $commercial->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_commercial
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare('SELECT * FROM t_commercial WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Commercial($data);
	}

	public function getAll(){
        $commercials = array();
		$query = $this->_db->query('SELECT * FROM t_commercial ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$commercials[] = new Commercial($data);
		}
		$query->closeCursor();
		return $commercials;
	}

	public function getAllByLimits($begin, $end){
        $commercials = array();
		$query = $this->_db->query('SELECT * FROM t_commercial ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$commercials[] = new Commercial($data);
		}
		$query->closeCursor();
		return $commercials;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_commercial ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}