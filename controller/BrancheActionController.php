<?php
class BrancheActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_brancheManager;

    //constructor
    public function __construct($source){
    	$this->_brancheManager = new BrancheManager(PDOFactory::getMysqlConnection());
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
    public function add($branche){
        if( !empty($_POST['code']) ){
			$code = htmlentities($branche['code']);
			$designation = htmlentities($branche['designation']);
			$tauxTaxe = htmlentities($branche['tauxTaxe']);
			$tauxCommission = htmlentities($branche['tauxCommission']);
			$tauxTPS = htmlentities($branche['tauxTPS']);
			$idCompagnie = htmlentities($branche['idCompagnie']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $branche = new Branche(array(
				'code' => $code,
				'designation' => $designation,
				'tauxTaxe' => $tauxTaxe,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'idCompagnie' => $idCompagnie,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_brancheManager->add($branche);
            $this->_actionMessage = "Opération Valide : Branche Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/branche";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/branche";
        }
    }
    

    public function update($branche){
        $idBranche = htmlentities($_POST['idBranche']);
        if(!empty($branche['code'])){
			$code = htmlentities($branche['code']);
			$designation = htmlentities($branche['designation']);
			$tauxTaxe = htmlentities($branche['tauxTaxe']);
			$tauxCommission = htmlentities($branche['tauxCommission']);
			$tauxTPS = htmlentities($branche['tauxTPS']);
			$idCompagnie = htmlentities($branche['idCompagnie']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $branche = new Branche(array(
				'id' => $idBranche,
				'code' => $code,
				'designation' => $designation,
				'tauxTaxe' => $tauxTaxe,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'idCompagnie' => $idCompagnie,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_brancheManager->update($branche);
            $this->_actionMessage = "Opération Valide : Branche Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/branche";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/branche";
        }
    }
    

    public function delete($branche){
        $idBranche = htmlentities($branche['idBranche']);
        $this->_brancheManager->delete($idBranche);
        $this->_actionMessage = "Opération Valide : Branche supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/branche";
    }

    public function getBrancheById($id){
        return $this->_brancheManager->getBrancheById($id);
    }

    public function getBranches(){
        return $this->_brancheManager->getBranches();
    }

    public function getBranchesByLimits($begin, $end){
        return $this->_brancheManager->getBranchesByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_brancheManager->getLastId();
    }
    
}