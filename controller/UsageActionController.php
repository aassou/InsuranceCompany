<?php
class UsageActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_usageManager;

    //constructor
    public function __construct($source){
    	$this->_usageManager = new UsageManager(PDOFactory::getMysqlConnection());
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
    public function add($usage){
        if( !empty($_POST['code']) ){
			$code = htmlentities($usage['code']);
			$designation = htmlentities($usage['designation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $usage = new Usage(array(
				'code' => $code,
				'designation' => $designation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_usageManager->add($usage);
            $this->_actionMessage = "Opération Valide : Usage Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/usage";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/usage";
        }
    }
    

    public function update($usage){
        $idUsage = htmlentities($_POST['idUsage']);
        if(!empty($usage['code'])){
			$code = htmlentities($usage['code']);
			$designation = htmlentities($usage['designation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $usage = new Usage(array(
				'id' => $idUsage,
				'code' => $code,
				'designation' => $designation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_usageManager->update($usage);
            $this->_actionMessage = "Opération Valide : Usage Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/usage";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/usage";
        }
    }

    public function delete($usage){
        $idUsage = htmlentities($usage['idUsage']);
        $this->_usageManager->delete($idUsage);
        $this->_actionMessage = "Opération Valide : Usage supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/usage";
    }
    
    public function getUsageById($id){
        return $this->_usageManager->getUsageById($id);
    }
    
    public function getUsages(){
        return $this->_usageManager->getUsages();    
    }    
    
    public function getUsagesByLimits($begin, $end){
        return $this->_usageManager->getUsagesByLimits($begin, $end);
    }
    
    public function getLastId(){
        return $this->_usageManager->getLastId();
    }
}