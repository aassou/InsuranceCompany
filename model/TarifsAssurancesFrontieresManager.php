<?php
class TarifsAssurancesFrontieresManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(TarifsAssurancesFrontieres $tarifsAssurancesFrontieres){
        $query = $this->_db->prepare(' INSERT INTO t_tarifsassurancesfrontieres (
		typeUsage, periode, primeRC, taxes, primeDR, taxesDR, timbre, primeTotale, tauxPrimeRemorque, created, createdBy)
		VALUES (:typeUsage, :periode, :primeRC, :taxes, :primeDR, :taxesDR, :timbre, :primeTotale, :tauxPrimeRemorque, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':typeUsage', $tarifsAssurancesFrontieres->typeUsage());
		$query->bindValue(':periode', $tarifsAssurancesFrontieres->periode());
		$query->bindValue(':primeRC', $tarifsAssurancesFrontieres->primeRC());
		$query->bindValue(':taxes', $tarifsAssurancesFrontieres->taxes());
		$query->bindValue(':primeDR', $tarifsAssurancesFrontieres->primeDR());
		$query->bindValue(':taxesDR', $tarifsAssurancesFrontieres->taxesDR());
		$query->bindValue(':timbre', $tarifsAssurancesFrontieres->timbre());
		$query->bindValue(':primeTotale', $tarifsAssurancesFrontieres->primeTotale());
		$query->bindValue(':tauxPrimeRemorque', $tarifsAssurancesFrontieres->tauxPrimeRemorque());
		$query->bindValue(':created', $tarifsAssurancesFrontieres->created());
		$query->bindValue(':createdBy', $tarifsAssurancesFrontieres->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(TarifsAssurancesFrontieres $tarifsAssurancesFrontieres){
        $query = $this->_db->prepare(' UPDATE t_tarifsassurancesfrontieres SET 
		typeUsage=:typeUsage, periode=:periode, primeRC=:primeRC, taxes=:taxes, primeDR=:primeDR, taxesDR=:taxesDR, timbre=:timbre, primeTotale=:primeTotale, tauxPrimeRemorque=:tauxPrimeRemorque, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $tarifsAssurancesFrontieres->id());
		$query->bindValue(':typeUsage', $tarifsAssurancesFrontieres->typeUsage());
		$query->bindValue(':periode', $tarifsAssurancesFrontieres->periode());
		$query->bindValue(':primeRC', $tarifsAssurancesFrontieres->primeRC());
		$query->bindValue(':taxes', $tarifsAssurancesFrontieres->taxes());
		$query->bindValue(':primeDR', $tarifsAssurancesFrontieres->primeDR());
		$query->bindValue(':taxesDR', $tarifsAssurancesFrontieres->taxesDR());
		$query->bindValue(':timbre', $tarifsAssurancesFrontieres->timbre());
		$query->bindValue(':primeTotale', $tarifsAssurancesFrontieres->primeTotale());
		$query->bindValue(':tauxPrimeRemorque', $tarifsAssurancesFrontieres->tauxPrimeRemorque());
		$query->bindValue(':updated', $tarifsAssurancesFrontieres->updated());
		$query->bindValue(':updatedBy', $tarifsAssurancesFrontieres->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_tarifsassurancesfrontieres
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_tarifsassurancesfrontieres
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new TarifsAssurancesFrontieres($data);
	}

	public function getAll(){
        $tarifsAssurancesFrontieress = array();
		$query = $this->_db->query('SELECT * FROM t_tarifsassurancesfrontieres
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifsAssurancesFrontieress[] = new TarifsAssurancesFrontieres($data);
		}
		$query->closeCursor();
		return $tarifsAssurancesFrontieress;
	}

	public function getAllByLimits($begin, $end){
        $tarifsAssurancesFrontieress = array();
		$query = $this->_db->query('SELECT * FROM t_tarifsassurancesfrontieres
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$tarifsAssurancesFrontieress[] = new TarifsAssurancesFrontieres($data);
		}
		$query->closeCursor();
		return $tarifsAssurancesFrontieress;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS tarifsAssurancesFrontieressNumber FROM t_tarifsassurancesfrontieres');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $tarifsAssurancesFrontieres = $data['tarifsAssurancesFrontieressNumber'];
        return $tarifsAssurancesFrontieres;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_tarifsassurancesfrontieres
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}