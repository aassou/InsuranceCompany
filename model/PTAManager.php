<?php
class PTAManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(PTA $PTA){
        $query = $this->_db->prepare(' INSERT INTO t_pta (
		codeCompagnie, codeUsage, formulePTA, nombrePlace, capitalDeces, capitalInvalidite, montantFrais, primeNette, tauxTaxe, accessoirePTA, tauxCommission, tauxTPS, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :formulePTA, :nombrePlace, :capitalDeces, :capitalInvalidite, :montantFrais, :primeNette, :tauxTaxe, :accessoirePTA, :tauxCommission, :tauxTPS, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $PTA->codeCompagnie());
		$query->bindValue(':codeUsage', $PTA->codeUsage());
		$query->bindValue(':formulePTA', $PTA->formulePTA());
		$query->bindValue(':nombrePlace', $PTA->nombrePlace());
		$query->bindValue(':capitalDeces', $PTA->capitalDeces());
		$query->bindValue(':capitalInvalidite', $PTA->capitalInvalidite());
		$query->bindValue(':montantFrais', $PTA->montantFrais());
		$query->bindValue(':primeNette', $PTA->primeNette());
		$query->bindValue(':tauxTaxe', $PTA->tauxTaxe());
		$query->bindValue(':accessoirePTA', $PTA->accessoirePTA());
		$query->bindValue(':tauxCommission', $PTA->tauxCommission());
		$query->bindValue(':tauxTPS', $PTA->tauxTPS());
		$query->bindValue(':created', $PTA->created());
		$query->bindValue(':createdBy', $PTA->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(PTA $PTA){
        $query = $this->_db->prepare(' UPDATE t_pta SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, formulePTA=:formulePTA, nombrePlace=:nombrePlace, capitalDeces=:capitalDeces, capitalInvalidite=:capitalInvalidite, montantFrais=:montantFrais, primeNette=:primeNette, tauxTaxe=:tauxTaxe, accessoirePTA=:accessoirePTA, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $PTA->id());
		$query->bindValue(':codeCompagnie', $PTA->codeCompagnie());
		$query->bindValue(':codeUsage', $PTA->codeUsage());
		$query->bindValue(':formulePTA', $PTA->formulePTA());
		$query->bindValue(':nombrePlace', $PTA->nombrePlace());
		$query->bindValue(':capitalDeces', $PTA->capitalDeces());
		$query->bindValue(':capitalInvalidite', $PTA->capitalInvalidite());
		$query->bindValue(':montantFrais', $PTA->montantFrais());
		$query->bindValue(':primeNette', $PTA->primeNette());
		$query->bindValue(':tauxTaxe', $PTA->tauxTaxe());
		$query->bindValue(':accessoirePTA', $PTA->accessoirePTA());
		$query->bindValue(':tauxCommission', $PTA->tauxCommission());
		$query->bindValue(':tauxTPS', $PTA->tauxTPS());
		$query->bindValue(':updated', $PTA->updated());
		$query->bindValue(':updatedBy', $PTA->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_pta
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getPTAById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_pta
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new PTA($data);
	}

	public function getPTAs(){
        $PTAs = array();
		$query = $this->_db->query('SELECT * FROM t_pta
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$PTAs[] = new PTA($data);
		}
		$query->closeCursor();
		return $PTAs;
	}

	public function getPTAsByLimits($begin, $end){
        $PTAs = array();
		$query = $this->_db->query('SELECT * FROM t_pta
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$PTAs[] = new PTA($data);
		}
		$query->closeCursor();
		return $PTAs;
	}

	public function getPTAsNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS PTAsNumber FROM t_pta');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $PTA = $data['PTAsNumber'];
        return $PTA;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_pta
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}