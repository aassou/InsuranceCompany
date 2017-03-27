<?php
class AppController{
        
    //attributes
    protected $_formInputs;
    protected $_action;
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_manager;
    protected $_validation;

    //constructor
    public function __construct($source){
        $manager = ucfirst($source).'Manager';
        $this->_source = $source;
        $this->_manager = new $manager(PDOFactory::getMysqlConnection(), $this->_source);
        $this->_validation = new ValidationController($source);
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
    public function add($formInputs){
        $this->_formInputs = $formInputs;
        $this->_action = "add";    
        //objectName is a variable where we store the object (bean) name -Ex : Client, Classe, PTA...
        $objectName = ucfirst($this->_source);
        //object is the object (bean) itself - Ex : $object = new Classe(array(....)) 
        $object = new $objectName($formInputs);
        //If validation goes well, then add the object to our db
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $this->_manager->add($object);
            //$this->_actionMessage = $this->_validation->getMessage();
            //$testAppManager = new AppManager(PDOFactory::getMysqlConnection(), $this->_source);
            $this->_actionMessage = $this->_validation->getMessage();    
            $this->_typeMessage = "success";
            $this->_source = "view/$this->_source";    
        }
        //Else throw an error
        else {
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }

    public function update($formInputs){
        $this->_action = "update";
        //objectName is a variable where we store the object (bean) name -Ex : Client, Classe, PTA...
        $objectName = ucfirst($this->_source);
        //object is the object (bean) itself - Ex : $object = new Classe(array(....)) 
        $object = new $objectName($formInputs);
        //If validation goes well, then add the object to our db
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $this->_manager->update($object);
            $this->_actionMessage = $this->_manager->update($object);  
            $this->_typeMessage = "success";
            $this->_source = "view/$this->_source";    
        }
        //Else throw an error
        else {
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }

    public function delete($formInputs){
        $id = htmlentities($formInputs['id']);
        $this->_manager->delete($id);
        $this->_actionMessage = "Opération Valide : Ligne supprimée avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/$this->_source";
    }
    
    public function getOneById($id){
        return $this->_manager->getOneById($id);
    }
    
    public function getAll(){
        return $this->_manager->getAll();
    }
    
    public function getAllByLimits($begin, $end){
        return $this->_manager->getAllByLimits($begin, $end);
    }
    
    public function getAllNumber(){
        return $this->_manager->getAllNumber();
    }
    
    public function getLastId(){
        return $this->_manager->getLastId();
    }
    
    //These methods are used for users management : login, change passwords, activate/deactivate accounts...     
    public function login($formInputs){
        $this->_formInputs = $formInputs;
        $this->_action = "login";    
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $_SESSION['userAxaAmazigh'] = $this->_manager->getUserByLogin($this->_formInputs['login']);
            $this->_source = "view/dashboard";
        }
        //Else throw an error
        else {
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }
    
    public function updateProfil($formInputs){
        $this->_formInputs = $formInputs;
        $this->_action = "updateProfil";    
        //objectName is a variable where we store the object (bean) name -Ex : Client, Classe, PTA...
        $objectName = ucfirst($this->_source);
        //object is the object (bean) itself - Ex : $object = new Classe(array(....)) 
        $object = new $objectName($formInputs);
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $this->_manager->updateProfil($object);
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "success";
            $this->_source = "view/$this->_source";
        }
        else{
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }
    
    public function updateStatus($formInputs){
        $this->_formInputs = $formInputs;
        $this->_action = "updateStatus"; 
        //objectName is a variable where we store the object (bean) name -Ex : Client, Classe, PTA...
        $objectName = ucfirst($this->_source);
        //object is the object (bean) itself - Ex : $object = new Classe(array(....)) 
        $object = new $objectName($formInputs);   
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $this->_manager->updateStatus($object);
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "success";
            $this->_source = "view/$this->_source";
        }
        else{
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }
    
    public function changePassword($formInputs){
        $this->_formInputs = $formInputs;
        $this->_action = "updateStatus";    
        //objectName is a variable where we store the object (bean) name -Ex : Client, Classe, PTA...
        $objectName = ucfirst($this->_source);
        //object is the object (bean) itself - Ex : $object = new Classe(array(....)) 
        $object = new $objectName($formInputs);
        if ( $this->_validation->validate($formInputs, $this->_action) ) {
            $this->_manager->changePassword($object);
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "success";
            $this->_source = "view/$this->_source";
        }
        else{
            $this->_actionMessage = $this->_validation->getMessage();  
            $this->_typeMessage = "error";
            $this->_source = "view/$this->_source";
        }
    }
}
