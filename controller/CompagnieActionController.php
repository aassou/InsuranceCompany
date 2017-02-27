<?php
class CompagnieActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_compagnieManager;

    //constructor
    public function __construct($source){
    	$this->_compagnieManager = new CompagnieManager(PDOFactory::getMysqlConnection());
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
    public function add($compagnie){
        if( !empty($_POST['raisonSociale']) ){
			$raisonSociale = htmlentities($compagnie['raisonSociale']);
			$raisonSocialeAbrege = htmlentities($compagnie['raisonSocialeAbrege']);
			$codeIntermediaire = htmlentities($compagnie['codeIntermediaire']);
			$codeMF = htmlentities($compagnie['codeMF']);
			$correspondantAuto = htmlentities($compagnie['correspondantAuto']);
			$telCorrespondantAuto = htmlentities($compagnie['telCorrespondantAuto']);
			$correspondantSinistre = htmlentities($compagnie['correspondantSinistre']);
			$telCorrespondantSinistre = htmlentities($compagnie['telCorrespondantSinistre']);
			$correspondantRecouvrement = htmlentities($compagnie['correspondantRecouvrement']);
			$telCorrespondantRecouvrement = htmlentities($compagnie['telCorrespondantRecouvrement']);
			$adresse = htmlentities($compagnie['adresse']);
			$rue = htmlentities($compagnie['rue']);
			$fax = htmlentities($compagnie['fax']);
			$tel = htmlentities($compagnie['tel']);
			$email = htmlentities($compagnie['email']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $compagnie = new Compagnie(array(
				'raisonSociale' => $raisonSociale,
				'raisonSocialeAbrege' => $raisonSocialeAbrege,
				'codeIntermediaire' => $codeIntermediaire,
				'codeMF' => $codeMF,
				'correspondantAuto' => $correspondantAuto,
				'telCorrespondantAuto' => $telCorrespondantAuto,
				'correspondantSinistre' => $correspondantSinistre,
				'telCorrespondantSinistre' => $telCorrespondantSinistre,
				'correspondantRecouvrement' => $correspondantRecouvrement,
				'telCorrespondantRecouvrement' => $telCorrespondantRecouvrement,
				'adresse' => $adresse,
				'rue' => $rue,
				'fax' => $fax,
				'tel' => $tel,
				'email' => $email,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_compagnieManager->add($compagnie);
            $this->_actionMessage = "Opération Valide : Compagnie Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/compagnie";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'raisonSociale'.";
            $this->_typeMessage = "error";
            $this->_source = "view/compagnie";
        }
    }
    

    public function update($compagnie){
        $idCompagnie = htmlentities($_POST['idCompagnie']);
        if(!empty($compagnie['raisonSociale'])){
			$raisonSociale = htmlentities($compagnie['raisonSociale']);
			$raisonSocialeAbrege = htmlentities($compagnie['raisonSocialeAbrege']);
			$codeIntermediaire = htmlentities($compagnie['codeIntermediaire']);
			$codeMF = htmlentities($compagnie['codeMF']);
			$correspondantAuto = htmlentities($compagnie['correspondantAuto']);
			$telCorrespondantAuto = htmlentities($compagnie['telCorrespondantAuto']);
			$correspondantSinistre = htmlentities($compagnie['correspondantSinistre']);
			$telCorrespondantSinistre = htmlentities($compagnie['telCorrespondantSinistre']);
			$correspondantRecouvrement = htmlentities($compagnie['correspondantRecouvrement']);
			$telCorrespondantRecouvrement = htmlentities($compagnie['telCorrespondantRecouvrement']);
			$adresse = htmlentities($compagnie['adresse']);
			$rue = htmlentities($compagnie['rue']);
			$fax = htmlentities($compagnie['fax']);
			$tel = htmlentities($compagnie['tel']);
			$email = htmlentities($compagnie['email']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $compagnie = new Compagnie(array(
				'id' => $idCompagnie,
				'raisonSociale' => $raisonSociale,
				'raisonSocialeAbrege' => $raisonSocialeAbrege,
				'codeIntermediaire' => $codeIntermediaire,
				'codeMF' => $codeMF,
				'correspondantAuto' => $correspondantAuto,
				'telCorrespondantAuto' => $telCorrespondantAuto,
				'correspondantSinistre' => $correspondantSinistre,
				'telCorrespondantSinistre' => $telCorrespondantSinistre,
				'correspondantRecouvrement' => $correspondantRecouvrement,
				'telCorrespondantRecouvrement' => $telCorrespondantRecouvrement,
				'adresse' => $adresse,
				'rue' => $rue,
				'fax' => $fax,
				'tel' => $tel,
				'email' => $email,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_compagnieManager->update($compagnie);
            $this->_actionMessage = "Opération Valide : Compagnie Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/compagnie";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'raisonSociale'.";
            $this->_typeMessage = "error";
            $this->_source = "view/compagnie";
        }
    }

    public function delete($compagnie){
        $idCompagnie = htmlentities($compagnie['idCompagnie']);
        $this->_compagnieManager->delete($idCompagnie);
        $this->_actionMessage = "Opération Valide : Compagnie supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/compagnie";
    }
    
    public function getCompagnieById($id){
        return $this->_compagnieManager->getCompagnieById($id);
    }
    
    public function getCompagnies(){
        return $this->_compagnieManager->getCompagnies();
    }
    
    public function getCompagniesByLimits($begin, $end){
        return $this->_compagnieManager->getCompagniesByLimits($begin, $end);
    }
    
    public function getLastId(){
        return $this->_compagnieManager->getLastId();
    } 
    
}