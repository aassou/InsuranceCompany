<?php
class ValidationController {
    
    //attributes
    protected $_message;
    protected $_source;
    protected $_target;
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
    
    public function getTarget(){
        return $this->_target;
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
                    $this->_target = $this->_source.".php";
                    return 0;
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
                    $this->_target = $this->_source.".php";
                    return 1;
                }
            }
            else {
                $this->_message = "Opération Invalide: Veuillez remplir les champs obligatoires";
                $this->_target = $this->_source.".php";
                return 0;
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
                        $this->_target = $this->_source.".php";
                        return 0;    
                    }
                    else {
                        $this->_message = "Opération Valide : User Ajouté(e) avec succès.";
                        $this->_target = $this->_source.".php";
                        return 1;    
                    }
                }
                else{
                    $this->_message = "Opération Invalide : Vous devez remplir tous les champs correctement.";
                    $this->_target = $this->_source.".php";
                    return 0;
                }
            }
            //Action add Ends
            //Action login Begins
            else if ( $action == "login" ) {
                //Test if the user credentials are set
                //Case 1 : Something missing
                if ( empty($formInputs['login']) || empty($formInputs['password']) ) {
                    $this->_message = "Opération Invalide : Tous les champs sont obligatoires.";
                    $this->_target = $this->_source.".php";
                    return 0;
                }
                //Case 2 : User's credentials are set
                else{
                    $login = htmlspecialchars($formInputs['login']);
                    $password = htmlspecialchars($formInputs['password']);
                    if ( $this->_manager->exist2($login) && $this->_manager->getStatus($login) != 0 ) {
                        if ( password_verify($password, $this->_manager->getPasswordByLogin($login)) ) {
                            $this->_target = "dashboard.php";
                            return 1;
                        }
                        else{
                            $this->_message = "Opération Invalide : Mot de passe incorrecte.";
                            $this->_target = $this->_source.".php";
                            return 0;
                        }
                    }
                    else{
                        $this->_message = "Opération Invalide : Login invalide ou compte inactif.";
                        $this->_target = $this->_source.".php";
                        return 0;
                    }
                }
            }
            //Action login Ends
            //Action updateProfil Begins            
            else if ( $action == "updateProfil" ) {
                if ( !empty($formInputs['id']) && !empty($formInputs['profil']) ) {
                    $this->_message = "Opération Valide : Profil User Modifié(e) avec succès.";
                    $this->_target = $this->_source.".php";
                    return 1;
                }
                else{
                    $this->_message = "Opération Invalide : Profil inexistant.";
                    $this->_target = $this->_source.".php";
                    return 0;
                }
            }
            //Action updateProfil Ends
            //Action updateStatus Begins
            else if ( $action == "updateStatus" ) {
                if ( !empty($formInputs['id']) ) {
                    $this->_message = "Opération Valide : Status Modifié avec succès.";
                    $this->_target = $this->_source.".php";
                    return 1;
                }
                else{
                    $this->_message = "Opération Invalide : Utilisateur inexistant.";
                    $this->_target = $this->_source.".php";
                    return 0;
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
                        $this->_target = $this->_source.".php";
                        return 1;
                    }
                    else {
                        $this->_message = "Opération Invalide : Ancien Mot de passe est incorrecte.";
                        $this->_target = $this->_source.".php";
                        return 0;    
                    }
                }    
            }
            //Action changePassword Ends
        }
        //User Object Test Validation Ends
        //Client Object Test Validation Begins
        else if ( $this->_source == "client" ){
            $manager = ucfirst($this->_source).'Manager';
            $this->_manager = new $manager(PDOFactory::getMysqlConnection());
            if($action == "add") {
                $codeClient = "";
                $client = "";
                //if the client exists in the database, we load its information from db,
                //and send them to the next url : automobile-add-part-2
                if( !empty($formInputs['idClient']) ){
                    $idClient = htmlentities($formInputs['idClient']);
                    $client = $this->_manager->getOneById($idClient);
                    $generatedCode = $client->generatedCode();
                    $this->_message = "<strong>Opération Valide : </strong>Client Récuperé avec succès.";
                    $this->_target = "automobile-add-part-2.php?generatedCode=".$generatedCode;
                    return 2;
                }
                //if we don't get any customer information from the clients-add.php page, 
                //then there is one of two cases to treat
                else if ( empty($formInputs['idClient']) ) {
                    //Case 1 :  if we try to force the creation of an existing customer
                    //we get an error message indicating that we do have a customer with that name 
                    if( !empty($formInputs['codeClient'])
                        and !empty($formInputs['typeClient']) 
                        and !empty($formInputs['nom'])
                        and !empty($formInputs['cin'])
                        and !empty($formInputs['civilite'])
                        and !empty($formInputs['dateNaissance'])
                        and !empty($formInputs['adresse'])
                        and !empty($formInputs['activite'])
                        and !empty($formInputs['tel1'])
                        and !empty($formInputs['permis'])
                        and !empty($formInputs['datePermis'])
                        and filter_var($formInputs['codeClient'], FILTER_VALIDATE_INT)
                     ){
                        $codeClient = htmlentities($formInputs['codeClient']);
                        if( $this->_manager->exist($codeClient) ){
                            $this->_message = "<strong>Erreur Création Client : </strong>Un client existe déjà avec ce code : <strong>".$codeClient."</strong>.";
                            $this->_target = "automobile-add-part-1.php";
                            return 0;
                        }
                        //Case 2 :  The customer doesn't exist, so we add it to our database, 
                        //and then send its generated code to the next url   
                        else{
                            $this->_message = "<strong>Opération Valide : </strong>Client Ajouté avec succès.";
                            $this->_target = "automobile-add-part-2.php?generatedCode=".$generatedCode;
                            return 1;
                        }
                    }
                    //This is a simple form validation, the field Nom should not be empty
                    else{
                        $this->_message = "<strong>Erreur Création Client : </strong>Vous devez remplir tous les champs obligatoires : <sup>*</sup>.";
                        $this->_target = "automobile-add-part-1.php";
                        return 0;
                    }   
                }
            }
        }
        //Client Object Test Validation Ends
        //ContratAuto Object Test Validation Begins
        else if ( $this->_source == "contratAuto" ){
            $attestationActionController = new AppController('attestation');
            $contratAutoActionController = new AppController('contratAuto');
            if($action == "add") {
                if ( !empty($formInputs['codeClient']) and 
                        ($attestationActionController->exist($numberAttestation) == 0 or
                        $contratAutoActionController->exist($numberAttestation) != 0)
                ) {
                    $this->_message = "<strong>Opération Valide : </strong>Contrat Assurance Auto Ajouté avec succès.";
                    $this->_target = "automobile.php";
                    return 1;   
                }
                else{
                    $this->_message = "<strong>Erreur Création Contrat Assurance Auto : </strong>Vous devez remplir tous les champs obligatoires : <sup>*</sup> correctement.";
                    $this->_target = "automobile-add-part-2.php?generatedCode=".$formInputs['codeClient'];
                    return 0;
                }   
            }
            else if($action == "update") {
                if ( !empty($formInputs['id']) and 
                        ($attestationActionController->exist($numberAttestation) == 0 or
                        $contratAutoActionController->exist($numberAttestation) != 0)
                ) {
                    $this->_message = "<strong>Opération Valide : </strong>Contrat Assurance Auto Modifié avec succès.";
                    $this->_target = "automobile-update.php?idContrat=".$formInputs['id'];
                    return 1;   
                }
                else{
                    $this->_message = "<strong>Erreur Création Contrat Assurance Auto : </strong>Vous devez remplir tous les champs obligatoires : <sup>*</sup> correctement.";
                    $this->_target = "automobile-update.php?idContrat=".$formInputs['id'];
                    return 0;
                }   
            }
        }
        //ContratAuto Object Test Validation Ends
        //ContratAuto Object Test Validation Begins
        else if ( $this->_source == "assurancesFrontiers" ){
            if($action == "add") {
                if ( !empty($formInputs['attestation']) and !empty($formInputs['police'])
                    and !empty($formInputs['immatriculation']) and !empty($formInputs['marque'])
                    and !empty($formInputs['nomrePlaces']) and !empty($formInputs['souscripteur'])
                    and !empty($formInputs['passeport']) and !empty($formInputs['permis'])
                    and !empty($formInputs['datePermis']) and !empty($formInputs['proprietaire']) 
                    and !empty($formInputs['souscripteur']) and !empty($formInputs['passeportSouscripteur'])
                    and !empty($formInputs['adresse']) and !empty($formInputs['pays'])
                ) {
                    $this->_message = "<strong>Opération Valide : </strong>Contrat Assurance Auto Ajouté avec succès.";
                    $this->_target = "assurancesFrontiers.php";
                    return 1;   
                }
                else{
                    $this->_message = "<strong>Erreur Création Contrat Assurances Frontiers : </strong>Vous devez remplir tous les champs obligatoires : <sup>*</sup> correctement.";
                    $this->_target = "assurances-frontiers-add.php";
                    return 0;
                }   
            }
            else if($action == "update") {
                if ( !empty($formInputs['id'])
                ) {
                    $this->_message = "<strong>Opération Valide : </strong>Contrat Assurance Frontiers Modifié avec succès.";
                    $this->_target = "assurances-frontiers-update.php?id=".$formInputs['id'];
                    return 1;   
                }
                else{
                    $this->_message = "<strong>Erreur Création Contrat Assurances Frontiers : </strong>Vous devez remplir tous les champs obligatoires : <sup>*</sup> correctement.";
                    $this->_target = "assurances-frontiers-update.php?id=".$formInputs['id'];
                    return 0;
                }   
            }
        }
        //AssurancesFrontiers Object Test Validation Ends
        //Other Object Test Validation Begins
        else {
            $this->_message = "Opération Valide: Ligne ajoutée avec succès";
            $this->_target = $this->_source.".php";
            return 1;
        }
        //Other Object Test Validation Ends 
    }
}