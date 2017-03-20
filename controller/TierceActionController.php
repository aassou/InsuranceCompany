<?php
class TierceActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_tierceManager;

    //constructor
    public function __construct($source){
    	$this->_tierceManager = new TierceManager(PDOFactory::getMysqlConnection());
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
    public function add($tierce){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($tierce['codeCompagnie']);
			$codeUsage = htmlentities($tierce['codeUsage']);
			$codeClasse = htmlentities($tierce['codeClasse']);
			$codeSousClasse = htmlentities($tierce['codeSousClasse']);
			$formuleTierce = htmlentities($tierce['formuleTierce']);
			$primeFixe = htmlentities($tierce['primeFixe']);
			$tauxVehiculeNeuf = htmlentities($tierce['tauxVehiculeNeuf']);
			$majorationRemorque = htmlentities($tierce['majorationRemorque']);
			$tauxCommission = htmlentities($tierce['tauxCommission']);
			$tauxTPS = htmlentities($tierce['tauxTPS']);
			$tauxTaxe = htmlentities($tierce['tauxTaxe']);
			$tauxFranchise = htmlentities($tierce['tauxFranchise']);
			$montantFranchise = htmlentities($tierce['montantFranchise']);
			$observation = htmlentities($tierce['observation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $tierce = new Tierce(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleTierce' => $formuleTierce,
				'primeFixe' => $primeFixe,
				'tauxVehiculeNeuf' => $tauxVehiculeNeuf,
				'majorationRemorque' => $majorationRemorque,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'tauxFranchise' => $tauxFranchise,
				'montantFranchise' => $montantFranchise,
				'observation' => $observation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_tierceManager->add($tierce);
            $this->_actionMessage = "Opération Valide : Tierce Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/tierce";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tierce";
        }
    }
    

    public function update($tierce){
        $idTierce = htmlentities($_POST['idTierce']);
        if(!empty($tierce['codeCompagnie'])){
			$codeCompagnie = htmlentities($tierce['codeCompagnie']);
			$codeUsage = htmlentities($tierce['codeUsage']);
			$codeClasse = htmlentities($tierce['codeClasse']);
			$codeSousClasse = htmlentities($tierce['codeSousClasse']);
			$formuleTierce = htmlentities($tierce['formuleTierce']);
			$primeFixe = htmlentities($tierce['primeFixe']);
			$tauxVehiculeNeuf = htmlentities($tierce['tauxVehiculeNeuf']);
			$majorationRemorque = htmlentities($tierce['majorationRemorque']);
			$tauxCommission = htmlentities($tierce['tauxCommission']);
			$tauxTPS = htmlentities($tierce['tauxTPS']);
			$tauxTaxe = htmlentities($tierce['tauxTaxe']);
			$tauxFranchise = htmlentities($tierce['tauxFranchise']);
			$montantFranchise = htmlentities($tierce['montantFranchise']);
			$observation = htmlentities($tierce['observation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $tierce = new Tierce(array(
				'id' => $idTierce,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleTierce' => $formuleTierce,
				'primeFixe' => $primeFixe,
				'tauxVehiculeNeuf' => $tauxVehiculeNeuf,
				'majorationRemorque' => $majorationRemorque,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'tauxFranchise' => $tauxFranchise,
				'montantFranchise' => $montantFranchise,
				'observation' => $observation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_tierceManager->update($tierce);
            $this->_actionMessage = "Opération Valide : Tierce Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/tierce";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tierce";
        }
    }
    

    public function delete($tierce){
        $idTierce = htmlentities($tierce['idTierce']);
        $this->_tierceManager->delete($idTierce);
        $this->_actionMessage = "Opération Valide : Tierce supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/tierce";
    }
    
    public function getTierceById($id){
        return $this->_tierceManager->getTierceById($id);
    }

    public function getTierces(){
        return $this->_tierceManager->getTierces();
    }

    public function getTiercesByLimits($begin, $end){
        return $this->_tierceManager->getTiercesByLimits($begin, $end);
    }

    public function getTiercesNumber(){
        return $this->_tierceManager->getTiercesNumber();
    }

    public function getLastId(){
        return $this->_tierceManager->getLastId();
    }
    
}