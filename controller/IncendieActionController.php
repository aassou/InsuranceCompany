<?php
class IncendieActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_incendieManager;

    //constructor
    public function __construct($source){
    	$this->_incendieManager = new IncendieManager(PDOFactory::getMysqlConnection());
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
    public function add($incendie){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($incendie['codeCompagnie']);
			$codeUsage = htmlentities($incendie['codeUsage']);
			$codeClasse = htmlentities($incendie['codeClasse']);
			$codeSousClasse = htmlentities($incendie['codeSousClasse']);
			$formuleIncendie = htmlentities($incendie['formuleIncendie']);
			$tauxMille = htmlentities($incendie['tauxMille']);
			$tauxCommission = htmlentities($incendie['tauxCommission']);
			$tauxTPS = htmlentities($incendie['tauxTPS']);
			$tauxTaxe = htmlentities($incendie['tauxTaxe']);
			$designation = htmlentities($incendie['designation']);
			$montantFranchise = htmlentities($incendie['montantFranchise']);
			$tauxFranchise = htmlentities($incendie['tauxFranchise']);
			$montant = htmlentities($incendie['montant']);
			$formule = htmlentities($incendie['formule']);
			$observation = htmlentities($incendie['observation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $incendie = new Incendie(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleIncendie' => $formuleIncendie,
				'tauxMille' => $tauxMille,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'designation' => $designation,
				'montantFranchise' => $montantFranchise,
				'tauxFranchise' => $tauxFranchise,
				'montant' => $montant,
				'formule' => $formule,
				'observation' => $observation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_incendieManager->add($incendie);
            $this->_actionMessage = "Opération Valide : Incendie Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/incendie";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/incendie";
        }
    }
    

    public function update($incendie){
        $idIncendie = htmlentities($_POST['idIncendie']);
        if(!empty($incendie['codeCompagnie'])){
			$codeCompagnie = htmlentities($incendie['codeCompagnie']);
			$codeUsage = htmlentities($incendie['codeUsage']);
			$codeClasse = htmlentities($incendie['codeClasse']);
			$codeSousClasse = htmlentities($incendie['codeSousClasse']);
			$formuleIncendie = htmlentities($incendie['formuleIncendie']);
			$tauxMille = htmlentities($incendie['tauxMille']);
			$tauxCommission = htmlentities($incendie['tauxCommission']);
			$tauxTPS = htmlentities($incendie['tauxTPS']);
			$tauxTaxe = htmlentities($incendie['tauxTaxe']);
			$designation = htmlentities($incendie['designation']);
			$montantFranchise = htmlentities($incendie['montantFranchise']);
			$tauxFranchise = htmlentities($incendie['tauxFranchise']);
			$montant = htmlentities($incendie['montant']);
			$formule = htmlentities($incendie['formule']);
			$observation = htmlentities($incendie['observation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $incendie = new Incendie(array(
				'id' => $idIncendie,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'formuleIncendie' => $formuleIncendie,
				'tauxMille' => $tauxMille,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'designation' => $designation,
				'montantFranchise' => $montantFranchise,
				'tauxFranchise' => $tauxFranchise,
				'montant' => $montant,
				'formule' => $formule,
				'observation' => $observation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_incendieManager->update($incendie);
            $this->_actionMessage = "Opération Valide : Incendie Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/incendie";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/incendie";
        }
    }
    

    public function delete($incendie){
        $idIncendie = htmlentities($incendie['idIncendie']);
        $this->_incendieManager->delete($idIncendie);
        $this->_actionMessage = "Opération Valide : Incendie supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/incendie";
    }
    
    public function getIncendieById($id){
        return $this->_incendieManager->getIncendieById($id);
    }

    public function getIncendies(){
        return $this->_incendieManager->getIncendies();
    }

    public function getIncendiesByLimits($begin, $end){
        return $this->_incendieManager->getIncendiesByLimits($begin, $end);
    }

    public function getIncendiesNumber(){
        return $this->_incendieManager->getIncendiesNumber();
    }

    public function getLastId(){
        return $this->_incendieManager->getLastId();
    }
    
}