<?php
class IndividuelConducteurActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_individuelConducteurManager;

    //constructor
    public function __construct($source){
    	$this->_individuelConducteurManager = new IndividuelConducteurManager(PDOFactory::getMysqlConnection());
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
    public function add($individuelConducteur){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($individuelConducteur['codeCompagnie']);
			$codeUsage = htmlentities($individuelConducteur['codeUsage']);
			$formuleIndividuel = htmlentities($individuelConducteur['formuleIndividuel']);
			$capitalDeces = htmlentities($individuelConducteur['capitalDeces']);
			$capitalInvalidite = htmlentities($individuelConducteur['capitalInvalidite']);
			$montantFrais = htmlentities($individuelConducteur['montantFrais']);
			$primeNette = htmlentities($individuelConducteur['primeNette']);
			$tauxTaxe = htmlentities($individuelConducteur['tauxTaxe']);
			$accessoireIndividuel = htmlentities($individuelConducteur['accessoireIndividuel']);
			$tauxCommission = htmlentities($individuelConducteur['tauxCommission']);
			$tauxTPS = htmlentities($individuelConducteur['tauxTPS']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $individuelConducteur = new IndividuelConducteur(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'formuleIndividuel' => $formuleIndividuel,
				'capitalDeces' => $capitalDeces,
				'capitalInvalidite' => $capitalInvalidite,
				'montantFrais' => $montantFrais,
				'primeNette' => $primeNette,
				'tauxTaxe' => $tauxTaxe,
				'accessoireIndividuel' => $accessoireIndividuel,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_individuelConducteurManager->add($individuelConducteur);
            $this->_actionMessage = "Opération Valide : IndividuelConducteur Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/individuelConducteur";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/individuelConducteur";
        }
    }
    

    public function update($individuelConducteur){
        $idIndividuelConducteur = htmlentities($_POST['idIndividuelConducteur']);
        if(!empty($individuelConducteur['codeCompagnie'])){
			$codeCompagnie = htmlentities($individuelConducteur['codeCompagnie']);
			$codeUsage = htmlentities($individuelConducteur['codeUsage']);
			$formuleIndividuel = htmlentities($individuelConducteur['formuleIndividuel']);
			$capitalDeces = htmlentities($individuelConducteur['capitalDeces']);
			$capitalInvalidite = htmlentities($individuelConducteur['capitalInvalidite']);
			$montantFrais = htmlentities($individuelConducteur['montantFrais']);
			$primeNette = htmlentities($individuelConducteur['primeNette']);
			$tauxTaxe = htmlentities($individuelConducteur['tauxTaxe']);
			$accessoireIndividuel = htmlentities($individuelConducteur['accessoireIndividuel']);
			$tauxCommission = htmlentities($individuelConducteur['tauxCommission']);
			$tauxTPS = htmlentities($individuelConducteur['tauxTPS']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $individuelConducteur = new IndividuelConducteur(array(
				'id' => $idIndividuelConducteur,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'formuleIndividuel' => $formuleIndividuel,
				'capitalDeces' => $capitalDeces,
				'capitalInvalidite' => $capitalInvalidite,
				'montantFrais' => $montantFrais,
				'primeNette' => $primeNette,
				'tauxTaxe' => $tauxTaxe,
				'accessoireIndividuel' => $accessoireIndividuel,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_individuelConducteurManager->update($individuelConducteur);
            $this->_actionMessage = "Opération Valide : IndividuelConducteur Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/individuelConducteur";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/individuelConducteur";
        }
    }
    

    public function delete($individuelConducteur){
        $idIndividuelConducteur = htmlentities($individuelConducteur['idIndividuelConducteur']);
        $this->_individuelConducteurManager->delete($idIndividuelConducteur);
        $this->_actionMessage = "Opération Valide : IndividuelConducteur supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/individuelConducteur";
    }
    
    public function getIndividuelConducteurById($id){
        return $this->_individuelConducteurManager->getIndividuelConducteurById($id);
    }

    public function getIndividuelConducteurs(){
        return $this->_individuelConducteurManager->getIndividuelConducteurs();
    }

    public function getIndividuelConducteursByLimits($begin, $end){
        return $this->_individuelConducteurManager->getIndividuelConducteursByLimits($begin, $end);
    }

    public function getIndividuelConducteursNumber(){
        return $this->_individuelConducteurManager->getIndividuelConducteursNumber();
    }

    public function getLastId(){
        return $this->_individuelConducteurManager->getLastId();
    }
    
}