<?php
class IndividuelConducteurManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(IndividuelConducteur $individuelConducteur){
        $query = $this->_db->prepare(' INSERT INTO t_individuelconducteur (
		codeCompagnie, codeUsage, formuleIndividuel, capitalDeces, capitalInvalidite, montantFrais, primeNette, tauxTaxe, accessoireIndividuel, tauxCommission, tauxTPS, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :formuleIndividuel, :capitalDeces, :capitalInvalidite, :montantFrais, :primeNette, :tauxTaxe, :accessoireIndividuel, :tauxCommission, :tauxTPS, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $individuelConducteur->codeCompagnie());
		$query->bindValue(':codeUsage', $individuelConducteur->codeUsage());
		$query->bindValue(':formuleIndividuel', $individuelConducteur->formuleIndividuel());
		$query->bindValue(':capitalDeces', $individuelConducteur->capitalDeces());
		$query->bindValue(':capitalInvalidite', $individuelConducteur->capitalInvalidite());
		$query->bindValue(':montantFrais', $individuelConducteur->montantFrais());
		$query->bindValue(':primeNette', $individuelConducteur->primeNette());
		$query->bindValue(':tauxTaxe', $individuelConducteur->tauxTaxe());
		$query->bindValue(':accessoireIndividuel', $individuelConducteur->accessoireIndividuel());
		$query->bindValue(':tauxCommission', $individuelConducteur->tauxCommission());
		$query->bindValue(':tauxTPS', $individuelConducteur->tauxTPS());
		$query->bindValue(':created', $individuelConducteur->created());
		$query->bindValue(':createdBy', $individuelConducteur->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(IndividuelConducteur $individuelConducteur){
        $query = $this->_db->prepare(' UPDATE t_individuelconducteur SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, formuleIndividuel=:formuleIndividuel, capitalDeces=:capitalDeces, capitalInvalidite=:capitalInvalidite, montantFrais=:montantFrais, primeNette=:primeNette, tauxTaxe=:tauxTaxe, accessoireIndividuel=:accessoireIndividuel, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $individuelConducteur->id());
		$query->bindValue(':codeCompagnie', $individuelConducteur->codeCompagnie());
		$query->bindValue(':codeUsage', $individuelConducteur->codeUsage());
		$query->bindValue(':formuleIndividuel', $individuelConducteur->formuleIndividuel());
		$query->bindValue(':capitalDeces', $individuelConducteur->capitalDeces());
		$query->bindValue(':capitalInvalidite', $individuelConducteur->capitalInvalidite());
		$query->bindValue(':montantFrais', $individuelConducteur->montantFrais());
		$query->bindValue(':primeNette', $individuelConducteur->primeNette());
		$query->bindValue(':tauxTaxe', $individuelConducteur->tauxTaxe());
		$query->bindValue(':accessoireIndividuel', $individuelConducteur->accessoireIndividuel());
		$query->bindValue(':tauxCommission', $individuelConducteur->tauxCommission());
		$query->bindValue(':tauxTPS', $individuelConducteur->tauxTPS());
		$query->bindValue(':updated', $individuelConducteur->updated());
		$query->bindValue(':updatedBy', $individuelConducteur->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_individuelconducteur
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_individuelconducteur
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new IndividuelConducteur($data);
	}

	public function getAll(){
        $individuelConducteurs = array();
		$query = $this->_db->query('SELECT * FROM t_individuelconducteur
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$individuelConducteurs[] = new IndividuelConducteur($data);
		}
		$query->closeCursor();
		return $individuelConducteurs;
	}

	public function getAllByLimits($begin, $end){
        $individuelConducteurs = array();
		$query = $this->_db->prepare('SELECT * FROM t_individuelconducteur ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$individuelConducteurs[] = new IndividuelConducteur($data);
		}
		$query->closeCursor();
		return $individuelConducteurs;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS individuelConducteursNumber FROM t_individuelconducteur');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $individuelConducteur = $data['individuelConducteursNumber'];
        return $individuelConducteur;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_individuelconducteur
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}