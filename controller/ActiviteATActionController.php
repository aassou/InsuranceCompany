<?php
class ActiviteATActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_activiteATManager;

    //constructor
    public function __construct($source){
    	$this->_activiteATManager = new ActiviteATManager(PDOFactory::getMysqlConnection());
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
    public function add($activiteAT){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($activiteAT['codeCompagnie']);
			$codeClasse = htmlentities($activiteAT['codeClasse']);
			$codeActivite = htmlentities($activiteAT['codeActivite']);
			$description = htmlentities($activiteAT['description']);
			$taux = htmlentities($activiteAT['taux']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $activiteAT = new ActiviteAT(array(
				'codeCompagnie' => $codeCompagnie,
				'codeClasse' => $codeClasse,
				'codeActivite' => $codeActivite,
				'description' => $description,
				'taux' => $taux,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_activiteATManager->add($activiteAT);
            $this->_actionMessage = "Opération Valide : ActiviteAT Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/activiteAT";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/activiteAT";
        }
    }

    public function update($activiteAT){
        $idActiviteAT = htmlentities($_POST['idActiviteAT']);
        if(!empty($activiteAT['codeCompagnie'])){
			$codeCompagnie = htmlentities($activiteAT['codeCompagnie']);
			$codeClasse = htmlentities($activiteAT['codeClasse']);
			$codeActivite = htmlentities($activiteAT['codeActivite']);
			$description = htmlentities($activiteAT['description']);
			$taux = htmlentities($activiteAT['taux']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $activiteAT = new ActiviteAT(array(
				'id' => $idActiviteAT,
				'codeCompagnie' => $codeCompagnie,
				'codeClasse' => $codeClasse,
				'codeActivite' => $codeActivite,
				'description' => $description,
				'taux' => $taux,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_activiteATManager->update($activiteAT);
            $this->_actionMessage = "Opération Valide : ActiviteAT Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/activiteAT";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/activiteAT";
        }
    }

    public function delete($activiteAT){
        $idActiviteAT = htmlentities($activiteAT['idActiviteAT']);
        $this->_activiteATManager->delete($idActiviteAT);
        $this->_actionMessage = "Opération Valide : ActiviteAT supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/activiteAT";
    }

    public function getActiviteATById($id){
        return $this->_activiteATManager->getActiviteATById($id);
    }
    
    public function getActiviteATs(){
        return $this->_activiteATManager->getActiviteATs();
    }
    
    public function getActiviteATsByLimits($begin, $end){
        return $this->_activiteATManager->getActiviteATsByLimits($begin, $end);
    }
    
    public function getActiviteATsNumber(){
        return $this->_activiteATManager->getActiviteATsNumber();
    }
    
    public function getLastId(){
        return $this->_activiteATManager->getLastId();
    }
    
}