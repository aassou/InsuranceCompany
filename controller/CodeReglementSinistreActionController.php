<?php
class CodeReglementSinistreActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_codeReglementSinistreManager;

    //constructor
    public function __construct($source){
    	$this->_codeReglementSinistreManager = new CodeReglementSinistreManager(PDOFactory::getMysqlConnection());
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
    public function add($codeReglementSinistre){
        if( !empty($_POST['code']) ){
			$code = htmlentities($codeReglementSinistre['code']);
			$libelle = htmlentities($codeReglementSinistre['libelle']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $codeReglementSinistre = new CodeReglementSinistre(array(
				'code' => $code,
				'libelle' => $libelle,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_codeReglementSinistreManager->add($codeReglementSinistre);
            $this->_actionMessage = "Opération Valide : CodeReglementSinistre Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/codeReglementSinistre";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/codeReglementSinistre";
        }
    }
    

    public function update($codeReglementSinistre){
        $idCodeReglementSinistre = htmlentities($_POST['idCodeReglementSinistre']);
        if(!empty($codeReglementSinistre['code'])){
			$code = htmlentities($codeReglementSinistre['code']);
			$libelle = htmlentities($codeReglementSinistre['libelle']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $codeReglementSinistre = new CodeReglementSinistre(array(
				'id' => $idCodeReglementSinistre,
				'code' => $code,
				'libelle' => $libelle,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_codeReglementSinistreManager->update($codeReglementSinistre);
            $this->_actionMessage = "Opération Valide : CodeReglementSinistre Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/codeReglementSinistre";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/codeReglementSinistre";
        }
    }
    

    public function delete($codeReglementSinistre){
        $idCodeReglementSinistre = htmlentities($codeReglementSinistre['idCodeReglementSinistre']);
        $this->_codeReglementSinistreManager->delete($idCodeReglementSinistre);
        $this->_actionMessage = "Opération Valide : CodeReglementSinistre supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/codeReglementSinistre";
    }
    
}