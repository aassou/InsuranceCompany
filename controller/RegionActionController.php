<?php
class RegionActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_regionManager;

    //constructor
    public function __construct($source){
    	$this->_regionManager = new RegionManager(PDOFactory::getMysqlConnection());
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
    public function add($region){
        if( !empty($_POST['code']) ){
			$code = htmlentities($region['code']);
			$designation = htmlentities($region['designation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $region = new Region(array(
				'code' => $code,
				'designation' => $designation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_regionManager->add($region);
            $this->_actionMessage = "Opération Valide : Region Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/region";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/region";
        }
    }
    

    public function update($region){
        $idRegion = htmlentities($_POST['idRegion']);
        if(!empty($region['code'])){
			$code = htmlentities($region['code']);
			$designation = htmlentities($region['designation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $region = new Region(array(
				'id' => $idRegion,
				'code' => $code,
				'designation' => $designation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_regionManager->update($region);
            $this->_actionMessage = "Opération Valide : Region Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/region";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/region";
        }
    }
    

    public function delete($region){
        $idRegion = htmlentities($region['idRegion']);
        $this->_regionManager->delete($idRegion);
        $this->_actionMessage = "Opération Valide : Region supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/region";
    }

    public function getRegionById($id){
        return $this->_regionManager->getRegionById($id);
    }

    public function getRegions(){
        return $this->_regionManager->getRegions();
    }

    public function getRegionsByLimits($begin, $end){
        return $this->_regionManager->getRegionsByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_regionManager->getLastId();
    }
    
}