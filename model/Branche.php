<?php
class Branche{

	//attributes
	private $_id;
	private $_code;
	private $_designation;
	private $_tauxTaxe;
	private $_tauxCommission;
	private $_tauxTPS;
	private $_idCompagnie;
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

	public function setDesignation($designation){
        $this->_designation = $designation;
    }

	public function setTauxTaxe($tauxTaxe){
        $this->_tauxTaxe = $tauxTaxe;
    }

	public function setTauxCommission($tauxCommission){
        $this->_tauxCommission = $tauxCommission;
    }

	public function setTauxTPS($tauxTPS){
        $this->_tauxTPS = $tauxTPS;
    }

	public function setIdCompagnie($idCompagnie){
        $this->_idCompagnie = $idCompagnie;
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

	public function designation(){
        return $this->_designation;
    }

	public function tauxTaxe(){
        return $this->_tauxTaxe;
    }

	public function tauxCommission(){
        return $this->_tauxCommission;
    }

	public function tauxTPS(){
        return $this->_tauxTPS;
    }

	public function idCompagnie(){
        return $this->_idCompagnie;
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