<?php
class DefenseRecoursManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(DefenseRecours $defenseRecours){
        $query = $this->_db->prepare(' INSERT INTO t_defenserecours (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, puissanceFiscale, typeDefense, valeurDefense, 
		formuleDefense, tauxCommission, tauxTPS, tauxTaxe, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :puissanceFiscale, :typeDefense, 
        :valeurDefense, :formuleDefense, :tauxCommission, :tauxTPS, :tauxTaxe, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $defenseRecours->codeCompagnie());
		$query->bindValue(':codeUsage', $defenseRecours->codeUsage());
		$query->bindValue(':codeClasse', $defenseRecours->codeClasse());
		$query->bindValue(':codeSousClasse', $defenseRecours->codeSousClasse());
		$query->bindValue(':puissanceFiscale', $defenseRecours->puissanceFiscale());
		$query->bindValue(':typeDefense', $defenseRecours->typeDefense());
		$query->bindValue(':valeurDefense', $defenseRecours->valeurDefense());
		$query->bindValue(':formuleDefense', $defenseRecours->formuleDefense());
		$query->bindValue(':tauxCommission', $defenseRecours->tauxCommission());
		$query->bindValue(':tauxTPS', $defenseRecours->tauxTPS());
		$query->bindValue(':tauxTaxe', $defenseRecours->tauxTaxe());
		$query->bindValue(':created', $defenseRecours->created());
		$query->bindValue(':createdBy', $defenseRecours->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(DefenseRecours $defenseRecours){
        $query = $this->_db->prepare(' UPDATE t_defenserecours SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, 
		codeSousClasse=:codeSousClasse, puissanceFiscale=:puissanceFiscale, typeDefense=:typeDefense, 
		valeurDefense=:valeurDefense, formuleDefense=:formuleDefense, tauxCommission=:tauxCommission, 
		tauxTPS=:tauxTPS, tauxTaxe=:tauxTaxe, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $defenseRecours->id());
		$query->bindValue(':codeCompagnie', $defenseRecours->codeCompagnie());
		$query->bindValue(':codeUsage', $defenseRecours->codeUsage());
		$query->bindValue(':codeClasse', $defenseRecours->codeClasse());
		$query->bindValue(':codeSousClasse', $defenseRecours->codeSousClasse());
		$query->bindValue(':puissanceFiscale', $defenseRecours->puissanceFiscale());
		$query->bindValue(':typeDefense', $defenseRecours->typeDefense());
		$query->bindValue(':valeurDefense', $defenseRecours->valeurDefense());
		$query->bindValue(':formuleDefense', $defenseRecours->formuleDefense());
		$query->bindValue(':tauxCommission', $defenseRecours->tauxCommission());
		$query->bindValue(':tauxTPS', $defenseRecours->tauxTPS());
		$query->bindValue(':tauxTaxe', $defenseRecours->tauxTaxe());
		$query->bindValue(':updated', $defenseRecours->updated());
		$query->bindValue(':updatedBy', $defenseRecours->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare('DELETE FROM t_defenserecours WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare('SELECT * FROM t_defenserecours WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new DefenseRecours($data);
	}

	public function getAll(){
        $defenseRecourss = array();
		$query = $this->_db->query('SELECT * FROM t_defenserecours ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$defenseRecourss[] = new DefenseRecours($data);
		}
		$query->closeCursor();
		return $defenseRecourss;
	}

	public function getAllByLimits($begin, $end){
        $defenseRecourss = array();
		$query = $this->_db->query('SELECT * FROM t_defenserecours ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$defenseRecourss[] = new DefenseRecours($data);
		}
		$query->closeCursor();
		return $defenseRecourss;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS defenseRecourssNumber FROM t_defenserecours');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $defenseRecours = $data['defenseRecourssNumber'];
        return $defenseRecours;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_defenserecours ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}