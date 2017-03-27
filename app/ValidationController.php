<?php
class ValidationController {
    
    //attributes
    protected $_message;
    protected $_source;
    protected $_manager;
    
    //constructor
    public function __construct($source){
        $this->_source = $source;
    }
    
    //getters
    public function getMessage(){
        return $this->_message;
    }
    
    public function getSource(){
        return $this->_source;
    }
    
    //methods
    public function validate($formInputs, $action){
        //Attestation Object Test Validation Begins
        if ( $this->_source == "attestation" ) {
            if( !empty($formInputs['codeCompagnie']) 
            and !empty($formInputs['numeroDebut']) 
            and !empty($formInputs['numeroFin'])
            and ($formInputs['numeroFin'] - $formInputs['numeroDebut'] + 1 >= 1)
            ){
                $numeroDebut = $formInputs['numeroDebut'];
                $numeroFin = $formInputs['numeroFin'];
                $nombreAttestation = $numeroFin - $numeroDebut +1;
                $nombreUtilise = 0;
                //test if the attestation series number doesn't exist
                $manager = ucfirst($this->_source).'Manager';
                $this->_manager = new $manager(PDOFactory::getMysqlConnection());
                $attestationsElements = $this->_manager->getAll();
                $attestationCondition = 0;
                foreach ( $attestationsElements as $element ) {
                    //If the attestation serie's number does exist already in the DB incerement condition
                    if ( 
                    ( $element->numeroDebut() >= $numeroDebut and $element->numeroDebut() <= $numeroFin )
                    or
                    ( $element->numeroFin() >= $numeroDebut and $element->numeroFin() <= $numeroFin )
                    ) 
                    {
                        $attestationCondition++;        
                    }
                }
                //If the attestationCondition attribute is different than 0, an error should be handeled
                if ( $attestationCondition != 0 ) {
                    $this->_message = "Opération Invalide: Cette série de numéro existe déjà";
                    return false;
                }
                //Else, add the new attestation serie's number to our DB
                else {
                    if ( $action == "add" ) {
                        $this->_message = "Opération Valide: Ligne ajoutée avec succès";    
                    }
                    else if ( $action == "update" ) {
                        $this->_message = "Opération Valide: Ligne modifiée avec succès";    
                    }
                    else if ( $action == "delete" ) {
                        $this->_message = "Opération Valide: Ligne suprimmée avec succès";    
                    }
                    return true;
                }
            }
            else {
                $this->_message = "Opération Invalide: Veuillez remplir les champs obligatoires";
                return false;
            }     
        }       
        //Attestation Object Test Validation Ends
        //User Object Test Validation Begins
        else if ( $this->_source == "user" ) {
            //Create UserManager
            $manager = ucfirst($this->_source).'Manager';
            $this->_manager = new $manager(PDOFactory::getMysqlConnection());
            //Action add Begins
            if ( $action == "add" ) {
                if( 
                    !empty($formInputs['login']) 
                    && !empty($formInputs['password']) 
                    && !empty($formInputs['rpassword']) 
                    && ( $formInputs['password'] == $formInputs['rpassword'] ) 
                ) {
                    
                    //test if the user exist
                    if ( $this->_manager->exist2($formInputs['login']) ) {
                        $this->_message = "Opération Invalide : Un utilisateur existe déjà avec ce nom.";
                        return false;    
                    }
                    else {
                        $this->_message = "Opération Valide : User Ajouté(e) avec succès.";
                        return true;    
                    }
                }
                else{
                    $this->_message = "Opération Invalide : Vous devez remplir tous les champs correctement.";
                    return false;
                }
            }
            //Action add Ends
            //Action login Begins
            else if ( $action == "login" ) {
                //Test if the user credentials are set
                //Case 1 : Something missing
                if ( empty($formInputs['login']) || empty($formInputs['password']) ) {
                    $this->_message = "Opération Invalide : Tous les champs sont obligatoires.";
                    return false;
                }
                //Case 2 : User's credentials are set
                else{
                    $login = htmlspecialchars($formInputs['login']);
                    $password = htmlspecialchars($formInputs['password']);
                    if ( $this->_manager->exist2($login) && $this->_manager->getStatus($login) != 0 ) {
                        if ( password_verify($password, $this->_manager->getPasswordByLogin($login)) ) {
                            return true;
                        }
                        else{
                            $this->_message = "Opération Invalide : Mot de passe incorrecte.";
                            return false;
                        }
                    }
                    else{
                        $this->_message = "Opération Invalide : Login invalide ou compte inactif.";
                        return false;
                    }
                }
            }
            //Action login Ends
            //Action updateProfil Begins            
            else if ( $action == "updateProfil" ) {
                if ( !empty($formInputs['id']) && !empty($formInputs['profil']) ) {
                    $this->_message = "Opération Valide : Profil User Modifié(e) avec succès.";
                    return true;
                }
                else{
                    $this->_message = "Opération Invalide : Profil inexistant.";
                    return false;
                }
            }
            //Action updateProfil Ends
            //Action updateStatus Begins
            else if ( $action == "updateStatus" ) {
                if ( !empty($formInputs['id']) ) {
                    $this->_message = "Opération Valide : Status Modifié avec succès.";
                    return true;
                }
                else{
                    $this->_message = "Opération Invalide : Utilisateur inexistant.";
                    return false;
                }
            } 
            //Action updateStatus Ends 
            //Action changePassword Begins
            else if ( $action == "changePassword" ) {
                if ( !empty($formInputs['oldPassword']) 
                and !empty($formInputs['newPassword']) 
                and !empty($formInputs['retypeNewPassword']) ) {
                    if ( password_verify($formInputs['oldPassword'], $this->_manager->getPasswordByLogin($formInputs['login'])) 
                    and ( $formInputs['newPassword'] == $formInputs['retypePassword'] ) ) {
                        $this->_message = "Opération Valide : Mot de passe modifié avec succès.";
                        return true;
                    }
                    else {
                        $this->_message = "Opération Invalide : Ancien Mot de passe est incorrecte.";
                        return false;    
                    }
                }    
            }
            //Action changePassword Ends
        }
        //User Object Test Validation Ends
        //Other Object Test Validation Begins
        else {
            $this->_message = "Opération Valide: Ligne ajoutée avec succès";
            return true;
        }
        //Other Object Test Validation Ends 
    }
}