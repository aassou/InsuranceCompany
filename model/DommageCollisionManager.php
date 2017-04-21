<?php
class DommageCollisionManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(DommageCollision $dommageCollision){
        $query = $this->_db->prepare(' INSERT INTO t_dommagecollision (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, carburant, puissanceFiscale, formuleCollision, 
		primeFixe, franchise, plafond, tauxCommission, tauxTPS, tauxTaxe, observation, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :carburant, :puissanceFiscale, 
        :formuleCollision, :primeFixe, :franchise, :plafond, :tauxCommission, :tauxTPS, :tauxTaxe, 
        :observation, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $dommageCollision->codeCompagnie());
		$query->bindValue(':codeUsage', $dommageCollision->codeUsage());
		$query->bindValue(':codeClasse', $dommageCollision->codeClasse());
		$query->bindValue(':codeSousClasse', $dommageCollision->codeSousClasse());
		$query->bindValue(':carburant', $dommageCollision->carburant());
		$query->bindValue(':puissanceFiscale', $dommageCollision->puissanceFiscale());
		$query->bindValue(':formuleCollision', $dommageCollision->formuleCollision());
		$query->bindValue(':primeFixe', $dommageCollision->primeFixe());
		$query->bindValue(':franchise', $dommageCollision->franchise());
		$query->bindValue(':plafond', $dommageCollision->plafond());
		$query->bindValue(':tauxCommission', $dommageCollision->tauxCommission());
		$query->bindValue(':tauxTPS', $dommageCollision->tauxTPS());
		$query->bindValue(':tauxTaxe', $dommageCollision->tauxTaxe());
		$query->bindValue(':observation', $dommageCollision->observation());
		$query->bindValue(':created', $dommageCollision->created());
		$query->bindValue(':createdBy', $dommageCollision->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(DommageCollision $dommageCollision){
        $query = $this->_db->prepare(' UPDATE t_dommagecollision SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, 
		codeSousClasse=:codeSousClasse, carburant=:carburant, puissanceFiscale=:puissanceFiscale, 
		formuleCollision=:formuleCollision, primeFixe=:primeFixe, franchise=:franchise, plafond=:plafond, 
		tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, tauxTaxe=:tauxTaxe, observation=:observation, 
		updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $dommageCollision->id());
		$query->bindValue(':codeCompagnie', $dommageCollision->codeCompagnie());
		$query->bindValue(':codeUsage', $dommageCollision->codeUsage());
		$query->bindValue(':codeClasse', $dommageCollision->codeClasse());
		$query->bindValue(':codeSousClasse', $dommageCollision->codeSousClasse());
		$query->bindValue(':carburant', $dommageCollision->carburant());
		$query->bindValue(':puissanceFiscale', $dommageCollision->puissanceFiscale());
		$query->bindValue(':formuleCollision', $dommageCollision->formuleCollision());
		$query->bindValue(':primeFixe', $dommageCollision->primeFixe());
		$query->bindValue(':franchise', $dommageCollision->franchise());
		$query->bindValue(':plafond', $dommageCollision->plafond());
		$query->bindValue(':tauxCommission', $dommageCollision->tauxCommission());
		$query->bindValue(':tauxTPS', $dommageCollision->tauxTPS());
		$query->bindValue(':tauxTaxe', $dommageCollision->tauxTaxe());
		$query->bindValue(':observation', $dommageCollision->observation());
		$query->bindValue(':updated', $dommageCollision->updated());
		$query->bindValue(':updatedBy', $dommageCollision->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare('DELETE FROM t_dommagecollision WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare('SELECT * FROM t_dommagecollision WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new DommageCollision($data);
	}

	public function getAll(){
        $dommageCollisions = array();
		$query = $this->_db->query('SELECT * FROM t_dommagecollision ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$dommageCollisions[] = new DommageCollision($data);
		}
		$query->closeCursor();
		return $dommageCollisions;
	}

	public function getAllByLimits($begin, $end){
        $dommageCollisions = array();
		$query = $this->_db->prepare('SELECT * FROM t_dommagecollision ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute(); 
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$dommageCollisions[] = new DommageCollision($data);
		}
		$query->closeCursor();
		return $dommageCollisions;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS dommageCollisionsNumber FROM t_dommagecollision');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $dommageCollision = $data['dommageCollisionsNumber'];
        return $dommageCollision;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_dommagecollision ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}