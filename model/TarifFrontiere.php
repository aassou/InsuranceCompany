<?php
class TarifFrontiere{

	//attributes
	private $_id;
	private $_codeCompagnie;
	private $_codeClasse;
	private $_codeSousClasse;
	private $_designation;
	private $_periode;
	private $_typePeriode;
	private $_primeRC;
	private $_taxe;
	private $_primeDR;
	private $_taxeDR;
	private $_timbre;
	private $_tauxMajoration;
	private $_taxeRemorque;
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

	public function setCodeClasse($codeClasse){
        $this->_codeClasse = $codeClasse;
    }

	public function setCodeSousClasse($codeSousClasse){
        $this->_codeSousClasse = $codeSousClasse;
    }

	public function setDesignation($designation){
        $this->_designation = $designation;
    }

	public function setPeriode($periode){
        $this->_periode = $periode;
    }

	public function setTypePeriode($typePeriode){
        $this->_typePeriode = $typePeriode;
    }

	public function setPrimeRC($primeRC){
        $this->_primeRC = $primeRC;
    }

	public function setTaxe($taxe){
        $this->_taxe = $taxe;
    }

	public function setPrimeDR($primeDR){
        $this->_primeDR = $primeDR;
    }

	public function setTaxeDR($taxeDR){
        $this->_taxeDR = $taxeDR;
    }

	public function setTimbre($timbre){
        $this->_timbre = $timbre;
    }

	public function setTauxMajoration($tauxMajoration){
        $this->_tauxMajoration = $tauxMajoration;
    }

	public function setTaxeRemorque($taxeRemorque){
        $this->_taxeRemorque = $taxeRemorque;
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

	public function codeClasse(){
        return $this->_codeClasse;
    }

	public function codeSousClasse(){
        return $this->_codeSousClasse;
    }

	public function designation(){
        return $this->_designation;
    }

	public function periode(){
        return $this->_periode;
    }

	public function typePeriode(){
        return $this->_typePeriode;
    }

	public function primeRC(){
        return $this->_primeRC;
    }

	public function taxe(){
        return $this->_taxe;
    }

	public function primeDR(){
        return $this->_primeDR;
    }

	public function taxeDR(){
        return $this->_taxeDR;
    }

	public function timbre(){
        return $this->_timbre;
    }

	public function tauxMajoration(){
        return $this->_tauxMajoration;
    }

	public function taxeRemorque(){
        return $this->_taxeRemorque;
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