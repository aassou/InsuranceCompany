<?php
class CarteVerte{

	//attributes
	private $_id;
	private $_dateEffet;
	private $_dateExpiration;
	private $_immatriculation;
	private $_categorie;
	private $_marque;
	private $_numeroPolice;
	private $_souscripteur;
	private $_adresse;
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
	public function setDateEffet($dateEffet){
        $this->_dateEffet = $dateEffet;
    }

	public function setDateExpiration($dateExpiration){
        $this->_dateExpiration = $dateExpiration;
    }

	public function setImmatriculation($immatriculation){
        $this->_immatriculation = $immatriculation;
    }

	public function setCategorie($categorie){
        $this->_categorie = $categorie;
    }

	public function setMarque($marque){
        $this->_marque = $marque;
    }

	public function setNumeroPolice($numeroPolice){
        $this->_numeroPolice = $numeroPolice;
    }

	public function setSouscripteur($souscripteur){
        $this->_souscripteur = $souscripteur;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
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
	public function dateEffet(){
        return $this->_dateEffet;
    }

	public function dateExpiration(){
        return $this->_dateExpiration;
    }

	public function immatriculation(){
        return $this->_immatriculation;
    }

	public function categorie(){
        return $this->_categorie;
    }

	public function marque(){
        return $this->_marque;
    }

	public function numeroPolice(){
        return $this->_numeroPolice;
    }

	public function souscripteur(){
        return $this->_souscripteur;
    }

	public function adresse(){
        return $this->_adresse;
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