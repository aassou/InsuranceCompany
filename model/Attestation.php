<?php
class Attestation{

	//attributes
	private $_id;
	private $_codeCompagnie;
	private $_numeroDebut;
	private $_numeroFin;
	private $_codeUsage;
	private $_dateReception;
	private $_nombreAttestation;
	private $_nombreUtilise;
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
	public function setCodeCompagnie($codeCompagnie){
        $this->_codeCompagnie = $codeCompagnie;
    }

	public function setNumeroDebut($numeroDebut){
        $this->_numeroDebut = $numeroDebut;
    }

	public function setNumeroFin($numeroFin){
        $this->_numeroFin = $numeroFin;
    }

	public function setCodeUsage($codeUsage){
        $this->_codeUsage = $codeUsage;
    }

	public function setDateReception($dateReception){
        $this->_dateReception = $dateReception;
    }

	public function setNombreAttestation($nombreAttestation){
        $this->_nombreAttestation = $nombreAttestation;
    }

	public function setNombreUtilise($nombreUtilise){
        $this->_nombreUtilise = $nombreUtilise;
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
	public function codeCompagnie(){
        return $this->_codeCompagnie;
    }

	public function numeroDebut(){
        return $this->_numeroDebut;
    }

	public function numeroFin(){
        return $this->_numeroFin;
    }

	public function codeUsage(){
        return $this->_codeUsage;
    }

	public function dateReception(){
        return $this->_dateReception;
    }

	public function nombreAttestation(){
        return $this->_nombreAttestation;
    }

	public function nombreUtilise(){
        return $this->_nombreUtilise;
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