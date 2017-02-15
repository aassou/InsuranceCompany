<?php
class BanqueActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_banqueManager;

    //constructor
    public function __construct($source){
    	$this->_banqueManager = new BanqueManager(PDOFactory::getMysqlConnection());
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
    public function add($banque){
        if( !empty($_POST['code']) ){
			$code = htmlentities($banque['code']);
			$raisonSociale = htmlentities($banque['raisonSociale']);
			$nomContact = htmlentities($banque['nomContact']);
			$tel1 = htmlentities($banque['tel1']);
			$tel2 = htmlentities($banque['tel2']);
			$fax = htmlentities($banque['fax']);
			$email = htmlentities($banque['email']);
			$adresse = htmlentities($banque['adresse']);
			$rue = htmlentities($banque['rue']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $banque = new Banque(array(
				'code' => $code,
				'raisonSociale' => $raisonSociale,
				'nomContact' => $nomContact,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'fax' => $fax,
				'email' => $email,
				'adresse' => $adresse,
				'rue' => $rue,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_banqueManager->add($banque);
            $this->_actionMessage = "Opération Valide : Banque Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/banque";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/banque";
        }
    }
    

    public function update($banque){
        $idBanque = htmlentities($_POST['idBanque']);
        if(!empty($banque['code'])){
			$code = htmlentities($banque['code']);
			$raisonSociale = htmlentities($banque['raisonSociale']);
			$nomContact = htmlentities($banque['nomContact']);
			$tel1 = htmlentities($banque['tel1']);
			$tel2 = htmlentities($banque['tel2']);
			$fax = htmlentities($banque['fax']);
			$email = htmlentities($banque['email']);
			$adresse = htmlentities($banque['adresse']);
			$rue = htmlentities($banque['rue']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $banque = new Banque(array(
				'id' => $idBanque,
				'code' => $code,
				'raisonSociale' => $raisonSociale,
				'nomContact' => $nomContact,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'fax' => $fax,
				'email' => $email,
				'adresse' => $adresse,
				'rue' => $rue,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_banqueManager->update($banque);
            $this->_actionMessage = "Opération Valide : Banque Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/banque";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/banque";
        }
    }
    

    public function delete($banque){
        $idBanque = htmlentities($banque['idBanque']);
        $this->_banqueManager->delete($idBanque);
        $this->_actionMessage = "Opération Valide : Banque supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/banque";
    }
    
}