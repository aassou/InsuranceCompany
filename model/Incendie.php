<?php
class Incendie{

	//attributes
	private $_id;
	private $_codeCompagnie;
	private $_codeUsage;
	private $_codeClasse;
	private $_codeSousClasse;
	private $_formuleIncendie;
	private $_tauxMille;
	private $_tauxCommission;
	private $_tauxTPS;
	private $_tauxTaxe;
	private $_designation;
	private $_montantFranchise;
	private $_tauxFranchise;
	private $_montant;
	private $_formule;
	private $_observation;
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

	public function setCodeClasse($codeClasse){
        $this->_codeClasse = $codeClasse;
    }

	public function setCodeSousClasse($codeSousClasse){
        $this->_codeSousClasse = $codeSousClasse;
    }

	public function setFormuleIncendie($formuleIncendie){
        $this->_formuleIncendie = $formuleIncendie;
    }

	public function setTauxMille($tauxMille){
        $this->_tauxMille = $tauxMille;
    }

	public function setTauxCommission($tauxCommission){
        $this->_tauxCommission = $tauxCommission;
    }

	public function setTauxTPS($tauxTPS){
        $this->_tauxTPS = $tauxTPS;
    }

	public function setTauxTaxe($tauxTaxe){
        $this->_tauxTaxe = $tauxTaxe;
    }

	public function setDesignation($designation){
        $this->_designation = $designation;
    }

	public function setMontantFranchise($montantFranchise){
        $this->_montantFranchise = $montantFranchise;
    }

	public function setTauxFranchise($tauxFranchise){
        $this->_tauxFranchise = $tauxFranchise;
    }

	public function setMontant($montant){
        $this->_montant = $montant;
    }

	public function setFormule($formule){
        $this->_formule = $formule;
    }

	public function setObservation($observation){
        $this->_observation = $observation;
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

	public function codeClasse(){
        return $this->_codeClasse;
    }

	public function codeSousClasse(){
        return $this->_codeSousClasse;
    }

	public function formuleIncendie(){
        return $this->_formuleIncendie;
    }

	public function tauxMille(){
        return $this->_tauxMille;
    }

	public function tauxCommission(){
        return $this->_tauxCommission;
    }

	public function tauxTPS(){
        return $this->_tauxTPS;
    }

	public function tauxTaxe(){
        return $this->_tauxTaxe;
    }

	public function designation(){
        return $this->_designation;
    }

	public function montantFranchise(){
        return $this->_montantFranchise;
    }

	public function tauxFranchise(){
        return $this->_tauxFranchise;
    }

	public function montant(){
        return $this->_montant;
    }

	public function formule(){
        return $this->_formule;
    }

	public function observation(){
        return $this->_observation;
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