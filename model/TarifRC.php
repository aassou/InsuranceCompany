<?php
class TarifRC{

	//attributes
	private $_id;
	private $_codeCompagnie;
	private $_codeUsage;
	private $_codeClasse;
	private $_codeSousClasse;
	private $_carburant;
	private $_puissanceFiscale;
    private $_nombrePlace;
    private $_tonnage;
	private $_primeRC;
	private $_majorationRemorque;
	private $_matiereInflamable;
	private $_transportPersonne;
	private $_tauxCommission;
	private $_tauxTPS;
	private $_tauxTaxe;
	private $_timbre;
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

	public function setCarburant($carburant){
        $this->_carburant = $carburant;
    }

	public function setPuissanceFiscale($puissanceFiscale){
        $this->_puissanceFiscale = $puissanceFiscale;
    }
    
    public function setNombrePlace($nombrePlace){
        $this->_nombrePlace = $nombrePlace;
    }
    
    public function setTonnage($tonnage){
        $this->_tonnage = $tonnage;
    }

	public function setPrimeRC($primeRC){
        $this->_primeRC = $primeRC;
    }

	public function setMajorationRemorque($majorationRemorque){
        $this->_majorationRemorque = $majorationRemorque;
    }

	public function setMatiereInflamable($matiereInflamable){
        $this->_matiereInflamable = $matiereInflamable;
    }

	public function setTransportPersonne($transportPersonne){
        $this->_transportPersonne = $transportPersonne;
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

	public function setTimbre($timbre){
        $this->_timbre = $timbre;
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

	public function carburant(){
        return $this->_carburant;
    }

	public function puissanceFiscale(){
        return $this->_puissanceFiscale;
    }
    
    public function nombrePlace(){
        return $this->_nombrePlace;
    }
    
    public function tonnage(){
        return $this->_tonnage;
    }

	public function primeRC(){
        return $this->_primeRC;
    }

	public function majorationRemorque(){
        return $this->_majorationRemorque;
    }

	public function matiereInflamable(){
        return $this->_matiereInflamable;
    }

	public function transportPersonne(){
        return $this->_transportPersonne;
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

	public function timbre(){
        return $this->_timbre;
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