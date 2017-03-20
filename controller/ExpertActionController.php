<?php
class ExpertActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_expertManager;

    //constructor
    public function __construct($source){
    	$this->_expertManager = new ExpertManager(PDOFactory::getMysqlConnection());
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
    public function add($expert){
        if( !empty($_POST['code']) ){
			$code = htmlentities($expert['code']);
			$nom = htmlentities($expert['nom']);
			$adresse = htmlentities($expert['adresse']);
			$ville = htmlentities($expert['ville']);
			$tel1 = htmlentities($expert['tel1']);
			$tel2 = htmlentities($expert['tel2']);
			$fax = htmlentities($expert['fax']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $expert = new Expert(array(
				'code' => $code,
				'nom' => $nom,
				'adresse' => $adresse,
				'ville' => $ville,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'fax' => $fax,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_expertManager->add($expert);
            $this->_actionMessage = "Opération Valide : Expert Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/expert";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/expert";
        }
    }
    

    public function update($expert){
        $idExpert = htmlentities($_POST['idExpert']);
        if(!empty($expert['code'])){
			$code = htmlentities($expert['code']);
			$nom = htmlentities($expert['nom']);
			$adresse = htmlentities($expert['adresse']);
			$ville = htmlentities($expert['ville']);
			$tel1 = htmlentities($expert['tel1']);
			$tel2 = htmlentities($expert['tel2']);
			$fax = htmlentities($expert['fax']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $expert = new Expert(array(
				'id' => $idExpert,
				'code' => $code,
				'nom' => $nom,
				'adresse' => $adresse,
				'ville' => $ville,
				'tel1' => $tel1,
				'tel2' => $tel2,
				'fax' => $fax,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_expertManager->update($expert);
            $this->_actionMessage = "Opération Valide : Expert Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/expert";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'code'.";
            $this->_typeMessage = "error";
            $this->_source = "view/expert";
        }
    }
    

    public function delete($expert){
        $idExpert = htmlentities($expert['idExpert']);
        $this->_expertManager->delete($idExpert);
        $this->_actionMessage = "Opération Valide : Expert supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/expert";
    }
    
    public function getExpertById($id){
        return $this->_expertManager->getExpertById($id);
    }

    public function getExperts(){
        return $this->_expertManager->getExperts();
    }

    public function getExpertsByLimits($begin, $end){
        return $this->_expertManager->getExpertsByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_expertManager->getLastId();
    }
    
}