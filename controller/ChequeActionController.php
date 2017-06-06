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
        if( !empty($cheque['dateRecu']) ){
			$dateRecu = htmlentities($cheque['dateRecu']);
			$numero = htmlentities($cheque['numero']);
			$designationSociete = htmlentities($cheque['designationSociete']);
			$designationPersonne = htmlentities($cheque['designationPersonne']);
			$montant = htmlentities($cheque['montant']);
			$status = htmlentities($cheque['status']);
			$url = htmlentities($cheque['url']);
			$compteBancaire = htmlentities($cheque['compteBancaire']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $cheque = new Cheque(array(
				'dateRecu' => $dateRecu,
				'numero' => $numero,
				'designationSociete' => $designationSociete,
				'designationPersonne' => $designationPersonne,
				'montant' => $montant,
				'status' => $status,
				'url' => $url,
				'compteBancaire' => $compteBancaire,
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
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'dateRecu'.";
            $this->_typeMessage = "error";
            $this->_source = "view/cheque";
        }
    }
    

    public function update($cheque){
        if(!empty($cheque['dateRecu'])){
			$dateRecu = htmlentities($cheque['dateRecu']);
			$numero = htmlentities($cheque['numero']);
			$designationSociete = htmlentities($cheque['designationSociete']);
			$designationPersonne = htmlentities($cheque['designationPersonne']);
			$montant = htmlentities($cheque['montant']);
			$status = htmlentities($cheque['status']);
			$url = htmlentities($cheque['url']);
			$compteBancaire = htmlentities($cheque['compteBancaire']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $cheque = new Cheque(array(
				'id' => $idCheque,
				'dateRecu' => $dateRecu,
				'numero' => $numero,
				'designationSociete' => $designationSociete,
				'designationPersonne' => $designationPersonne,
				'montant' => $montant,
				'status' => $status,
				'url' => $url,
				'compteBancaire' => $compteBancaire,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_chequeManager->update($cheque);
            $this->_actionMessage = "Opération Valide : Cheque Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/cheque";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'dateRecu'.";
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
    