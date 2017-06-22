<?php
class CarteVerteActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_carteVerteManager;

    //constructor
    public function __construct($source){
    	$this->_carteVerteManager = new CarteVerteManager(PDOFactory::getMysqlConnection());
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
    public function add($carteVerte){
        if( !empty($carteVerte['dateEffet']) ){
			$dateEffet = htmlentities($carteVerte['dateEffet']);
			$dateExpiration = htmlentities($carteVerte['dateExpiration']);
			$immatriculation = htmlentities($carteVerte['immatriculation']);
			$categorie = htmlentities($carteVerte['categorie']);
			$marque = htmlentities($carteVerte['marque']);
			$numeroPolice = htmlentities($carteVerte['numeroPolice']);
			$souscripteur = htmlentities($carteVerte['souscripteur']);
			$adresse = htmlentities($carteVerte['adresse']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $carteVerte = new CarteVerte(array(
				'dateEffet' => $dateEffet,
				'dateExpiration' => $dateExpiration,
				'immatriculation' => $immatriculation,
				'categorie' => $categorie,
				'marque' => $marque,
				'numeroPolice' => $numeroPolice,
				'souscripteur' => $souscripteur,
				'adresse' => $adresse,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_carteVerteManager->add($carteVerte);
            $this->_actionMessage = "Opération Valide : CarteVerte Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/carteVerte";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'dateEffet'.";
            $this->_typeMessage = "error";
            $this->_source = "view/carteVerte";
        }
    }
    

    public function update($carteVerte){
        if(!empty($carteVerte['dateEffet'])){
			$dateEffet = htmlentities($carteVerte['dateEffet']);
			$dateExpiration = htmlentities($carteVerte['dateExpiration']);
			$immatriculation = htmlentities($carteVerte['immatriculation']);
			$categorie = htmlentities($carteVerte['categorie']);
			$marque = htmlentities($carteVerte['marque']);
			$numeroPolice = htmlentities($carteVerte['numeroPolice']);
			$souscripteur = htmlentities($carteVerte['souscripteur']);
			$adresse = htmlentities($carteVerte['adresse']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $carteVerte = new CarteVerte(array(
				'id' => $idCarteVerte,
				'dateEffet' => $dateEffet,
				'dateExpiration' => $dateExpiration,
				'immatriculation' => $immatriculation,
				'categorie' => $categorie,
				'marque' => $marque,
				'numeroPolice' => $numeroPolice,
				'souscripteur' => $souscripteur,
				'adresse' => $adresse,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_carteVerteManager->update($carteVerte);
            $this->_actionMessage = "Opération Valide : CarteVerte Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/carteVerte";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'dateEffet'.";
            $this->_typeMessage = "error";
            $this->_source = "view/carteVerte";
        }
    }
    

    public function delete($carteVerte){
        $idCarteVerte = htmlentities($carteVerte['idCarteVerte']);
        $this->_carteVerteManager->delete($idCarteVerte);
        $this->_actionMessage = "Opération Valide : CarteVerte supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/carteVerte";
    }
    

    public function getCarteVerteById($id){
        return $this->_carteVerteManager->getCarteVerteById($id);
    }
    

    public function getCarteVertes(){
        return  $this->_carteVerteManager->getCarteVertes();
    }
    

    public function getCarteVertesByLimits($begin, $end){
        return $this->_carteVerteManager->getCarteVertesByLimits($begin, $end);
    }
    

    public function getCarteVertesNumber(){
        return $this->_carteVerteManager->getCarteVertesNumber();
    }
    

    public function getLastId(){
        return $this->_carteVerteManager->getLastId();
    }
    
}
    