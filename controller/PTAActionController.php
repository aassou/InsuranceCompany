<?php
class PTAActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_PTAManager;

    //constructor
    public function __construct($source){
    	$this->_PTAManager = new PTAManager(PDOFactory::getMysqlConnection());
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
    public function add($PTA){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($PTA['codeCompagnie']);
			$codeUsage = htmlentities($PTA['codeUsage']);
			$formulePTA = htmlentities($PTA['formulePTA']);
			$nombrePlace = htmlentities($PTA['nombrePlace']);
			$capitalDeces = htmlentities($PTA['capitalDeces']);
			$capitalInvalidite = htmlentities($PTA['capitalInvalidite']);
			$montantFrais = htmlentities($PTA['montantFrais']);
			$primeNette = htmlentities($PTA['primeNette']);
			$tauxTaxe = htmlentities($PTA['tauxTaxe']);
			$accessoirePTA = htmlentities($PTA['accessoirePTA']);
			$tauxCommission = htmlentities($PTA['tauxCommission']);
			$tauxTPS = htmlentities($PTA['tauxTPS']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $PTA = new PTA(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'formulePTA' => $formulePTA,
				'nombrePlace' => $nombrePlace,
				'capitalDeces' => $capitalDeces,
				'capitalInvalidite' => $capitalInvalidite,
				'montantFrais' => $montantFrais,
				'primeNette' => $primeNette,
				'tauxTaxe' => $tauxTaxe,
				'accessoirePTA' => $accessoirePTA,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_PTAManager->add($PTA);
            $this->_actionMessage = "Opération Valide : PTA Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/PTA";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/PTA";
        }
    }
    

    public function update($PTA){
        $idPTA = htmlentities($_POST['idPTA']);
        if(!empty($PTA['codeCompagnie'])){
			$codeCompagnie = htmlentities($PTA['codeCompagnie']);
			$codeUsage = htmlentities($PTA['codeUsage']);
			$formulePTA = htmlentities($PTA['formulePTA']);
			$nombrePlace = htmlentities($PTA['nombrePlace']);
			$capitalDeces = htmlentities($PTA['capitalDeces']);
			$capitalInvalidite = htmlentities($PTA['capitalInvalidite']);
			$montantFrais = htmlentities($PTA['montantFrais']);
			$primeNette = htmlentities($PTA['primeNette']);
			$tauxTaxe = htmlentities($PTA['tauxTaxe']);
			$accessoirePTA = htmlentities($PTA['accessoirePTA']);
			$tauxCommission = htmlentities($PTA['tauxCommission']);
			$tauxTPS = htmlentities($PTA['tauxTPS']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $PTA = new PTA(array(
				'id' => $idPTA,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'formulePTA' => $formulePTA,
				'nombrePlace' => $nombrePlace,
				'capitalDeces' => $capitalDeces,
				'capitalInvalidite' => $capitalInvalidite,
				'montantFrais' => $montantFrais,
				'primeNette' => $primeNette,
				'tauxTaxe' => $tauxTaxe,
				'accessoirePTA' => $accessoirePTA,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_PTAManager->update($PTA);
            $this->_actionMessage = "Opération Valide : PTA Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/PTA";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/PTA";
        }
    }
    

    public function delete($PTA){
        $idPTA = htmlentities($PTA['idPTA']);
        $this->_PTAManager->delete($idPTA);
        $this->_actionMessage = "Opération Valide : PTA supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/PTA";
    }
    
}