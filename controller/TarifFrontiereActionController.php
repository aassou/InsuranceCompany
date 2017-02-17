<?php
class TarifFrontiereActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_tarifFrontiereManager;

    //constructor
    public function __construct($source){
    	$this->_tarifFrontiereManager = new TarifFrontiereManager(PDOFactory::getMysqlConnection());
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
    public function add($tarifFrontiere){
        if( !empty($_POST['codeCompagnie']) ){
			$codeCompagnie = htmlentities($tarifFrontiere['codeCompagnie']);
			$codeClasse = htmlentities($tarifFrontiere['codeClasse']);
			$codeSousClasse = htmlentities($tarifFrontiere['codeSousClasse']);
			$designation = htmlentities($tarifFrontiere['designation']);
			$periode = htmlentities($tarifFrontiere['periode']);
			$typePeriode = htmlentities($tarifFrontiere['typePeriode']);
			$primeRC = htmlentities($tarifFrontiere['primeRC']);
			$taxe = htmlentities($tarifFrontiere['taxe']);
			$primeDR = htmlentities($tarifFrontiere['primeDR']);
			$taxeDR = htmlentities($tarifFrontiere['taxeDR']);
			$timbre = htmlentities($tarifFrontiere['timbre']);
			$tauxMajoration = htmlentities($tarifFrontiere['tauxMajoration']);
			$taxeRemorque = htmlentities($tarifFrontiere['taxeRemorque']);
			$tauxCommission = htmlentities($tarifFrontiere['tauxCommission']);
			$tauxTPS = htmlentities($tarifFrontiere['tauxTPS']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $tarifFrontiere = new TarifFrontiere(array(
				'codeCompagnie' => $codeCompagnie,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'designation' => $designation,
				'periode' => $periode,
				'typePeriode' => $typePeriode,
				'primeRC' => $primeRC,
				'taxe' => $taxe,
				'primeDR' => $primeDR,
				'taxeDR' => $taxeDR,
				'timbre' => $timbre,
				'tauxMajoration' => $tauxMajoration,
				'taxeRemorque' => $taxeRemorque,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_tarifFrontiereManager->add($tarifFrontiere);
            $this->_actionMessage = "Opération Valide : TarifFrontiere Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/tarifFrontiere";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifFrontiere";
        }
    }
    

    public function update($tarifFrontiere){
        $idTarifFrontiere = htmlentities($_POST['idTarifFrontiere']);
        if(!empty($tarifFrontiere['codeCompagnie'])){
			$codeCompagnie = htmlentities($tarifFrontiere['codeCompagnie']);
			$codeClasse = htmlentities($tarifFrontiere['codeClasse']);
			$codeSousClasse = htmlentities($tarifFrontiere['codeSousClasse']);
			$designation = htmlentities($tarifFrontiere['designation']);
			$periode = htmlentities($tarifFrontiere['periode']);
			$typePeriode = htmlentities($tarifFrontiere['typePeriode']);
			$primeRC = htmlentities($tarifFrontiere['primeRC']);
			$taxe = htmlentities($tarifFrontiere['taxe']);
			$primeDR = htmlentities($tarifFrontiere['primeDR']);
			$taxeDR = htmlentities($tarifFrontiere['taxeDR']);
			$timbre = htmlentities($tarifFrontiere['timbre']);
			$tauxMajoration = htmlentities($tarifFrontiere['tauxMajoration']);
			$taxeRemorque = htmlentities($tarifFrontiere['taxeRemorque']);
			$tauxCommission = htmlentities($tarifFrontiere['tauxCommission']);
			$tauxTPS = htmlentities($tarifFrontiere['tauxTPS']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $tarifFrontiere = new TarifFrontiere(array(
				'id' => $idTarifFrontiere,
				'codeCompagnie' => $codeCompagnie,
				'codeClasse' => $codeClasse,
				'codeSousClasse' => $codeSousClasse,
				'designation' => $designation,
				'periode' => $periode,
				'typePeriode' => $typePeriode,
				'primeRC' => $primeRC,
				'taxe' => $taxe,
				'primeDR' => $primeDR,
				'taxeDR' => $taxeDR,
				'timbre' => $timbre,
				'tauxMajoration' => $tauxMajoration,
				'taxeRemorque' => $taxeRemorque,
				'tauxCommission' => $tauxCommission,
				'tauxTPS' => $tauxTPS,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_tarifFrontiereManager->update($tarifFrontiere);
            $this->_actionMessage = "Opération Valide : TarifFrontiere Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/tarifFrontiere";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeCompagnie'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifFrontiere";
        }
    }
    

    public function delete($tarifFrontiere){
        $idTarifFrontiere = htmlentities($tarifFrontiere['idTarifFrontiere']);
        $this->_tarifFrontiereManager->delete($idTarifFrontiere);
        $this->_actionMessage = "Opération Valide : TarifFrontiere supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/tarifFrontiere";
    }
    
}