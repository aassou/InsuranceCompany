<?php
class AssurancesFrontiersActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_assurancesFrontiersManager;

    //constructor
    public function __construct($source){
    	$this->_assurancesFrontiersManager = new AssurancesFrontiersManager(PDOFactory::getMysqlConnection());
    	$this->_source = $source;
    }

    //getters
    public function actionMessage(){
        return $this->_actionMessage;
    }
    

    public function typeMessage(){
        return $this->_typeMessage;
    }
    

    public function source(){
        return $this->_source;
    }
    
    //actions
    public function add($assurancesFrontiers){
        if( !empty($assurancesFrontiers['police']) ){
			$police = htmlentities($assurancesFrontiers['police']);
			$attestation = htmlentities($assurancesFrontiers['attestation']);
			$idUsage = htmlentities($assurancesFrontiers['idUsage']);
			$dateEffet = htmlentities($assurancesFrontiers['dateEffet']);
			$duree = htmlentities($assurancesFrontiers['duree']);
			$dateExpiration = htmlentities($assurancesFrontiers['dateExpiration']);
			$proprietaire = htmlentities($assurancesFrontiers['proprietaire']);
			$passeport = htmlentities($assurancesFrontiers['passeport']);
			$cin = htmlentities($assurancesFrontiers['cin']);
			$adresse = htmlentities($assurancesFrontiers['adresse']);
			$permis = htmlentities($assurancesFrontiers['permis']);
			$datePermis = htmlentities($assurancesFrontiers['datePermis']);
			$categorie = htmlentities($assurancesFrontiers['categorie']);
			$immatriculation = htmlentities($assurancesFrontiers['immatriculation']);
			$moteur = htmlentities($assurancesFrontiers['moteur']);
			$chassis = htmlentities($assurancesFrontiers['chassis']);
			$marque = htmlentities($assurancesFrontiers['marque']);
			$type = htmlentities($assurancesFrontiers['type']);
			$typeCarrosserie = htmlentities($assurancesFrontiers['typeCarrosserie']);
			$poidsTotalCharge = htmlentities($assurancesFrontiers['poidsTotalCharge']);
			$nombrePlaces = htmlentities($assurancesFrontiers['nombrePlaces']);
			$remorque = htmlentities($assurancesFrontiers['remorque']);
			$immatriculationRemorque = htmlentities($assurancesFrontiers['immatriculationRemorque']);
			$cylindre = htmlentities($assurancesFrontiers['cylindre']);
			$intermediaire = htmlentities($assurancesFrontiers['intermediaire']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $assurancesFrontiers = new AssurancesFrontiers(array(
				'police' => $police,
				'attestation' => $attestation,
				'idUsage' => $idUsage,
				'dateEffet' => $dateEffet,
				'duree' => $duree,
				'dateExpiration' => $dateExpiration,
				'proprietaire' => $proprietaire,
				'passeport' => $passeport,
				'cin' => $cin,
				'adresse' => $adresse,
				'permis' => $permis,
				'datePermis' => $datePermis,
				'categorie' => $categorie,
				'immatriculation' => $immatriculation,
				'moteur' => $moteur,
				'chassis' => $chassis,
				'marque' => $marque,
				'type' => $type,
				'typeCarrosserie' => $typeCarrosserie,
				'poidsTotalCharge' => $poidsTotalCharge,
				'nombrePlaces' => $nombrePlaces,
				'remorque' => $remorque,
				'immatriculationRemorque' => $immatriculationRemorque,
				'cylindre' => $cylindre,
				'intermediaire' => $intermediaire,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_assurancesFrontiersManager->add($assurancesFrontiers);
            $this->_actionMessage = "Opération Valide : AssurancesFrontiers Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/assurancesFrontiers";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'police'.";
            $this->_typeMessage = "error";
            $this->_source = "view/assurancesFrontiers";
        }
    }
    

    public function update($assurancesFrontiers){
        if(!empty($assurancesFrontiers['police'])){
			$police = htmlentities($assurancesFrontiers['police']);
			$attestation = htmlentities($assurancesFrontiers['attestation']);
			$idUsage = htmlentities($assurancesFrontiers['idUsage']);
			$dateEffet = htmlentities($assurancesFrontiers['dateEffet']);
			$duree = htmlentities($assurancesFrontiers['duree']);
			$dateExpiration = htmlentities($assurancesFrontiers['dateExpiration']);
			$proprietaire = htmlentities($assurancesFrontiers['proprietaire']);
			$passeport = htmlentities($assurancesFrontiers['passeport']);
			$cin = htmlentities($assurancesFrontiers['cin']);
			$adresse = htmlentities($assurancesFrontiers['adresse']);
			$permis = htmlentities($assurancesFrontiers['permis']);
			$datePermis = htmlentities($assurancesFrontiers['datePermis']);
			$categorie = htmlentities($assurancesFrontiers['categorie']);
			$immatriculation = htmlentities($assurancesFrontiers['immatriculation']);
			$moteur = htmlentities($assurancesFrontiers['moteur']);
			$chassis = htmlentities($assurancesFrontiers['chassis']);
			$marque = htmlentities($assurancesFrontiers['marque']);
			$type = htmlentities($assurancesFrontiers['type']);
			$typeCarrosserie = htmlentities($assurancesFrontiers['typeCarrosserie']);
			$poidsTotalCharge = htmlentities($assurancesFrontiers['poidsTotalCharge']);
			$nombrePlaces = htmlentities($assurancesFrontiers['nombrePlaces']);
			$remorque = htmlentities($assurancesFrontiers['remorque']);
			$immatriculationRemorque = htmlentities($assurancesFrontiers['immatriculationRemorque']);
			$cylindre = htmlentities($assurancesFrontiers['cylindre']);
			$intermediaire = htmlentities($assurancesFrontiers['intermediaire']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $assurancesFrontiers = new AssurancesFrontiers(array(
				'id' => $idAssurancesFrontiers,
				'police' => $police,
				'attestation' => $attestation,
				'idUsage' => $idUsage,
				'dateEffet' => $dateEffet,
				'duree' => $duree,
				'dateExpiration' => $dateExpiration,
				'proprietaire' => $proprietaire,
				'passeport' => $passeport,
				'cin' => $cin,
				'adresse' => $adresse,
				'permis' => $permis,
				'datePermis' => $datePermis,
				'categorie' => $categorie,
				'immatriculation' => $immatriculation,
				'moteur' => $moteur,
				'chassis' => $chassis,
				'marque' => $marque,
				'type' => $type,
				'typeCarrosserie' => $typeCarrosserie,
				'poidsTotalCharge' => $poidsTotalCharge,
				'nombrePlaces' => $nombrePlaces,
				'remorque' => $remorque,
				'immatriculationRemorque' => $immatriculationRemorque,
				'cylindre' => $cylindre,
				'intermediaire' => $intermediaire,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_assurancesFrontiersManager->update($assurancesFrontiers);
            $this->_actionMessage = "Opération Valide : AssurancesFrontiers Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/assurancesFrontiers";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'police'.";
            $this->_typeMessage = "error";
            $this->_source = "view/assurancesFrontiers";
        }
    }
    

    public function delete($assurancesFrontiers){
        $idAssurancesFrontiers = htmlentities($assurancesFrontiers['idAssurancesFrontiers']);
        $this->_assurancesFrontiersManager->delete($idAssurancesFrontiers);
        $this->_actionMessage = "Opération Valide : AssurancesFrontiers supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/assurancesFrontiers";
    }
    

    public function getAssurancesFrontiersById($id){
        return $this->_assurancesFrontiersManager->getAssurancesFrontiersById($id);
    }
    

    public function getAssurancesFrontierss(){
        return  $this->_assurancesFrontiersManager->getAssurancesFrontierss();
    }
    

    public function getAssurancesFrontierssByLimits($begin, $end){
        return $this->_assurancesFrontiersManager->getAssurancesFrontierssByLimits($begin, $end);
    }
    

    public function getAssurancesFrontierssNumber(){
        return $this->_assurancesFrontiersManager->getAssurancesFrontierssNumber();
    }
    

    public function getLastId(){
        return $this->_assurancesFrontiersManager->getLastId();
    }
    
}
    