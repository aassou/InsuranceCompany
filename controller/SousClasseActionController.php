<?php
class SousClasseActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_sousClasseManager;

    //constructor
    public function __construct($source){
    	$this->_sousClasseManager = new SousClasseManager(PDOFactory::getMysqlConnection());
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
    public function add($sousClasse){
        if( !empty($_POST['code']) ){
			$code = htmlentities($sousClasse['code']);
			$designation = htmlentities($sousClasse['designation']);
			$codeClasse = htmlentities($sousClasse['codeClasse']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $sousClasse = new SousClasse(array(
				'code' => $code,
				'designation' => $designation,
				'codeClasse' => $codeClasse,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_sousClasseManager->add($sousClasse);
            $this->_actionMessage = "Opération Valide : SousClasse Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/sousClasse";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/sousClasse";
        }
    }
    

    public function update($sousClasse){
        $idSousClasse = htmlentities($_POST['idSousClasse']);
        if(!empty($sousClasse['code'])){
			$code = htmlentities($sousClasse['code']);
			$designation = htmlentities($sousClasse['designation']);
			$codeClasse = htmlentities($sousClasse['codeClasse']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $sousClasse = new SousClasse(array(
				'id' => $idSousClasse,
				'code' => $code,
				'designation' => $designation,
				'codeClasse' => $codeClasse,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_sousClasseManager->update($sousClasse);
            $this->_actionMessage = "Opération Valide : SousClasse Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/sousClasse";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/sousClasse";
        }
    }
    

    public function delete($sousClasse){
        $idSousClasse = htmlentities($sousClasse['idSousClasse']);
        $this->_sousClasseManager->delete($idSousClasse);
        $this->_actionMessage = "Opération Valide : SousClasse supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/sousClasse";
    }

    public function getSousClasseById($id){
        return $this->_sousClasseManager->getSousClasseById($id);
    }

    public function getSousClasses(){
        return $this->_sousClasseManager->getSousClasses();
    }

    public function getSousClassesByLimits($begin, $end){
        return $this->_sousClasseManager->getSousClassesByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_sousClasseManager->getLastId();
    }
    
}