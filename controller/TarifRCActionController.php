<?php
class TarifRCActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_tarifRCManager;

    //constructor
    public function __construct($source){
    	$this->_tarifRCManager = new TarifRCManager(PDOFactory::getMysqlConnection());
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
    public function add($tarifRC){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($tarifRC['codeCompagnie']);
			$codeUsage = htmlentities($tarifRC['codeUsage']);
			$codeClasse = htmlentities($tarifRC['codeClasse']);
			$codeSousClasse = htmlentities($tarifRC['codeSousClasse']);
			$carburant = htmlentities($tarifRC['carburant']);
			$puissanceFiscale = htmlentities($tarifRC['puissanceFiscale']);
            $nombrePlace = htmlentities($tarifRC['nombrePlace']);
            $tonnage = htmlentities($tarifRC['tonnage']);
			$primeRC = htmlentities($tarifRC['primeRC']);
			$majorationRemorque = htmlentities($tarifRC['majorationRemorque']);
			$matiereInflamable = htmlentities($tarifRC['matiereInflamable']);
			$transportPersonne = htmlentities($tarifRC['transportPersonne']);
			$tauxCommission = htmlentities($tarifRC['tauxCommission']);
			$tauxTPS = htmlentities($tarifRC['tauxTPS']);
			$tauxTaxe = htmlentities($tarifRC['tauxTaxe']);
			$timbre = htmlentities($tarifRC['timbre']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $tarifRC = new TarifRC(array(
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'carburant' => $carburant,
				'puissanceFiscale' => $puissanceFiscale,
				'nombrePlace' => $nombrePlace,
                'tonnage' => $tonnage,
				'primeRC' => $primeRC,
				'majorationRemorque' => $majorationRemorque,
				'matiereInflamable' => $matiereInflamable,
				'transportPersonne' => $transportPersonne,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'timbre' => $timbre,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_tarifRCManager->add($tarifRC);
            $this->_actionMessage = "Opération Valide : TarifRC Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/tarifRC";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifRC";
        }
    }
    

    public function update($tarifRC){
        $idTarifRC = htmlentities($_POST['idTarifRC']);
        if(!empty($tarifRC['codeCompagnie'])){
			$codeCompagnie = htmlentities($tarifRC['codeCompagnie']);
			$codeUsage = htmlentities($tarifRC['codeUsage']);
			$codeClasse = htmlentities($tarifRC['codeClasse']);
			$codeSousClasse = htmlentities($tarifRC['codeSousClasse']);
			$carburant = htmlentities($tarifRC['carburant']);
			$puissanceFiscale = htmlentities($tarifRC['puissanceFiscale']);
            $nombrePlace = htmlentities($tarifRC['nombrePlace']);
            $tonnage = htmlentities($tarifRC['tonnage']);
			$primeRC = htmlentities($tarifRC['primeRC']);
			$majorationRemorque = htmlentities($tarifRC['majorationRemorque']);
			$matiereInflamable = htmlentities($tarifRC['matiereInflamable']);
			$transportPersonne = htmlentities($tarifRC['transportPersonne']);
			$tauxCommission = htmlentities($tarifRC['tauxCommission']);
			$tauxTPS = htmlentities($tarifRC['tauxTPS']);
			$tauxTaxe = htmlentities($tarifRC['tauxTaxe']);
			$timbre = htmlentities($tarifRC['timbre']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $tarifRC = new TarifRC(array(
				'id' => $idTarifRC,
				'codeCompagnie' => $codeCompagnie,
				'codeUsage' => $codeUsage,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'carburant' => $carburant,
				'puissanceFiscale' => $puissanceFiscale,
				'nombrePlace' => $nombrePlace,
				'tonnage' => $tonnage,
				'primeRC' => $primeRC,
				'majorationRemorque' => $majorationRemorque,
				'matiereInflamable' => $matiereInflamable,
				'transportPersonne' => $transportPersonne,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'tauxTaxe' => $tauxTaxe,
				'timbre' => $timbre,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_tarifRCManager->update($tarifRC);
            $this->_actionMessage = "Opération Valide : TarifRC Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/tarifRC";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifRC";
        }
    }
    

    public function delete($tarifRC){
        $idTarifRC = htmlentities($tarifRC['idTarifRC']);
        $this->_tarifRCManager->delete($idTarifRC);
        $this->_actionMessage = "Opération Valide : TarifRC supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/tarifRC";
    }

    public function getTarifRCById($id){
        return $this->_tarifRCManager->getTarifRCById($id);
    }

    public function getTarifRCs(){
        return $this->_tarifRCManager->getTarifRCs();
    }

    public function getTarifRCsByLimits($begin, $end){
        return $this->_tarifRCManager->getTarifRCsByLimits($begin, $end);
    }
    
    public function getTarifRCsNumber(){
        return $this->_tarifRCManager->getTarifRCsNumber();
    }

    public function getLastId(){
        return $this->_tarifRCManager->getLastId();
    }
    
}