<?php
class AttestationActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_attestationManager;

    //constructor
    public function __construct($source){
    	$this->_attestationManager = new AttestationManager(PDOFactory::getMysqlConnection());
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
    public function add($attestation){
        if( !empty($attestation['codeCompagnie']) 
        and !empty($attestation['numeroDebut']) 
        and !empty($attestation['numeroFin'])
        and ($attestation['numeroFin'] - $attestation['numeroDebut'] + 1 >= 1)
        ) {
			$codeCompagnie = htmlentities($attestation['codeCompagnie']);
			$numeroDebut = htmlentities($attestation['numeroDebut']);
			$numeroFin = htmlentities($attestation['numeroFin']);
			$codeUsage = htmlentities($attestation['codeUsage']);
			$dateReception = htmlentities($attestation['dateReception']);
			$nombreAttestation = $numeroFin - $numeroDebut +1;
			$nombreUtilise = 0;
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //test if the attestation series number doesn't exist
            $attestationsElements = $this->_attestationManager->getAttestations();
            $attestationCondition = 0;
            foreach ( $attestationsElements as $element ) {
                //If the attestation serie's number does exist already in the DB incerement condition
                if ( 
                ( $element->numeroDebut() >= $numeroDebut and $element->numeroDebut() <= $numeroFin )
                or
                ( $element->numeroFin() >= $numeroDebut and $element->numeroFin() <= $numeroFin )
                ) {
                    $attestationCondition++;        
                }
            }
            //If the attestationCondition attribute is different than 0, an error should be handeled
            if ( $attestationCondition != 0 ) {
                //error handle
                $this->_actionMessage = "Opération Invalide : Cette série de numéro d'attestations existe déjà.";
                $this->_typeMessage = "error";
                $this->_source = "view/attestation";
            }
            //Else, add the new attestation serie's number to our DB
            else {
                //create object
                $attestation = new Attestation(array(
                    'codeCompagnie' => $codeCompagnie,
                    'numeroDebut' => $numeroDebut,
                    'numeroFin' => $numeroFin,
                    'codeUsage' => $codeUsage,
                    'dateReception' => $dateReception,
                    'nombreAttestation' => $nombreAttestation,
                    'nombreUtilise' => $nombreUtilise,
                    'created' => $created,
                    'createdBy' => $createdBy
                ));
                //add it to db
                $this->_attestationManager->add($attestation);
                $this->_actionMessage = "Opération Valide : Attestation Ajouté(e) avec succès.";  
                $this->_typeMessage = "success";
                $this->_source = "view/attestation";
            }
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir les champs correctement.";
            $this->_typeMessage = "error";
            $this->_source = "view/attestation";
        }
    }
    

    public function update($attestation){
        if( !empty($attestation['codeCompagnie']) 
        and !empty($attestation['numeroDebut'])
        and !empty($attestation['numeroFin'])
        and ( $attestation['numeroFin '] >= $attestation['numeroDebut'] ) ) {
            $idAttestation = htmlentities($_POST['idAttestation']);
			$codeCompagnie = htmlentities($attestation['codeCompagnie']);
			$numeroDebut = htmlentities($attestation['numeroDebut']);
			$numeroFin = htmlentities($attestation['numeroFin']);
			$codeUsage = htmlentities($attestation['codeUsage']);
			$dateReception = htmlentities($attestation['dateReception']);
			$nombreAttestation = htmlentities($attestation['nombreAttestation']);
			$nombreUtilise = htmlentities($attestation['nombreUtilise']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $attestation = new Attestation(array(
				'id' => $idAttestation,
				'codeCompagnie' => $codeCompagnie,
				'numeroDebut' => $numeroDebut,
				'numeroFin' => $numeroFin,
				'codeUsage' => $codeUsage,
				'dateReception' => $dateReception,
				'nombreAttestation' => $nombreAttestation,
				'nombreUtilise' => $nombreUtilise,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_attestationManager->update($attestation);
            $this->_actionMessage = "Opération Valide : Attestation Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/attestation";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir les champs correctement.";
            $this->_typeMessage = "error";
            $this->_source = "view/attestation";
        }
    }
    

    public function delete($attestation){
        $idAttestation = htmlentities($attestation['idAttestation']);
        $this->_attestationManager->delete($idAttestation);
        $this->_actionMessage = "Opération Valide : Attestation supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/attestation";
    }
    

    public function getAttestationById($id){
        return $this->_attestationManager->getAttestationById($id);
    }
    

    public function getAttestations(){
        return  $this->_attestationManager->getAttestations();
    }
    

    public function getAttestationsByLimits($begin, $end){
        return $this->_attestationManager->getAttestationsByLimits($begin, $end);
    }
    

    public function getAttestationsNumber(){
        return $this->_attestationManager->getAttestationsNumber();
    }
    

    public function getLastId(){
        return $this->_attestationManager->getLastId();
    }
    
}
    