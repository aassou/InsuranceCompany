<?php
class Expert{

	//attributes
	private $_id;
	private $_code;
	private $_nom;
	private $_adresse;
	private $_ville;
	private $_tel1;
	private $_tel2;
	private $_fax;
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

	public function setNom($nom){
        $this->_nom = $nom;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
    }

	public function setVille($ville){
        $this->_ville = $ville;
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

	public function nom(){
        return $this->_nom;
    }

	public function adresse(){
        return $this->_adresse;
    }

	public function ville(){
        return $this->_ville;
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