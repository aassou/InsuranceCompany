<?php
class ChequeActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_chequeManager;

    //constructor
    public function __construct($source){
    	$this->_chequeManager = new ChequeManager(PDOFactory::getMysqlConnection());
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
    public function add($cheque){
        if( !empty($cheque['date']) ){
			$date = htmlentities($cheque['date']);
			$numero = htmlentities($cheque['numero']);
			$designationSociete = htmlentities($cheque['designationSociete']);
			$designationPersonne = htmlentities($cheque['designationPersonne']);
			$montant = htmlentities($cheque['montant']);
			$compteBancaire = htmlentities($cheque['compteBancaire']);
			$status = htmlentities($cheque['status']);
			$url = htmlentities($cheque['url']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $cheque = new Cheque(array(
				'date' => $date,
				'numero' => $numero,
				'designationSociete' => $designationSociete,
				'designationPersonne' => $designationPersonne,
				'montant' => $montant,
				'compteBancaire' => $compteBancaire,
				'status' => $status,
				'url' => $url,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_chequeManager->add($cheque);
            $this->_actionMessage = "Opération Valide : Cheque Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/cheque";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'date'.";
            $this->_typeMessage = "error";
            $this->_source = "view/cheque";
        }
    }
    

    public function update($cheque){
        if(!empty($cheque['date'])){
			$date = htmlentities($cheque['date']);
			$numero = htmlentities($cheque['numero']);
			$designationSociete = htmlentities($cheque['designationSociete']);
			$designationPersonne = htmlentities($cheque['designationPersonne']);
			$montant = htmlentities($cheque['montant']);
			$compteBancaire = htmlentities($cheque['compteBancaire']);
			$status = htmlentities($cheque['status']);
			$url = htmlentities($cheque['url']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $cheque = new Cheque(array(
				'id' => $idCheque,
				'date' => $date,
				'numero' => $numero,
				'designationSociete' => $designationSociete,
				'designationPersonne' => $designationPersonne,
				'montant' => $montant,
				'compteBancaire' => $compteBancaire,
				'status' => $status,
				'url' => $url,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_chequeManager->update($cheque);
            $this->_actionMessage = "Opération Valide : Cheque Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/cheque";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'date'.";
            $this->_typeMessage = "error";
            $this->_source = "view/cheque";
        }
    }
    

    public function delete($cheque){
        $idCheque = htmlentities($cheque['idCheque']);
        $this->_chequeManager->delete($idCheque);
        $this->_actionMessage = "Opération Valide : Cheque supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/cheque";
    }
    

    public function getChequeById($id){
        return $this->_chequeManager->getChequeById($id);
    }
    

    public function getCheques(){
        return  $this->_chequeManager->getCheques();
    }
    

    public function getChequesByLimits($begin, $end){
        return $this->_chequeManager->getChequesByLimits($begin, $end);
    }
    

    public function getChequesNumber(){
        return $this->_chequeManager->getChequesNumber();
    }
    

    public function getLastId(){
        return $this->_chequeManager->getLastId();
    }
    
}
    