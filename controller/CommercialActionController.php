<?php
class CommercialActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_commercialManager;

    //constructor
    public function __construct($source){
    	$this->_commercialManager = new CommercialManager(PDOFactory::getMysqlConnection());
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
    public function add($commercial){
        if( !empty($_POST['code']) ){
			$code = htmlentities($commercial['code']);
			$raisonSocial = htmlentities($commercial['raisonSocial']);
			$nomContact = htmlentities($commercial['nomContact']);
			$Adresse = htmlentities($commercial['Adresse']);
			$Rue = htmlentities($commercial['Rue']);
			$tel1 = htmlentities($commercial['tel1']);
			$tel2 = htmlentities($commercial['tel2']);
			$email = htmlentities($commercial['email']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $commercial = new Commercial(array(
				'code' => $code,
				'raisonSocial' => $raisonSocial,
				'nomContact' => $nomContact,
				'Adresse' => $Adresse,
				'Rue' => $Rue,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'email' => $email,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_commercialManager->add($commercial);
            $this->_actionMessage = "Opération Valide : Commercial Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "commercial";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "commercial";
        }
    }
    

    public function update($commercial){
        $idCommercial = htmlentities($_POST['idCommercial']);
        if(!empty($commercial['code'])){
			$code = htmlentities($commercial['code']);
			$raisonSocial = htmlentities($commercial['raisonSocial']);
			$nomContact = htmlentities($commercial['nomContact']);
			$Adresse = htmlentities($commercial['Adresse']);
			$Rue = htmlentities($commercial['Rue']);
			$tel1 = htmlentities($commercial['tel1']);
			$tel2 = htmlentities($commercial['tel2']);
			$email = htmlentities($commercial['email']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $commercial = new Commercial(array(
				'id' => $idCommercial,
				'code' => $code,
				'raisonSocial' => $raisonSocial,
				'nomContact' => $nomContact,
				'Adresse' => $Adresse,
				'Rue' => $Rue,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'email' => $email,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_commercialManager->update($commercial);
            $this->_actionMessage = "Opération Valide : Commercial Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "commercial";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "commercial";
        }
    }
    

    public function delete($commercial){
        $idCommercial = htmlentities($commercial['idCommercial']);
        $this->_commercialManager->delete($idCommercial);
        $this->_actionMessage = "Opération Valide : Commercial supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "commercial";
    }
    
}