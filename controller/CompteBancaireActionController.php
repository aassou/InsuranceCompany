<?php
class CompteBancaireActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_compteBancaireManager;

    //constructor
    public function __construct($source){
    	$this->_compteBancaireManager = new CompteBancaireManager(PDOFactory::getMysqlConnection());
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
    public function add($compteBancaire){
        if( !empty($compteBancaire['numero']) ){
			$numero = htmlentities($compteBancaire['numero']);
			$designation = htmlentities($compteBancaire['designation']);
			$dateCreation = htmlentities($compteBancaire['dateCreation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $compteBancaire = new CompteBancaire(array(
				'numero' => $numero,
				'designation' => $designation,
				'dateCreation' => $dateCreation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_compteBancaireManager->add($compteBancaire);
            $this->_actionMessage = "Opération Valide : CompteBancaire Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/compteBancaire";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'numero'.";
            $this->_typeMessage = "error";
            $this->_source = "view/compteBancaire";
        }
    }
    

    public function update($compteBancaire){
        if(!empty($compteBancaire['numero'])){
			$numero = htmlentities($compteBancaire['numero']);
			$designation = htmlentities($compteBancaire['designation']);
			$dateCreation = htmlentities($compteBancaire['dateCreation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $compteBancaire = new CompteBancaire(array(
				'id' => $idCompteBancaire,
				'numero' => $numero,
				'designation' => $designation,
				'dateCreation' => $dateCreation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_compteBancaireManager->update($compteBancaire);
            $this->_actionMessage = "Opération Valide : CompteBancaire Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/compteBancaire";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'numero'.";
            $this->_typeMessage = "error";
            $this->_source = "view/compteBancaire";
        }
    }
    

    public function delete($compteBancaire){
        $idCompteBancaire = htmlentities($compteBancaire['idCompteBancaire']);
        $this->_compteBancaireManager->delete($idCompteBancaire);
        $this->_actionMessage = "Opération Valide : CompteBancaire supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/compteBancaire";
    }
    

    public function getCompteBancaireById($id){
        return $this->_compteBancaireManager->getCompteBancaireById($id);
    }
    

    public function getCompteBancaires(){
        return  $this->_compteBancaireManager->getCompteBancaires();
    }
    

    public function getCompteBancairesByLimits($begin, $end){
        return $this->_compteBancaireManager->getCompteBancairesByLimits($begin, $end);
    }
    

    public function getCompteBancairesNumber(){
        return $this->_compteBancaireManager->getCompteBancairesNumber();
    }
    

    public function getLastId(){
        return $this->_compteBancaireManager->getLastId();
    }
    
}
    