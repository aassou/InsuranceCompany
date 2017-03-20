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
        if( 
            !empty($_POST['login']) 
            && !empty($_POST['password']) 
            && !empty($_POST['rpassword']) 
            && ( $_POST['password'] == $_POST['rpassword'] ) 
        ) {
            //test if the user exist
            if ( $this->_userManager->exist2($_POST['login']) ) {
                $this->_actionMessage = "Opération Invalide : Un utilisateur existe déjà avec ce nom.";
                $this->_typeMessage = "error";
                $this->_source = "view/user";    
            }
            else {
                $login = htmlentities($user['login']);
                $password = htmlentities($user['password']);
                $password = password_hash($password, PASSWORD_DEFAULT);
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
                $this->_source = "view/user";    
            }
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir tous les champs correctement.";
            $this->_typeMessage = "error";
            $this->_source = "view/user";
        }
    }

    public function update($user){
        if ( !empty($user['idUser']) && !empty($user['login']) ) {
            $idUser = htmlentities($_POST['idUser']);
			$login = htmlentities($user['login']);
			$password = htmlentities($user['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);
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
            $this->_source = "view/user";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'login'.";
            $this->_typeMessage = "error";
            $this->_source = "view/user";
        }
    }
    
    public function updateProfil($user){
        if ( !empty($user['idUser']) && !empty($user['profil']) ) {
            $idUser = htmlentities($_POST['idUser']);
            $profil = htmlentities($user['profil']);
            $updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $user = new User(array(
                'id' => $idUser,
                'profil' => $profil,
                'updated' => $updated,
                'updatedBy' => $updatedBy
            ));
            $this->_userManager->updateProfil($user);
            $this->_actionMessage = "Opération Valide : Profil User Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/user";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'login'.";
            $this->_typeMessage = "error";
            $this->_source = "view/user";
        }
    }
    
    public function updateStatus($user){
        if ( !empty($user['idUser']) ) {
            $idUser = htmlentities($user['idUser']);
            $status = htmlentities($user['status']);
            $updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $user = new User(array(
                'id' => $idUser,
                'status' => $status,
                'updated' => $updated,
                'updatedBy' => $updatedBy
            ));
            $this->_userManager->updateStatus($user);
            $this->_actionMessage = "Opération Valide : Profil User Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/user";
        }
        else{
            $this->_actionMessage = "Opération Invalide : User ID inexistant.";
            $this->_typeMessage = "error";
            $this->_source = "view/user";
        }
    }
    
    public function changePassword($oldPassword, $newPassword, $retypeNewPassword, $login){
        if ( !empty($oldPassword) and !empty($newPassword) and !empty($retypeNewPassword) ) {
            if ( password_verify($oldPassword, $this->getPasswordByLogin($login)) 
            and ( $newPassword == $retypePassword ) ) {
                $this->_userManager->changePassword(password_hash($newPassword, PASSWORD_DEFAULT), $login);
            }
            else {
                $this->_actionMessage = "Opération Invalide : Ancien Mot de passe est incorrecte.";
                $this->_typeMessage = "error";
                $this->_source = "view/user";    
            }
        }
    }

    public function delete($user){
        if ( !empty($user['idUser']) ) {
            $idUser = htmlentities($user['idUser']);
            $this->_userManager->delete($idUser);
            $this->_actionMessage = "Opération Valide : User supprimé(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/user";    
        }
        else{
            $this->_actionMessage = "Opération Invalide : User ID inexistant.";
            $this->_typeMessage = "error";
            $this->_source = "view/user";
        }
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
            if ( $this->exist2($login) && $this->getStatus($login) != 0 ) {
                if ( password_verify($password, $this->getPasswordByLogin($login)) ) {
                    $_SESSION['userAxaAmazigh'] = $this->getUserByLogin($login);
                    $this->_source = "view/dashboard";   
                }
                else{
                    $this->_actionMessage = "Opération Invalide : Mot de passe incorrecte.";
                    $this->_typeMessage = "error";
                    $this->_source = "index";
                }
            }
            else{
                $this->_actionMessage = "Opération Invalide : Login invalide ou compte inactif.";
                $this->_typeMessage = "error";
                $this->_source = "index";
            }
        }
    }
    
    public function getUserById($id){
        return $this->_userManager->getUserById($id);
    }

    public function getUsers(){
        return $this->_userManager->getUsers();
    }

    public function getUsersByLimits($begin, $end){
        return $this->_userManager->getUsersByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_userManager->getLastId();
    }
    
    public function getUsersNumber(){
        return $this->_userManager->getUsersNumber();
    }
    
    public function getStatus($login){
        return $this->_userManager->getStatus($login);
    }
    
    public function getStatusById($idUser){
        return $this->_userManager->getStatusById($idUser);
    }
    
    public function getUserByLoginPassword($login, $password){
        return $this->_userManager->getUserByLoginPassword($login, $password);
    }
    
    public function getUserByLogin($login){
        return $this->_userManager->getUserByLogin($login);
    }
    
    public function getPasswordByLogin($login){
        return $this->_userManager->getPasswordByLogin($login);
    }
    
    public function exists($login, $password){
        return $this->_userManager->exists($login, $password);
    }
    
    public function exist2($login){
        return $this->_userManager->exist2($login);
    }
}
