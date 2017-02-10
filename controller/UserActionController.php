<?php
class UserActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_userManager;

    //constructor
    public function __construct($source){
    	$this->_userManager = new UserManager(PDOFactory::getMysqlConnection());
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
    public function add($user){
        if( !empty($_POST['login']) ){
			$login = htmlentities($user['login']);
			$password = htmlentities($user['password']);
			$profil = htmlentities($user['profil']);
			$status = htmlentities($user['status']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $user = new User(array(
				'login' => $login,
				'password' => $password,
				'profil' => $profil,
				'status' => $status,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_userManager->add($user);
            $this->_actionMessage = "Opération Valide : User Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/users";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'login'.";
            $this->_typeMessage = "error";
            $this->_source = "view/users";
        }
    }
    

    public function update($user){
        $idUser = htmlentities($_POST['idUser']);
        if(!empty($user['login'])){
			$login = htmlentities($user['login']);
			$password = htmlentities($user['password']);
			$profil = htmlentities($user['profil']);
			$status = htmlentities($user['status']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $user = new User(array(
				'id' => $idUser,
				'login' => $login,
				'password' => $password,
				'profil' => $profil,
				'status' => $status,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_userManager->update($user);
            $this->_actionMessage = "Opération Valide : User Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/users";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'login'.";
            $this->_typeMessage = "error";
            $this->_source = "view/users";
        }
    }
    

    public function delete($user){
        $idUser = htmlentities($user['idUser']);
        $this->_userManager->delete($idUser);
        $this->_actionMessage = "Opération Valide : User supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/users";
    }
    
    public function login($user){
        //Test if the user credentials are set
        //Case 1 : Something missing
        if ( empty($user['login']) || empty($user['password']) ) {
            $this->_actionMessage = "Opération Invalide : Tous les champs sont obligatoires.";
            $this->_typeMessage = "error";
            $this->_source = "index";
        }
        //Case 2 : User's credentials are set
        else{
            $login = htmlspecialchars($user['login']);
            $password = htmlspecialchars($user['password']);
            $this->_userManager = new UserManager(PDOFactory::getMysqlConnection());
            if ( $this->_userManager->exists($login, $password) ) {
                if ( $this->_userManager->getStatus($login) != 0 ) {
                    $_SESSION['userAxaAmazigh'] = $this->_userManager->getUserByLoginPassword($login, $password);
                    $this->_source = "view/dashboard";   
                }
                else{
                    $this->_actionMessage = "Opération Invalide : Ce compte est inactif.";
                    $this->_typeMessage = "error";
                    $this->_source = "index";
                }
            }
            else{
                $this->_actionMessage = "Opération Invalide : Login et/ou Mot de passe invalides.";
                $this->_typeMessage = "error";
                $this->_source = "index";
            }
        }
    }   
}
