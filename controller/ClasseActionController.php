<?php
class ClasseActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_classeManager;

    //constructor
    public function __construct($source){
    	$this->_classeManager = new ClasseManager(PDOFactory::getMysqlConnection());
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
    public function add($classe){
        if( !empty($_POST['code']) ){
			$code = htmlentities($classe['code']);
			$designation = htmlentities($classe['designation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $classe = new Classe(array(
				'code' => $code,
				'designation' => $designation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_classeManager->add($classe);
            $this->_actionMessage = "Opération Valide : Classe Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/classe";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/classe";
        }
    }
    

    public function update($classe){
        $idClasse = htmlentities($_POST['idClasse']);
        if(!empty($classe['code'])){
			$code = htmlentities($classe['code']);
			$designation = htmlentities($classe['designation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $classe = new Classe(array(
				'id' => $idClasse,
				'code' => $code,
				'designation' => $designation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_classeManager->update($classe);
            $this->_actionMessage = "Opération Valide : Classe Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/classe";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/classe";
        }
    }
    

    public function delete($classe){
        $idClasse = htmlentities($classe['idClasse']);
        $this->_classeManager->delete($idClasse);
        $this->_actionMessage = "Opération Valide : Classe supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/classe";
    }

    public function getClasseById($id){
        return $this->_classeManager->getClasseById($id);
    }

    public function getClasses(){
        return $this->_classeManager->getClasses();
    }

    public function getClassesByLimits($begin, $end){
        return $this->_classeManager->getClassesByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_classeManager->getLastId();
    }
    
}