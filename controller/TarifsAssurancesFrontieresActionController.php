<?php
class TarifsAssurancesFrontieresActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_tarifsAssurancesFrontieresManager;

    //constructor
    public function __construct($source){
    	$this->_tarifsAssurancesFrontieresManager = new TarifsAssurancesFrontieresManager(PDOFactory::getMysqlConnection());
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
    public function add($tarifsAssurancesFrontieres){
        if( !empty($tarifsAssurancesFrontieres['typeUsage']) ){
			$typeUsage = htmlentities($tarifsAssurancesFrontieres['typeUsage']);
			$periode = htmlentities($tarifsAssurancesFrontieres['periode']);
			$primeRC = htmlentities($tarifsAssurancesFrontieres['primeRC']);
			$taxes = htmlentities($tarifsAssurancesFrontieres['taxes']);
			$primeDR = htmlentities($tarifsAssurancesFrontieres['primeDR']);
			$taxesDR = htmlentities($tarifsAssurancesFrontieres['taxesDR']);
			$timbre = htmlentities($tarifsAssurancesFrontieres['timbre']);
			$primeTotale = htmlentities($tarifsAssurancesFrontieres['primeTotale']);
			$tauxPrimeRemorque = htmlentities($tarifsAssurancesFrontieres['tauxPrimeRemorque']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $tarifsAssurancesFrontieres = new TarifsAssurancesFrontieres(array(
				'typeUsage' => $typeUsage,
				'periode' => $periode,
				'primeRC' => $primeRC,
				'taxes' => $taxes,
				'primeDR' => $primeDR,
				'taxesDR' => $taxesDR,
				'timbre' => $timbre,
				'primeTotale' => $primeTotale,
				'tauxPrimeRemorque' => $tauxPrimeRemorque,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_tarifsAssurancesFrontieresManager->add($tarifsAssurancesFrontieres);
            $this->_actionMessage = "Opération Valide : TarifsAssurancesFrontieres Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/tarifsAssurancesFrontieres";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'typeUsage'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifsAssurancesFrontieres";
        }
    }
    

    public function update($tarifsAssurancesFrontieres){
        if(!empty($tarifsAssurancesFrontieres['typeUsage'])){
			$typeUsage = htmlentities($tarifsAssurancesFrontieres['typeUsage']);
			$periode = htmlentities($tarifsAssurancesFrontieres['periode']);
			$primeRC = htmlentities($tarifsAssurancesFrontieres['primeRC']);
			$taxes = htmlentities($tarifsAssurancesFrontieres['taxes']);
			$primeDR = htmlentities($tarifsAssurancesFrontieres['primeDR']);
			$taxesDR = htmlentities($tarifsAssurancesFrontieres['taxesDR']);
			$timbre = htmlentities($tarifsAssurancesFrontieres['timbre']);
			$primeTotale = htmlentities($tarifsAssurancesFrontieres['primeTotale']);
			$tauxPrimeRemorque = htmlentities($tarifsAssurancesFrontieres['tauxPrimeRemorque']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $tarifsAssurancesFrontieres = new TarifsAssurancesFrontieres(array(
				'id' => $idTarifsAssurancesFrontieres,
				'typeUsage' => $typeUsage,
				'periode' => $periode,
				'primeRC' => $primeRC,
				'taxes' => $taxes,
				'primeDR' => $primeDR,
				'taxesDR' => $taxesDR,
				'timbre' => $timbre,
				'primeTotale' => $primeTotale,
				'tauxPrimeRemorque' => $tauxPrimeRemorque,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_tarifsAssurancesFrontieresManager->update($tarifsAssurancesFrontieres);
            $this->_actionMessage = "Opération Valide : TarifsAssurancesFrontieres Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/tarifsAssurancesFrontieres";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'typeUsage'.";
            $this->_typeMessage = "error";
            $this->_source = "view/tarifsAssurancesFrontieres";
        }
    }
    

    public function delete($tarifsAssurancesFrontieres){
        $idTarifsAssurancesFrontieres = htmlentities($tarifsAssurancesFrontieres['idTarifsAssurancesFrontieres']);
        $this->_tarifsAssurancesFrontieresManager->delete($idTarifsAssurancesFrontieres);
        $this->_actionMessage = "Opération Valide : TarifsAssurancesFrontieres supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/tarifsAssurancesFrontieres";
    }
    

    public function getTarifsAssurancesFrontieresById($id){
        return $this->_tarifsAssurancesFrontieresManager->getTarifsAssurancesFrontieresById($id);
    }
    

    public function getTarifsAssurancesFrontieress(){
        return  $this->_tarifsAssurancesFrontieresManager->getTarifsAssurancesFrontieress();
    }
    

    public function getTarifsAssurancesFrontieressByLimits($begin, $end){
        return $this->_tarifsAssurancesFrontieresManager->getTarifsAssurancesFrontieressByLimits($begin, $end);
    }
    

    public function getTarifsAssurancesFrontieressNumber(){
        return $this->_tarifsAssurancesFrontieresManager->getTarifsAssurancesFrontieressNumber();
    }
    

    public function getLastId(){
        return $this->_tarifsAssurancesFrontieresManager->getLastId();
    }
    
}
    