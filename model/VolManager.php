<?php
class VolManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Vol $vol){
        $query = $this->_db->prepare(' INSERT INTO t_vol (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, formuleVol, tauxMille, tauxCommission, tauxTPS, tauxTaxe, montantFranchise, tauxFranchise, montant, formule, observation, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :formuleVol, :tauxMille, :tauxCommission, :tauxTPS, :tauxTaxe, :montantFranchise, :tauxFranchise, :montant, :formule, :observation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $vol->codeCompagnie());
		$query->bindValue(':codeUsage', $vol->codeUsage());
		$query->bindValue(':codeClasse', $vol->codeClasse());
		$query->bindValue(':codeSousClasse', $vol->codeSousClasse());
		$query->bindValue(':formuleVol', $vol->formuleVol());
		$query->bindValue(':tauxMille', $vol->tauxMille());
		$query->bindValue(':tauxCommission', $vol->tauxCommission());
		$query->bindValue(':tauxTPS', $vol->tauxTPS());
		$query->bindValue(':tauxTaxe', $vol->tauxTaxe());
		$query->bindValue(':montantFranchise', $vol->montantFranchise());
		$query->bindValue(':tauxFranchise', $vol->tauxFranchise());
		$query->bindValue(':montant', $vol->montant());
		$query->bindValue(':formule', $vol->formule());
		$query->bindValue(':observation', $vol->observation());
		$query->bindValue(':created', $vol->created());
		$query->bindValue(':createdBy', $vol->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Vol $vol){
        $query = $this->_db->prepare(' UPDATE t_vol SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, codeSousClasse=:codeSousClasse, formuleVol=:formuleVol, tauxMille=:tauxMille, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, tauxTaxe=:tauxTaxe, montantFranchise=:montantFranchise, tauxFranchise=:tauxFranchise, montant=:montant, formule=:formule, observation=:observation, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $vol->id());
		$query->bindValue(':codeCompagnie', $vol->codeCompagnie());
		$query->bindValue(':codeUsage', $vol->codeUsage());
		$query->bindValue(':codeClasse', $vol->codeClasse());
		$query->bindValue(':codeSousClasse', $vol->codeSousClasse());
		$query->bindValue(':formuleVol', $vol->formuleVol());
		$query->bindValue(':tauxMille', $vol->tauxMille());
		$query->bindValue(':tauxCommission', $vol->tauxCommission());
		$query->bindValue(':tauxTPS', $vol->tauxTPS());
		$query->bindValue(':tauxTaxe', $vol->tauxTaxe());
		$query->bindValue(':montantFranchise', $vol->montantFranchise());
		$query->bindValue(':tauxFranchise', $vol->tauxFranchise());
		$query->bindValue(':montant', $vol->montant());
		$query->bindValue(':formule', $vol->formule());
		$query->bindValue(':observation', $vol->observation());
		$query->bindValue(':updated', $vol->updated());
		$query->bindValue(':updatedBy', $vol->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_vol
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_vol
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Vol($data);
	}

	public function getAll(){
        $vols = array();
		$query = $this->_db->query('SELECT * FROM t_vol
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$vols[] = new Vol($data);
		}
		$query->closeCursor();
		return $vols;
	}

	public function getAllByLimits($begin, $end){
        $vols = array();
		$query = $this->_db->prepare('SELECT * FROM t_vol ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$vols[] = new Vol($data);
		}
		$query->closeCursor();
		return $vols;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS volsNumber FROM t_vol');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $vol = $data['volsNumber'];
        return $vol;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_vol
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}