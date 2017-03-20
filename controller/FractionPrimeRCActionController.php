<?php
class FractionPrimeRCActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_fractionPrimeRCManager;

    //constructor
    public function __construct($source){
    	$this->_fractionPrimeRCManager = new FractionPrimeRCManager(PDOFactory::getMysqlConnection());
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
    public function add($fractionPrimeRC){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($fractionPrimeRC['codeCompagnie']);
			$nombreMois = htmlentities($fractionPrimeRC['nombreMois']);
			$tauxMois = htmlentities($fractionPrimeRC['tauxMois']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $fractionPrimeRC = new FractionPrimeRC(array(
				'codeCompagnie' => $codeCompagnie,
				'nombreMois' => $nombreMois,
				'tauxMois' => $tauxMois,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_fractionPrimeRCManager->add($fractionPrimeRC);
            $this->_actionMessage = "Opération Valide : FractionPrimeRC Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/fractionPrimeRC";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/fractionPrimeRC";
        }
    }
    

    public function update($fractionPrimeRC){
        $idFractionPrimeRC = htmlentities($_POST['idFractionPrimeRC']);
        if(!empty($fractionPrimeRC['codeCompagnie'])){
			$codeCompagnie = htmlentities($fractionPrimeRC['codeCompagnie']);
			$nombreMois = htmlentities($fractionPrimeRC['nombreMois']);
			$tauxMois = htmlentities($fractionPrimeRC['tauxMois']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $fractionPrimeRC = new FractionPrimeRC(array(
				'id' => $idFractionPrimeRC,
				'codeCompagnie' => $codeCompagnie,
				'nombreMois' => $nombreMois,
				'tauxMois' => $tauxMois,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_fractionPrimeRCManager->update($fractionPrimeRC);
            $this->_actionMessage = "Opération Valide : FractionPrimeRC Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/fractionPrimeRC";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/fractionPrimeRC";
        }
    }
    

    public function delete($fractionPrimeRC){
        $idFractionPrimeRC = htmlentities($fractionPrimeRC['idFractionPrimeRC']);
        $this->_fractionPrimeRCManager->delete($idFractionPrimeRC);
        $this->_actionMessage = "Opération Valide : FractionPrimeRC supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/fractionPrimeRC";
    }
    
    public function getFractionPrimeRCById($id){
        return $this->_fractionPrimeRCManager->getFractionPrimeRCById($id);
    }

    public function getFractionPrimeRCs(){
        return $this->_fractionPrimeRCManager->getFractionPrimeRCs();
    }

    public function getFractionPrimeRCsByLimits($begin, $end){
        return $this->_fractionPrimeRCManager->getFractionPrimeRCsByLimits($begin, $end);
    }

    public function getFractionPrimeRCsNumber(){
        return $this->_fractionPrimeRCManager->getFractionPrimeRCsNumber();
    }

    public function getLastId(){
        return $this->_fractionPrimeRCManager->getLastId();
    }
    
}