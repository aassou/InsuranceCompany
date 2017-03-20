<?php
class VolActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_volManager;

    //constructor
    public function __construct($source){
    	$this->_volManager = new VolManager(PDOFactory::getMysqlConnection());
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
    public function add($vol){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($vol['codeCompagnie']);
			$codeUsage = htmlentities($vol['codeUsage']);
			$codeClasse = htmlentities($vol['codeClasse']);
			$codeSousClasse = htmlentities($vol['codeSousClasse']);
			$formuleVol = htmlentities($vol['formuleVol']);
			$tauxMille = htmlentities($vol['tauxMille']);
			$tauxCommission = htmlentities($vol['tauxCommission']);
			$tauxTPS = htmlentities($vol['tauxTPS']);
			$tauxTaxe = htmlentities($vol['tauxTaxe']);
			$montantFranchise = htmlentities($vol['montantFranchise']);
			$tauxFranchise = htmlentities($vol['tauxFranchise']);
			$montant = htmlentities($vol['montant']);
			$formule = htmlentities($vol['formule']);
			$observation = htmlentities($vol['observation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $vol = new Vol(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleVol' => $formuleVol,
				'tauxMille' => $tauxMille,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'montantFranchise' => $montantFranchise,
				'tauxFranchise' => $tauxFranchise,
				'montant' => $montant,
				'formule' => $formule,
				'observation' => $observation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_volManager->add($vol);
            $this->_actionMessage = "Opération Valide : Vol Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/vol";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/vol";
        }
    }
    

    public function update($vol){
        $idVol = htmlentities($_POST['idVol']);
        if(!empty($vol['codeCompagnie'])){
			$codeCompagnie = htmlentities($vol['codeCompagnie']);
			$codeUsage = htmlentities($vol['codeUsage']);
			$codeClasse = htmlentities($vol['codeClasse']);
			$codeSousClasse = htmlentities($vol['codeSousClasse']);
			$formuleVol = htmlentities($vol['formuleVol']);
			$tauxMille = htmlentities($vol['tauxMille']);
			$tauxCommission = htmlentities($vol['tauxCommission']);
			$tauxTPS = htmlentities($vol['tauxTPS']);
			$tauxTaxe = htmlentities($vol['tauxTaxe']);
			$montantFranchise = htmlentities($vol['montantFranchise']);
			$tauxFranchise = htmlentities($vol['tauxFranchise']);
			$montant = htmlentities($vol['montant']);
			$formule = htmlentities($vol['formule']);
			$observation = htmlentities($vol['observation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $vol = new Vol(array(
				'id' => $idVol,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleVol' => $formuleVol,
				'tauxMille' => $tauxMille,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'montantFranchise' => $montantFranchise,
				'tauxFranchise' => $tauxFranchise,
				'montant' => $montant,
				'formule' => $formule,
				'observation' => $observation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_volManager->update($vol);
            $this->_actionMessage = "Opération Valide : Vol Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/vol";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/vol";
        }
    }
    

    public function delete($vol){
        $idVol = htmlentities($vol['idVol']);
        $this->_volManager->delete($idVol);
        $this->_actionMessage = "Opération Valide : Vol supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/vol";
    }

    public function getVolById($id){
        return $this->_volManager->getVolById($id);
    }

    public function getVols(){
        return $this->_volManager->getVols();
    }

    public function getVolsByLimits($begin, $end){
        return $this->_volManager->getVolsByLimits($begin, $end);
    }

    public function getVolsNumber(){
        return $this->_volManager->getVolsNumber();
    }

    public function getLastId(){
        return $this->_volManager->getLastId();
    }
    
}