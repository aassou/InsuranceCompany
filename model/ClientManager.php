<?php
class ClientManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Client $client){
        $query = $this->_db->prepare('INSERT INTO t_client (
		codeClient, generatedCode, typeClient, civilite, nom, adresse, rue, ville, activite, email, 
		debit, credit, tel1, fax, permis, datePermis, tel2, codeRegion, codeCommercial, situationFamiliale, 
		cin, dateNaissance, solvabilite, nombreIncident, created, createdBy)
		VALUES (:codeClient, :generatedCode, :typeClient, :civilite, :nom, :adresse, :rue, :ville, :activite, 
        :email, :debit, :credit, :tel1, :fax, :permis, :datePermis, :tel2, :codeRegion, :codeCommercial, 
        :situationFamiliale, :cin, :dateNaissance, :solvabilite, :nombreIncident, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':codeClient', $client->codeClient());
        $query->bindValue(':generatedCode', $client->generatedCode());
		$query->bindValue(':typeClient', $client->typeClient());
		$query->bindValue(':civilite', $client->civilite());
		$query->bindValue(':nom', $client->nom());
		$query->bindValue(':adresse', $client->adresse());
		$query->bindValue(':rue', $client->rue());
		$query->bindValue(':ville', $client->ville());
		$query->bindValue(':activite', $client->activite());
		$query->bindValue(':email', $client->email());
		$query->bindValue(':debit', $client->debit());
		$query->bindValue(':credit', $client->credit());
		$query->bindValue(':tel1', $client->tel1());
		$query->bindValue(':fax', $client->fax());
		$query->bindValue(':permis', $client->permis());
		$query->bindValue(':datePermis', $client->datePermis());
		$query->bindValue(':tel2', $client->tel2());
		$query->bindValue(':codeRegion', $client->codeRegion());
		$query->bindValue(':codeCommercial', $client->codeCommercial());
		$query->bindValue(':situationFamiliale', $client->situationFamiliale());
		$query->bindValue(':cin', $client->cin());
		$query->bindValue(':dateNaissance', $client->dateNaissance());
		$query->bindValue(':solvabilite', $client->solvabilite());
		$query->bindValue(':nombreIncident', $client->nombreIncident());
		$query->bindValue(':created', $client->created());
		$query->bindValue(':createdBy', $client->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Client $client){
        $query = $this->_db->prepare('UPDATE t_client SET 
		codeClient=:codeClient, generatedCode=:generatedCode,typeClient=:typeClient, civilite=:civilite, 
		nom=:nom, adresse=:adresse, rue=:rue, ville=:ville, activite=:activite, email=:email, debit=:debit, 
		credit=:credit, tel1=:tel1, fax=:fax, permis=:permis, datePermis=:datePermis, tel2=:tel2, 
		codeRegion=:codeRegion, codeCommercial=:codeCommercial, situationFamiliale=:situationFamiliale, 
		cin=:cin, dateNaissance=:dateNaissance, solvabilite=:solvabilite, nombreIncident=:nombreIncident, 
		updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $client->id());
		$query->bindValue(':codeClient', $client->codeClient());
        $query->bindValue(':generatedCode', $client->generatedCode());
		$query->bindValue(':typeClient', $client->typeClient());
		$query->bindValue(':civilite', $client->civilite());
		$query->bindValue(':nom', $client->nom());
		$query->bindValue(':adresse', $client->adresse());
		$query->bindValue(':rue', $client->rue());
		$query->bindValue(':ville', $client->ville());
		$query->bindValue(':activite', $client->activite());
		$query->bindValue(':email', $client->email());
		$query->bindValue(':debit', $client->debit());
		$query->bindValue(':credit', $client->credit());
		$query->bindValue(':tel1', $client->tel1());
		$query->bindValue(':fax', $client->fax());
		$query->bindValue(':permis', $client->permis());
		$query->bindValue(':datePermis', $client->datePermis());
		$query->bindValue(':tel2', $client->tel2());
		$query->bindValue(':codeRegion', $client->codeRegion());
		$query->bindValue(':codeCommercial', $client->codeCommercial());
		$query->bindValue(':situationFamiliale', $client->situationFamiliale());
		$query->bindValue(':cin', $client->cin());
		$query->bindValue(':dateNaissance', $client->dateNaissance());
		$query->bindValue(':solvabilite', $client->solvabilite());
		$query->bindValue(':nombreIncident', $client->nombreIncident());
		$query->bindValue(':updated', $client->updated());
		$query->bindValue(':updatedBy', $client->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

    public function update2($id, $nom, $adresse, $rue, $ville, $activite, $tel1, $fax, $permis, $tel2, $cin){
        $query = $this->_db->prepare('UPDATE t_client SET  
        nom=:nom, adresse=:adresse, rue=:rue, ville=:ville, activite=:activite, 
        tel1=:tel1, fax=:fax, permis=:permis, tel2=:tel2, cin=:cin
        WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->bindValue(':nom', $nom);
        $query->bindValue(':adresse', $adresse);
        $query->bindValue(':rue', $rue);
        $query->bindValue(':ville', $ville);
        $query->bindValue(':activite', $activite);
        $query->bindValue(':tel1', $tel1);
        $query->bindValue(':fax', $fax);
        $query->bindValue(':permis', $permis);
        $query->bindValue(':tel2', $tel2);
        $query->bindValue(':cin', $cin);
        $query->execute();
        $query->closeCursor();
    }

    public function setGeneratedCode($id, $code){
        $query = $this->_db->prepare('UPDATE t_client SET generatedCode=:generatedCode WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->bindValue(':generatedCode', $code);
        $query->execute();
        $query->closeCursor();
    }

	public function delete($id){
        $query = $this->_db->prepare('DELETE FROM t_client WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare('SELECT * FROM t_client WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Client($data);
	}
    
    public function getOneByCode($code){
        $query = $this->_db->prepare('SELECT * FROM t_client WHERE generatedCode=:code')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':code', $code);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new Client($data);
    }

	public function getAll(){
        $clients = array();
		$query = $this->_db->query('SELECT * FROM t_client ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$clients[] = new Client($data);
		}
		$query->closeCursor();
		return $clients;
	}

	public function getAllByLimits($begin, $end){
        $clients = array();
		$query = $this->_db->prepare('SELECT * FROM t_client ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();      
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$clients[] = new Client($data);
		}
		$query->closeCursor();
		return $clients;
	}

    public function getAllByNom($nom){
        $clients = array();
        $keyword = "%".$nom."%";
        $query = $this->_db->prepare('SELECT * FROM t_client WHERE nom LIKE (:keyword) ORDER BY id ASC LIMIT 0, 10');
        $query->bindValue(':keyword', $keyword);
        $query->execute();      
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $clients[] = new Client($data);
        }
        $query->closeCursor();
        return $clients;
    }

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS clientsNumber FROM t_client');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $client = $data['clientsNumber'];
        return $client;
    }

	public function getLastId(){
        $query = $this->_db->query('SELECT id AS last_id FROM t_client ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}
    
    public function exist($element){
        $query = $this->_db->prepare("SELECT COUNT(*) FROM t_client WHERE REPLACE(codeClient, ' ', '') LIKE REPLACE(:codeClient, ' ', '') ");
        $query->bindValue(':codeClient', $element);
        $query->execute();
        return $query->fetchColumn();
    }

}