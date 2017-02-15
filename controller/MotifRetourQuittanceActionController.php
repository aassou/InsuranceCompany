<?php
class MotifRetourQuittanceActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_motifRetourQuittanceManager;

    //constructor
    public function __construct($source){
    	$this->_motifRetourQuittanceManager = new MotifRetourQuittanceManager(PDOFactory::getMysqlConnection());
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
    public function add($motifRetourQuittance){
        if( !empty($_POST['code']) ){
			$code = htmlentities($motifRetourQuittance['code']);
			$libelle = htmlentities($motifRetourQuittance['libelle']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $motifRetourQuittance = new MotifRetourQuittance(array(
				'code' => $code,
				'libelle' => $libelle,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_motifRetourQuittanceManager->add($motifRetourQuittance);
            $this->_actionMessage = "Opération Valide : MotifRetourQuittance Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/motifRetourQuittance";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/motifRetourQuittance";
        }
    }
    

    public function update($motifRetourQuittance){
        $idMotifRetourQuittance = htmlentities($_POST['idMotifRetourQuittance']);
        if(!empty($motifRetourQuittance['code'])){
			$code = htmlentities($motifRetourQuittance['code']);
			$libelle = htmlentities($motifRetourQuittance['libelle']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $motifRetourQuittance = new MotifRetourQuittance(array(
				'id' => $idMotifRetourQuittance,
				'code' => $code,
				'libelle' => $libelle,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_motifRetourQuittanceManager->update($motifRetourQuittance);
            $this->_actionMessage = "Opération Valide : MotifRetourQuittance Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/motifRetourQuittance";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/motifRetourQuittance";
        }
    }
    

    public function delete($motifRetourQuittance){
        $idMotifRetourQuittance = htmlentities($motifRetourQuittance['idMotifRetourQuittance']);
        $this->_motifRetourQuittanceManager->delete($idMotifRetourQuittance);
        $this->_actionMessage = "Opération Valide : MotifRetourQuittance supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/motifRetourQuittance";
    }
    
}