<?php
class CompagnieManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Compagnie $compagnie){
        $query = $this->_db->prepare(' INSERT INTO t_compagnie (
		raisonSociale, raisonSocialeAbrege, codeIntermediaire, codeMF, correspondantAuto, telCorrespondantAuto, correspondantSinistre, telCorrespondantSinistre, correspondantRecouvrement, telCorrespondantRecouvrement, adresse, rue, fax, tel, email, created, createdBy)
		VALUES (:raisonSociale, :raisonSocialeAbrege, :codeIntermediaire, :codeMF, :correspondantAuto, :telCorrespondantAuto, :correspondantSinistre, :telCorrespondantSinistre, :correspondantRecouvrement, :telCorrespondantRecouvrement, :adresse, :rue, :fax, :tel, :email, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':raisonSociale', $compagnie->raisonSociale());
		$query->bindValue(':raisonSocialeAbrege', $compagnie->raisonSocialeAbrege());
		$query->bindValue(':codeIntermediaire', $compagnie->codeIntermediaire());
		$query->bindValue(':codeMF', $compagnie->codeMF());
		$query->bindValue(':correspondantAuto', $compagnie->correspondantAuto());
		$query->bindValue(':telCorrespondantAuto', $compagnie->telCorrespondantAuto());
		$query->bindValue(':correspondantSinistre', $compagnie->correspondantSinistre());
		$query->bindValue(':telCorrespondantSinistre', $compagnie->telCorrespondantSinistre());
		$query->bindValue(':correspondantRecouvrement', $compagnie->correspondantRecouvrement());
		$query->bindValue(':telCorrespondantRecouvrement', $compagnie->telCorrespondantRecouvrement());
		$query->bindValue(':adresse', $compagnie->adresse());
		$query->bindValue(':rue', $compagnie->rue());
		$query->bindValue(':fax', $compagnie->fax());
		$query->bindValue(':tel', $compagnie->tel());
		$query->bindValue(':email', $compagnie->email());
		$query->bindValue(':created', $compagnie->created());
		$query->bindValue(':createdBy', $compagnie->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Compagnie $compagnie){
        $query = $this->_db->prepare(' UPDATE t_compagnie SET 
		raisonSociale=:raisonSociale, raisonSocialeAbrege=:raisonSocialeAbrege, codeIntermediaire=:codeIntermediaire, codeMF=:codeMF, correspondantAuto=:correspondantAuto, telCorrespondantAuto=:telCorrespondantAuto, correspondantSinistre=:correspondantSinistre, telCorrespondantSinistre=:telCorrespondantSinistre, correspondantRecouvrement=:correspondantRecouvrement, telCorrespondantRecouvrement=:telCorrespondantRecouvrement, adresse=:adresse, rue=:rue, fax=:fax, tel=:tel, email=:email, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $compagnie->id());
		$query->bindValue(':raisonSociale', $compagnie->raisonSociale());
		$query->bindValue(':raisonSocialeAbrege', $compagnie->raisonSocialeAbrege());
		$query->bindValue(':codeIntermediaire', $compagnie->codeIntermediaire());
		$query->bindValue(':codeMF', $compagnie->codeMF());
		$query->bindValue(':correspondantAuto', $compagnie->correspondantAuto());
		$query->bindValue(':telCorrespondantAuto', $compagnie->telCorrespondantAuto());
		$query->bindValue(':correspondantSinistre', $compagnie->correspondantSinistre());
		$query->bindValue(':telCorrespondantSinistre', $compagnie->telCorrespondantSinistre());
		$query->bindValue(':correspondantRecouvrement', $compagnie->correspondantRecouvrement());
		$query->bindValue(':telCorrespondantRecouvrement', $compagnie->telCorrespondantRecouvrement());
		$query->bindValue(':adresse', $compagnie->adresse());
		$query->bindValue(':rue', $compagnie->rue());
		$query->bindValue(':fax', $compagnie->fax());
		$query->bindValue(':tel', $compagnie->tel());
		$query->bindValue(':email', $compagnie->email());
		$query->bindValue(':updated', $compagnie->updated());
		$query->bindValue(':updatedBy', $compagnie->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_compagnie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_compagnie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Compagnie($data);
	}

	public function getAll(){
        $compagnies = array();
		$query = $this->_db->query('SELECT * FROM t_compagnie
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$compagnies[] = new Compagnie($data);
		}
		$query->closeCursor();
		return $compagnies;
	}

	public function getAllByLimits($begin, $end){
        $compagnies = array();
		$query = $this->_db->prepare('SELECT * FROM t_compagnie ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute(); 
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$compagnies[] = new Compagnie($data);
		}
		$query->closeCursor();
		return $compagnies;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_compagnie
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}