<?php
class TarifFrontiereManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(TarifFrontiere $tarifFrontiere){
        $query = $this->_db->prepare(' INSERT INTO t_tariffrontiere (
		codeCompagnie, codeClasse, codeSousClasse, designation, periode, typePeriode, primeRC, taxe, primeDR, taxeDR, timbre, tauxMajoration, taxeRemorque, tauxCommission, tauxTPS, created, createdBy)
		VALUES (:codeCompagnie, :codeClasse, :codeSousClasse, :designation, :periode, :typePeriode, :primeRC, :taxe, :primeDR, :taxeDR, :timbre, :tauxMajoration, :taxeRemorque, :tauxCommission, :tauxTPS, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeCompagnie', $tarifFrontiere->codeCompagnie());
		$query->bindValue(':codeClasse', $tarifFrontiere->codeClasse());
		$query->bindValue(':codeSousClasse', $tarifFrontiere->codeSousClasse());
		$query->bindValue(':designation', $tarifFrontiere->designation());
		$query->bindValue(':periode', $tarifFrontiere->periode());
		$query->bindValue(':typePeriode', $tarifFrontiere->typePeriode());
		$query->bindValue(':primeRC', $tarifFrontiere->primeRC());
		$query->bindValue(':taxe', $tarifFrontiere->taxe());
		$query->bindValue(':primeDR', $tarifFrontiere->primeDR());
		$query->bindValue(':taxeDR', $tarifFrontiere->taxeDR());
		$query->bindValue(':timbre', $tarifFrontiere->timbre());
		$query->bindValue(':tauxMajoration', $tarifFrontiere->tauxMajoration());
		$query->bindValue(':taxeRemorque', $tarifFrontiere->taxeRemorque());
		$query->bindValue(':tauxCommission', $tarifFrontiere->tauxCommission());
		$query->bindValue(':tauxTPS', $tarifFrontiere->tauxTPS());
		$query->bindValue(':created', $tarifFrontiere->created());
		$query->bindValue(':createdBy', $tarifFrontiere->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(TarifFrontiere $tarifFrontiere){
        $query = $this->_db->prepare(' UPDATE t_tariffrontiere SET 
		codeCompagnie=:codeCompagnie, codeClasse=:codeClasse, codeSousClasse=:codeSousClasse, designation=:designation, periode=:periode, typePeriode=:typePeriode, primeRC=:primeRC, taxe=:taxe, primeDR=:primeDR, taxeDR=:taxeDR, timbre=:timbre, tauxMajoration=:tauxMajoration, taxeRemorque=:taxeRemorque, tauxCommission=:tauxCommission, tauxTPS=:tauxTPS, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $tarifFrontiere->id());
		$query->bindValue(':codeCompagnie', $tarifFrontiere->codeCompagnie());
		$query->bindValue(':codeClasse', $tarifFrontiere->codeClasse());
		$query->bindValue(':codeSousClasse', $tarifFrontiere->codeSousClasse());
		$query->bindValue(':designation', $tarifFrontiere->designation());
		$query->bindValue(':periode', $tarifFrontiere->periode());
		$query->bindValue(':typePeriode', $tarifFrontiere->typePeriode());
		$query->bindValue(':primeRC', $tarifFrontiere->primeRC());
		$query->bindValue(':taxe', $tarifFrontiere->taxe());
		$query->bindValue(':primeDR', $tarifFrontiere->primeDR());
		$query->bindValue(':taxeDR', $tarifFrontiere->taxeDR());
		$query->bindValue(':timbre', $tarifFrontiere->timbre());
		$query->bindValue(':tauxMajoration', $tarifFrontiere->tauxMajoration());
		$query->bindValue(':taxeRemorque', $tarifFrontiere->taxeRemorque());
		$query->bindValue(':tauxCommission', $tarifFrontiere->tauxCommission());
		$query->bindValue(':tauxTPS', $tarifFrontiere->tauxTPS());
		$query->bindValue(':updated', $tarifFrontiere->updated());
		$query->bindValue(':updatedBy', $tarifFrontiere->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_tariffrontiere
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_tariffrontiere
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new TarifFrontiere($data);
	}

	public function getAll(){
        $tarifFrontieres = array();
		$query = $this->_db->query('SELECT * FROM t_tariffrontiere
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifFrontieres[] = new TarifFrontiere($data);
		}
		$query->closeCursor();
		return $tarifFrontieres;
	}

	public function getAllByLimits($begin, $end){
        $tarifFrontieres = array();
		$query = $this->_db->prepare('SELECT * FROM t_tariffrontiere ORDER BY id ASC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifFrontieres[] = new TarifFrontiere($data);
		}
		$query->closeCursor();
		return $tarifFrontieres;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS tarifFrontieresNumber FROM t_tariffrontiere');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $tarifFrontiere = $data['tarifFrontieresNumber'];
        return $tarifFrontiere;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_tariffrontiere
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}