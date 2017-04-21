<?php
class IncendieManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Incendie $incendie){
        $query = $this->_db->prepare(' INSERT INTO t_incendie (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, formuleIncendie, tauxMille, tauxCommission, tauxTPS, tauxTaxe, designation, montantFranchise, tauxFranchise, montant, formule, observation, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :formuleIncendie, :tauxMille, :tauxCommission, :tauxTPS, :tauxTaxe, :designation, :montantFranchise, :tauxFranchise, :montant, :formule, :observation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $incendie->codeCompagnie());
		$query->bindValue(':codeUsage', $incendie->codeUsage());
		$query->bindValue(':codeClasse', $incendie->codeClasse());
		$query->bindValue(':codeSousClasse', $incendie->codeSousClasse());
		$query->bindValue(':formuleIncendie', $incendie->formuleIncendie());
		$query->bindValue(':tauxMille', $incendie->tauxMille());
		$query->bindValue(':tauxCommission', $incendie->tauxCommission());
		$query->bindValue(':tauxTPS', $incendie->tauxTPS());
		$query->bindValue(':tauxTaxe', $incendie->tauxTaxe());
		$query->bindValue(':designation', $incendie->designation());
		$query->bindValue(':montantFranchise', $incendie->montantFranchise());
		$query->bindValue(':tauxFranchise', $incendie->tauxFranchise());
		$query->bindValue(':montant', $incendie->montant());
		$query->bindValue(':formule', $incendie->formule());
		$query->bindValue(':observation', $incendie->observation());
		$query->bindValue(':created', $incendie->created());
		$query->bindValue(':createdBy', $incendie->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Incendie $incendie){
        $query = $this->_db->prepare(' UPDATE t_incendie SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, codeSousClasse=:codeSousClasse, formuleIncendie=:formuleIncendie, tauxMille=:tauxMille, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, tauxTaxe=:tauxTaxe, designation=:designation, montantFranchise=:montantFranchise, tauxFranchise=:tauxFranchise, montant=:montant, formule=:formule, observation=:observation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $incendie->id());
		$query->bindValue(':codeCompagnie', $incendie->codeCompagnie());
		$query->bindValue(':codeUsage', $incendie->codeUsage());
		$query->bindValue(':codeClasse', $incendie->codeClasse());
		$query->bindValue(':codeSousClasse', $incendie->codeSousClasse());
		$query->bindValue(':formuleIncendie', $incendie->formuleIncendie());
		$query->bindValue(':tauxMille', $incendie->tauxMille());
		$query->bindValue(':tauxCommission', $incendie->tauxCommission());
		$query->bindValue(':tauxTPS', $incendie->tauxTPS());
		$query->bindValue(':tauxTaxe', $incendie->tauxTaxe());
		$query->bindValue(':designation', $incendie->designation());
		$query->bindValue(':montantFranchise', $incendie->montantFranchise());
		$query->bindValue(':tauxFranchise', $incendie->tauxFranchise());
		$query->bindValue(':montant', $incendie->montant());
		$query->bindValue(':formule', $incendie->formule());
		$query->bindValue(':observation', $incendie->observation());
		$query->bindValue(':updated', $incendie->updated());
		$query->bindValue(':updatedBy', $incendie->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_incendie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_incendie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Incendie($data);
	}

	public function getAll(){
        $incendies = array();
		$query = $this->_db->query('SELECT * FROM t_incendie
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$incendies[] = new Incendie($data);
		}
		$query->closeCursor();
		return $incendies;
	}

	public function getAllByLimits($begin, $end){
        $incendies = array();
		$query = $this->_db->prepare('SELECT * FROM t_incendie ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute(); 
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$incendies[] = new Incendie($data);
		}
		$query->closeCursor();
		return $incendies;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS incendiesNumber FROM t_incendie');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $incendie = $data['incendiesNumber'];
        return $incendie;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_incendie
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}