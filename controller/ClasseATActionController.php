<?php
class ClasseATActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_classeATManager;

    //constructor
    public function __construct($source){
    	$this->_classeATManager = new ClasseATManager(PDOFactory::getMysqlConnection());
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
    public function add($classeAT){
        if( !empty($_POST['code']) ){
			$code = htmlentities($classeAT['code']);
			$libelle = htmlentities($classeAT['libelle']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $classeAT = new ClasseAT(array(
				'code' => $code,
				'libelle' => $libelle,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_classeATManager->add($classeAT);
            $this->_actionMessage = "Opération Valide : ClasseAT Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/classeAT";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/classeAT";
        }
    }
    

    public function update($classeAT){
        $idClasseAT = htmlentities($_POST['idClasseAT']);
        if(!empty($classeAT['code'])){
			$code = htmlentities($classeAT['code']);
			$libelle = htmlentities($classeAT['libelle']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $classeAT = new ClasseAT(array(
				'id' => $idClasseAT,
				'code' => $code,
				'libelle' => $libelle,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_classeATManager->update($classeAT);
            $this->_actionMessage = "Opération Valide : ClasseAT Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/classeAT";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/classeAT";
        }
    }
    

    public function delete($classeAT){
        $idClasseAT = htmlentities($classeAT['idClasseAT']);
        $this->_classeATManager->delete($idClasseAT);
        $this->_actionMessage = "Opération Valide : ClasseAT supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/classeAT";
    }
    
    public function getClasseATById($id){
        return $this->_classeATManager->getClasseATById($id);
    }

    public function getClasseATs(){
        return $this->_classeATManager->getClasseATs();
    }

    public function getClasseATsByLimits($begin, $end){
        return $this->_classeATManager->getClasseATsByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_classeATManager->getLastId();
    }
    
}