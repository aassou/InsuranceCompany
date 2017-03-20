<?php
class DefenseRecoursActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_defenseRecoursManager;

    //constructor
    public function __construct($source){
    	$this->_defenseRecoursManager = new DefenseRecoursManager(PDOFactory::getMysqlConnection());
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
    public function add($defenseRecours){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($defenseRecours['codeCompagnie']);
			$codeUsage = htmlentities($defenseRecours['codeUsage']);
			$codeClasse = htmlentities($defenseRecours['codeClasse']);
			$codeSousClasse = htmlentities($defenseRecours['codeSousClasse']);
			$puissanceFiscale = htmlentities($defenseRecours['puissanceFiscale']);
			$typeDefense = htmlentities($defenseRecours['typeDefense']);
			$valeurDefense = htmlentities($defenseRecours['valeurDefense']);
			$formuleDefense = htmlentities($defenseRecours['formuleDefense']);
			$tauxCommission = htmlentities($defenseRecours['tauxCommission']);
			$tauxTPS = htmlentities($defenseRecours['tauxTPS']);
			$tauxTaxe = htmlentities($defenseRecours['tauxTaxe']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $defenseRecours = new DefenseRecours(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'puissanceFiscale' => $puissanceFiscale,
				'typeDefense' => $typeDefense,
				'valeurDefense' => $valeurDefense,
				'formuleDefense' => $formuleDefense,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_defenseRecoursManager->add($defenseRecours);
            $this->_actionMessage = "Opération Valide : DefenseRecours Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/defenseRecours";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/defenseRecours";
        }
    }
    

    public function update($defenseRecours){
        $idDefenseRecours = htmlentities($_POST['idDefenseRecours']);
        if(!empty($defenseRecours['codeCompagnie'])){
			$codeCompagnie = htmlentities($defenseRecours['codeCompagnie']);
			$codeUsage = htmlentities($defenseRecours['codeUsage']);
			$codeClasse = htmlentities($defenseRecours['codeClasse']);
			$codeSousClasse = htmlentities($defenseRecours['codeSousClasse']);
			$puissanceFiscale = htmlentities($defenseRecours['puissanceFiscale']);
			$typeDefense = htmlentities($defenseRecours['typeDefense']);
			$valeurDefense = htmlentities($defenseRecours['valeurDefense']);
			$formuleDefense = htmlentities($defenseRecours['formuleDefense']);
			$tauxCommission = htmlentities($defenseRecours['tauxCommission']);
			$tauxTPS = htmlentities($defenseRecours['tauxTPS']);
			$tauxTaxe = htmlentities($defenseRecours['tauxTaxe']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $defenseRecours = new DefenseRecours(array(
				'id' => $idDefenseRecours,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'puissanceFiscale' => $puissanceFiscale,
				'typeDefense' => $typeDefense,
				'valeurDefense' => $valeurDefense,
				'formuleDefense' => $formuleDefense,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_defenseRecoursManager->update($defenseRecours);
            $this->_actionMessage = "Opération Valide : DefenseRecours Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/defenseRecours";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/defenseRecours";
        }
    }
    

    public function delete($defenseRecours){
        $idDefenseRecours = htmlentities($defenseRecours['idDefenseRecours']);
        $this->_defenseRecoursManager->delete($idDefenseRecours);
        $this->_actionMessage = "Opération Valide : DefenseRecours supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/defenseRecours";
    }

    public function getDefenseRecoursById($id){
        return $this->_defenseRecoursManager->getDefenseRecoursById($id);
    }

    public function getDefenseRecourss(){
        return $this->_defenseRecoursManager->getDefenseRecourss();
    }

    public function getDefenseRecourssByLimits($begin, $end){
        return $this->_defenseRecoursManager->getDefenseRecourssByLimits($begin, $end);
    }

    public function getDefenseRecourssNumber(){
        return $this->_defenseRecoursManager->getDefenseRecourssNumber();
    }

    public function getLastId(){
        return $this->_defenseRecoursManager->getLastId();
    }
    
}