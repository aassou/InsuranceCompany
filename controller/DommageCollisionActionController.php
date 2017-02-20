<?php
class DommageCollisionActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_dommageCollisionManager;

    //constructor
    public function __construct($source){
    	$this->_dommageCollisionManager = new DommageCollisionManager(PDOFactory::getMysqlConnection());
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
    public function add($dommageCollision){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($dommageCollision['codeCompagnie']);
			$codeUsage = htmlentities($dommageCollision['codeUsage']);
			$codeClasse = htmlentities($dommageCollision['codeClasse']);
			$codeSousClasse = htmlentities($dommageCollision['codeSousClasse']);
			$carburant = htmlentities($dommageCollision['carburant']);
			$puissanceFiscale = htmlentities($dommageCollision['puissanceFiscale']);
			$formuleCollision = htmlentities($dommageCollision['formuleCollision']);
			$primeFixe = htmlentities($dommageCollision['primeFixe']);
			$franchise = htmlentities($dommageCollision['franchise']);
			$plafond = htmlentities($dommageCollision['plafond']);
			$tauxCommission = htmlentities($dommageCollision['tauxCommission']);
			$tauxTPS = htmlentities($dommageCollision['tauxTPS']);
			$tauxTaxe = htmlentities($dommageCollision['tauxTaxe']);
			$observation = htmlentities($dommageCollision['observation']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $dommageCollision = new DommageCollision(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'carburant' => $carburant,
				'puissanceFiscale' => $puissanceFiscale,
				'formuleCollision' => $formuleCollision,
				'primeFixe' => $primeFixe,
				'franchise' => $franchise,
				'plafond' => $plafond,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'observation' => $observation,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_dommageCollisionManager->add($dommageCollision);
            $this->_actionMessage = "Opération Valide : DommageCollision Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/dommageCollision";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/dommageCollision";
        }
    }
    

    public function update($dommageCollision){
        $idDommageCollision = htmlentities($_POST['idDommageCollision']);
        if(!empty($dommageCollision['codeCompagnie'])){
			$codeCompagnie = htmlentities($dommageCollision['codeCompagnie']);
			$codeUsage = htmlentities($dommageCollision['codeUsage']);
			$codeClasse = htmlentities($dommageCollision['codeClasse']);
			$codeSousClasse = htmlentities($dommageCollision['codeSousClasse']);
			$carburant = htmlentities($dommageCollision['carburant']);
			$puissanceFiscale = htmlentities($dommageCollision['puissanceFiscale']);
			$formuleCollision = htmlentities($dommageCollision['formuleCollision']);
			$primeFixe = htmlentities($dommageCollision['primeFixe']);
			$franchise = htmlentities($dommageCollision['franchise']);
			$plafond = htmlentities($dommageCollision['plafond']);
			$tauxCommission = htmlentities($dommageCollision['tauxCommission']);
			$tauxTPS = htmlentities($dommageCollision['tauxTPS']);
			$tauxTaxe = htmlentities($dommageCollision['tauxTaxe']);
			$observation = htmlentities($dommageCollision['observation']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $dommageCollision = new DommageCollision(array(
				'id' => $idDommageCollision,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'carburant' => $carburant,
				'puissanceFiscale' => $puissanceFiscale,
				'formuleCollision' => $formuleCollision,
				'primeFixe' => $primeFixe,
				'franchise' => $franchise,
				'plafond' => $plafond,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'observation' => $observation,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_dommageCollisionManager->update($dommageCollision);
            $this->_actionMessage = "Opération Valide : DommageCollision Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/dommageCollision";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/dommageCollision";
        }
    }
    

    public function delete($dommageCollision){
        $idDommageCollision = htmlentities($dommageCollision['idDommageCollision']);
        $this->_dommageCollisionManager->delete($idDommageCollision);
        $this->_actionMessage = "Opération Valide : DommageCollision supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/dommageCollision";
    }
    
}