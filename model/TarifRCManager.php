<?php
class TarifRCManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(TarifRC $tarifRC){
        $query = $this->_db->prepare(' INSERT INTO t_tarifrc (
		codeCompagnie, codeUsage, codeClasse, codeSousClasse, carburant, puissanceFiscale, nombrePlace, tonnage, primeRC, majorationRemorque, matiereInflamable, transportPersonne, tauxCommission, tauxTPS, tauxTaxe, timbre, created, createdBy)
		VALUES (:codeCompagnie, :codeUsage, :codeClasse, :codeSousClasse, :carburant, :puissanceFiscale, :nombrePlace, :tonnage, :primeRC, :majorationRemorque, :matiereInflamable, :transportPersonne, :tauxCommission, :tauxTPS, :tauxTaxe, :timbre, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $tarifRC->codeCompagnie());
		$query->bindValue(':codeUsage', $tarifRC->codeUsage());
		$query->bindValue(':codeClasse', $tarifRC->codeClasse());
		$query->bindValue(':codeSousClasse', $tarifRC->codeSousClasse());
		$query->bindValue(':carburant', $tarifRC->carburant());
		$query->bindValue(':puissanceFiscale', $tarifRC->puissanceFiscale());
        $query->bindValue(':nombrePlace', $tarifRC->nombrePlace());
        $query->bindValue(':tonnage', $tarifRC->tonnage());
		$query->bindValue(':primeRC', $tarifRC->primeRC());
		$query->bindValue(':majorationRemorque', $tarifRC->majorationRemorque());
		$query->bindValue(':matiereInflamable', $tarifRC->matiereInflamable());
		$query->bindValue(':transportPersonne', $tarifRC->transportPersonne());
		$query->bindValue(':tauxCommission', $tarifRC->tauxCommission());
		$query->bindValue(':tauxTPS', $tarifRC->tauxTPS());
		$query->bindValue(':tauxTaxe', $tarifRC->tauxTaxe());
		$query->bindValue(':timbre', $tarifRC->timbre());
		$query->bindValue(':created', $tarifRC->created());
		$query->bindValue(':createdBy', $tarifRC->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(TarifRC $tarifRC){
        $query = $this->_db->prepare(' UPDATE t_tarifrc SET 
		codeCompagnie=:codeCompagnie, codeUsage=:codeUsage, codeClasse=:codeClasse, 
		codeSousClasse=:codeSousClasse, carburant=:carburant, puissanceFiscale=:puissanceFiscale, 
		primeRC=:primeRC, majorationRemorque=:majorationRemorque, matiereInflamable=:matiereInflamable, 
		transportPersonne=:transportPersonne, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, 
		tauxTaxe=:tauxTaxe, timbre=:timbre, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $tarifRC->id());
		$query->bindValue(':codeCompagnie', $tarifRC->codeCompagnie());
		$query->bindValue(':codeUsage', $tarifRC->codeUsage());
		$query->bindValue(':codeClasse', $tarifRC->codeClasse());
		$query->bindValue(':codeSousClasse', $tarifRC->codeSousClasse());
		$query->bindValue(':carburant', $tarifRC->carburant());
		$query->bindValue(':puissanceFiscale', $tarifRC->puissanceFiscale());
		$query->bindValue(':primeRC', $tarifRC->primeRC());
		$query->bindValue(':majorationRemorque', $tarifRC->majorationRemorque());
		$query->bindValue(':matiereInflamable', $tarifRC->matiereInflamable());
		$query->bindValue(':transportPersonne', $tarifRC->transportPersonne());
		$query->bindValue(':tauxCommission', $tarifRC->tauxCommission());
		$query->bindValue(':tauxTPS', $tarifRC->tauxTPS());
		$query->bindValue(':tauxTaxe', $tarifRC->tauxTaxe());
		$query->bindValue(':timbre', $tarifRC->timbre());
		$query->bindValue(':updated', $tarifRC->updated());
		$query->bindValue(':updatedBy', $tarifRC->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_tarifrc
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_tarifrc
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new TarifRC($data);
	}

	public function getAll(){
        $tarifRCs = array();
		$query = $this->_db->query('SELECT * FROM t_tarifrc
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifRCs[] = new TarifRC($data);
		}
		$query->closeCursor();
		return $tarifRCs;
	}

	public function getAllByLimits($begin, $end){
        $tarifRCs = array();
		$query = $this->_db->prepare('SELECT * FROM t_tarifrc ORDER BY id ASC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifRCs[] = new TarifRC($data);
		}
		$query->closeCursor();
		return $tarifRCs;
	}
    
    public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS tarifRCsNumber FROM t_tarifrc');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $tarifRCNumber = $data['tarifRCsNumber'];
        return $tarifRCNumber;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_tarifrc
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}