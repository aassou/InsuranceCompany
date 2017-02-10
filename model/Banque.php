<?php
class Banque{

	//attributes
	private $_id;
	private $_code;
	private $_raisonSociale;
	private $_nomContact;
	private $_tel1;
	private $_tel2;
	private $_fax;
	private $_email;
	private $_adresse;
	private $_rue;
	private $_created;
	private $_createdBy;
	private $_updated;
	private $_updatedBy;

	//le constructeur
    public function __construct($data){
        $this->hydrate($data);
    }
    
    //la focntion hydrate sert à attribuer les valeurs en utilisant les setters d\'une façon dynamique!
    public function hydrate($data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

	//setters
	public function setId($id){
        $this->_id = $id;
    }
	public function setCode($code){
        $this->_code = $code;
    }

	public function setRaisonSociale($raisonSociale){
        $this->_raisonSociale = $raisonSociale;
    }

	public function setNomContact($nomContact){
        $this->_nomContact = $nomContact;
    }

	public function setTel1($tel1){
        $this->_tel1 = $tel1;
    }

	public function setTel2($tel2){
        $this->_tel2 = $tel2;
    }

	public function setFax($fax){
        $this->_fax = $fax;
    }

	public function setEmail($email){
        $this->_email = $email;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
    }

	public function setRue($rue){
        $this->_rue = $rue;
    }

	public function setCreated($created){
        $this->_created = $created;
    }

	public function setCreatedBy($createdBy){
        $this->_createdBy = $createdBy;
    }

	public function setUpdated($updated){
        $this->_updated = $updated;
    }

	public function setUpdatedBy($updatedBy){
        $this->_updatedBy = $updatedBy;
    }

	//getters
	public function id(){
        return $this->_id;
    }
	public function code(){
        return $this->_code;
    }

	public function raisonSociale(){
        return $this->_raisonSociale;
    }

	public function nomContact(){
        return $this->_nomContact;
    }

	public function tel1(){
        return $this->_tel1;
    }

	public function tel2(){
        return $this->_tel2;
    }

	public function fax(){
        return $this->_fax;
    }

	public function email(){
        return $this->_email;
    }

	public function adresse(){
        return $this->_adresse;
    }

	public function rue(){
        return $this->_rue;
    }

	public function created(){
        return $this->_created;
    }

	public function createdBy(){
        return $this->_createdBy;
    }

	public function updated(){
        return $this->_updated;
    }

	public function updatedBy(){
        return $this->_updatedBy;
    }

}