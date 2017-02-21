<?php
class IndividuelConducteur{

	//attributes
	private $_id;
	private $_codeCompagnie;
	private $_codeUsage;
	private $_formuleIndividuel;
	private $_capitalDeces;
	private $_capitalInvalidite;
	private $_montantFrais;
	private $_primeNette;
	private $_tauxTaxe;
	private $_accessoireIndividuel;
	private $_tauxCommission;
	private $_tauxTPS;
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

	public function setCodeUsage($codeUsage){
        $this->_codeUsage = $codeUsage;
    }

	public function setFormuleIndividuel($formuleIndividuel){
        $this->_formuleIndividuel = $formuleIndividuel;
    }

	public function setCapitalDeces($capitalDeces){
        $this->_capitalDeces = $capitalDeces;
    }

	public function setCapitalInvalidite($capitalInvalidite){
        $this->_capitalInvalidite = $capitalInvalidite;
    }

	public function setMontantFrais($montantFrais){
        $this->_montantFrais = $montantFrais;
    }

	public function setPrimeNette($primeNette){
        $this->_primeNette = $primeNette;
    }

	public function setTauxTaxe($tauxTaxe){
        $this->_tauxTaxe = $tauxTaxe;
    }

	public function setAccessoireIndividuel($accessoireIndividuel){
        $this->_accessoireIndividuel = $accessoireIndividuel;
    }

	public function setTauxCommission($tauxCommission){
        $this->_tauxCommission = $tauxCommission;
    }

	public function setTauxTPS($tauxTPS){
        $this->_tauxTPS = $tauxTPS;
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

	public function codeUsage(){
        return $this->_codeUsage;
    }

	public function formuleIndividuel(){
        return $this->_formuleIndividuel;
    }

	public function capitalDeces(){
        return $this->_capitalDeces;
    }

	public function capitalInvalidite(){
        return $this->_capitalInvalidite;
    }

	public function montantFrais(){
        return $this->_montantFrais;
    }

	public function primeNette(){
        return $this->_primeNette;
    }

	public function tauxTaxe(){
        return $this->_tauxTaxe;
    }

	public function accessoireIndividuel(){
        return $this->_accessoireIndividuel;
    }

	public function tauxCommission(){
        return $this->_tauxCommission;
    }

	public function tauxTPS(){
        return $this->_tauxTPS;
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