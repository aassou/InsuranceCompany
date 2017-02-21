<?php
class ClientActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_clientManager;

    //constructor
    public function __construct($source){
    	$this->_clientManager = new ClientManager(PDOFactory::getMysqlConnection());
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
    public function add($client){
        if( !empty($_POST['codeClient']) ){
			$codeClient = htmlentities($client['codeClient']);
			$typeClient = htmlentities($client['typeClient']);
			$civilite = htmlentities($client['civilite']);
			$nom = htmlentities($client['nom']);
			$adresse = htmlentities($client['adresse']);
			$rue = htmlentities($client['rue']);
			$ville = htmlentities($client['ville']);
			$activite = htmlentities($client['activite']);
			$email = htmlentities($client['email']);
			$debit = htmlentities($client['debit']);
			$credit = htmlentities($client['credit']);
			$tel1 = htmlentities($client['tel1']);
			$fax = htmlentities($client['fax']);
			$permis = htmlentities($client['permis']);
			$datePermis = htmlentities($client['datePermis']);
			$tel2 = htmlentities($client['tel2']);
			$codeRegion = htmlentities($client['codeRegion']);
			$codeCommercial = htmlentities($client['codeCommercial']);
			$situationFamiliale = htmlentities($client['situationFamiliale']);
			$cin = htmlentities($client['cin']);
			$dateNaissance = htmlentities($client['dateNaissance']);
			$solvabilite = htmlentities($client['solvabilite']);
			$nombreIncident = htmlentities($client['nombreIncident']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $client = new Client(array(
				'codeClient' => $codeClient,
				'typeClient' => $typeClient,
				'civilite' => $civilite,
				'nom' => $nom,
				'adresse' => $adresse,
				'rue' => $rue,
				'ville' => $ville,
				'activite' => $activite,
				'email' => $email,
				'debit' => $debit,
				'credit' => $credit,
				'tel1' => $tel1,
				'fax' => $fax,
				'permis' => $permis,
				'datePermis' => $datePermis,
				'tel2' => $tel2,
				'codeRegion' => $codeRegion,
				'codeCommercial' => $codeCommercial,
				'situationFamiliale' => $situationFamiliale,
				'cin' => $cin,
				'dateNaissance' => $dateNaissance,
				'solvabilite' => $solvabilite,
				'nombreIncident' => $nombreIncident,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_clientManager->add($client);
            $this->_actionMessage = "Opération Valide : Client Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/client";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeClient'.";
            $this->_typeMessage = "error";
            $this->_source = "view/client";
        }
    }
    

    public function update($client){
        $idClient = htmlentities($_POST['idClient']);
        if(!empty($client['codeClient'])){
			$codeClient = htmlentities($client['codeClient']);
			$typeClient = htmlentities($client['typeClient']);
			$civilite = htmlentities($client['civilite']);
			$nom = htmlentities($client['nom']);
			$adresse = htmlentities($client['adresse']);
			$rue = htmlentities($client['rue']);
			$ville = htmlentities($client['ville']);
			$activite = htmlentities($client['activite']);
			$email = htmlentities($client['email']);
			$debit = htmlentities($client['debit']);
			$credit = htmlentities($client['credit']);
			$tel1 = htmlentities($client['tel1']);
			$fax = htmlentities($client['fax']);
			$permis = htmlentities($client['permis']);
			$datePermis = htmlentities($client['datePermis']);
			$tel2 = htmlentities($client['tel2']);
			$codeRegion = htmlentities($client['codeRegion']);
			$codeCommercial = htmlentities($client['codeCommercial']);
			$situationFamiliale = htmlentities($client['situationFamiliale']);
			$cin = htmlentities($client['cin']);
			$dateNaissance = htmlentities($client['dateNaissance']);
			$solvabilite = htmlentities($client['solvabilite']);
			$nombreIncident = htmlentities($client['nombreIncident']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $client = new Client(array(
				'id' => $idClient,
				'codeClient' => $codeClient,
				'typeClient' => $typeClient,
				'civilite' => $civilite,
				'nom' => $nom,
				'adresse' => $adresse,
				'rue' => $rue,
				'ville' => $ville,
				'activite' => $activite,
				'email' => $email,
				'debit' => $debit,
				'credit' => $credit,
				'tel1' => $tel1,
				'fax' => $fax,
				'permis' => $permis,
				'datePermis' => $datePermis,
				'tel2' => $tel2,
				'codeRegion' => $codeRegion,
				'codeCommercial' => $codeCommercial,
				'situationFamiliale' => $situationFamiliale,
				'cin' => $cin,
				'dateNaissance' => $dateNaissance,
				'solvabilite' => $solvabilite,
				'nombreIncident' => $nombreIncident,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_clientManager->update($client);
            $this->_actionMessage = "Opération Valide : Client Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/client";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'codeClient'.";
            $this->_typeMessage = "error";
            $this->_source = "view/client";
        }
    }
    

    public function delete($client){
        $idClient = htmlentities($client['idClient']);
        $this->_clientManager->delete($idClient);
        $this->_actionMessage = "Opération Valide : Client supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/client";
    }
    
}