<?php
class Cheque{

	//attributes
	private $_id;
	private $_dateRecu;
	private $_numero;
	private $_designationSociete;
	private $_designationPersonne;
	private $_montant;
	private $_status;
	private $_url;
	private $_compteBancaire;
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
	public function setDateRecu($dateRecu){
        $this->_dateRecu = $dateRecu;
    }

	public function setNumero($numero){
        $this->_numero = $numero;
    }

	public function setDesignationSociete($designationSociete){
        $this->_designationSociete = $designationSociete;
    }

	public function setDesignationPersonne($designationPersonne){
        $this->_designationPersonne = $designationPersonne;
    }

	public function setMontant($montant){
        $this->_montant = $montant;
    }

	public function setStatus($status){
        $this->_status = $status;
    }

	public function setUrl($url){
        $this->_url = $url;
    }

	public function setCompteBancaire($compteBancaire){
        $this->_compteBancaire = $compteBancaire;
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
	public function dateRecu(){
        return $this->_dateRecu;
    }

	public function numero(){
        return $this->_numero;
    }

	public function designationSociete(){
        return $this->_designationSociete;
    }

	public function designationPersonne(){
        return $this->_designationPersonne;
    }

	public function montant(){
        return $this->_montant;
    }

	public function status(){
        return $this->_status;
    }

	public function url(){
        return $this->_url;
    }

	public function compteBancaire(){
        return $this->_compteBancaire;
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