<?php
class TierceManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Tierce $tierce){
        $query = $this->_db->prepare(' INSERT INTO t_tierce (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, formuleTierce, primeFixe, tauxVehiculeNeuf, majorationRemorque, tauxCommission, tauxTPS, tauxTaxe, tauxFranchise, montantFranchise, observation, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :formuleTierce, :primeFixe, :tauxVehiculeNeuf, :majorationRemorque, :tauxCommission, :tauxTPS, :tauxTaxe, :tauxFranchise, :montantFranchise, :observation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $tierce->codeCompagnie());
		$query->bindValue(':codeUsage', $tierce->codeUsage());
		$query->bindValue(':codeClasse', $tierce->codeClasse());
		$query->bindValue(':codeSousClasse', $tierce->codeSousClasse());
		$query->bindValue(':formuleTierce', $tierce->formuleTierce());
		$query->bindValue(':primeFixe', $tierce->primeFixe());
		$query->bindValue(':tauxVehiculeNeuf', $tierce->tauxVehiculeNeuf());
		$query->bindValue(':majorationRemorque', $tierce->majorationRemorque());
		$query->bindValue(':tauxCommission', $tierce->tauxCommission());
		$query->bindValue(':tauxTPS', $tierce->tauxTPS());
		$query->bindValue(':tauxTaxe', $tierce->tauxTaxe());
		$query->bindValue(':tauxFranchise', $tierce->tauxFranchise());
		$query->bindValue(':montantFranchise', $tierce->montantFranchise());
		$query->bindValue(':observation', $tierce->observation());
		$query->bindValue(':created', $tierce->created());
		$query->bindValue(':createdBy', $tierce->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Tierce $tierce){
        $query = $this->_db->prepare(' UPDATE t_tierce SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, codeSousClasse=:codeSousClasse, formuleTierce=:formuleTierce, primeFixe=:primeFixe, tauxVehiculeNeuf=:tauxVehiculeNeuf, majorationRemorque=:majorationRemorque, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, tauxTaxe=:tauxTaxe, tauxFranchise=:tauxFranchise, montantFranchise=:montantFranchise, observation=:observation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $tierce->id());
		$query->bindValue(':codeCompagnie', $tierce->codeCompagnie());
		$query->bindValue(':codeUsage', $tierce->codeUsage());
		$query->bindValue(':codeClasse', $tierce->codeClasse());
		$query->bindValue(':codeSousClasse', $tierce->codeSousClasse());
		$query->bindValue(':formuleTierce', $tierce->formuleTierce());
		$query->bindValue(':primeFixe', $tierce->primeFixe());
		$query->bindValue(':tauxVehiculeNeuf', $tierce->tauxVehiculeNeuf());
		$query->bindValue(':majorationRemorque', $tierce->majorationRemorque());
		$query->bindValue(':tauxCommission', $tierce->tauxCommission());
		$query->bindValue(':tauxTPS', $tierce->tauxTPS());
		$query->bindValue(':tauxTaxe', $tierce->tauxTaxe());
		$query->bindValue(':tauxFranchise', $tierce->tauxFranchise());
		$query->bindValue(':montantFranchise', $tierce->montantFranchise());
		$query->bindValue(':observation', $tierce->observation());
		$query->bindValue(':updated', $tierce->updated());
		$query->bindValue(':updatedBy', $tierce->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_tierce
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_tierce
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Tierce($data);
	}

	public function getAll(){
        $tierces = array();
		$query = $this->_db->query('SELECT * FROM t_tierce
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tierces[] = new Tierce($data);
		}
		$query->closeCursor();
		return $tierces;
	}

	public function getAllByLimits($begin, $end){
        $tierces = array();
		$query = $this->_db->prepare('SELECT * FROM t_tierce ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tierces[] = new Tierce($data);
		}
		$query->closeCursor();
		return $tierces;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS tiercesNumber FROM t_tierce');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $tierce = $data['tiercesNumber'];
        return $tierce;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_tierce
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}