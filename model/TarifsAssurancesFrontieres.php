<?php
class TarifsAssurancesFrontieres{

	//attributes
	private $_id;
	private $_typeUsage;
	private $_periode;
	private $_primeRC;
	private $_taxes;
	private $_primeDR;
	private $_taxesDR;
	private $_timbre;
	private $_primeTotale;
	private $_tauxPrimeRemorque;
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
	public function setTypeUsage($typeUsage){
        $this->_typeUsage = $typeUsage;
    }

	public function setPeriode($periode){
        $this->_periode = $periode;
    }

	public function setPrimeRC($primeRC){
        $this->_primeRC = $primeRC;
    }

	public function setTaxes($taxes){
        $this->_taxes = $taxes;
    }

	public function setPrimeDR($primeDR){
        $this->_primeDR = $primeDR;
    }

	public function setTaxesDR($taxesDR){
        $this->_taxesDR = $taxesDR;
    }

	public function setTimbre($timbre){
        $this->_timbre = $timbre;
    }

	public function setPrimeTotale($primeTotale){
        $this->_primeTotale = $primeTotale;
    }

	public function setTauxPrimeRemorque($tauxPrimeRemorque){
        $this->_tauxPrimeRemorque = $tauxPrimeRemorque;
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
	public function typeUsage(){
        return $this->_typeUsage;
    }

	public function periode(){
        return $this->_periode;
    }

	public function primeRC(){
        return $this->_primeRC;
    }

	public function taxes(){
        return $this->_taxes;
    }

	public function primeDR(){
        return $this->_primeDR;
    }

	public function taxesDR(){
        return $this->_taxesDR;
    }

	public function timbre(){
        return $this->_timbre;
    }

	public function primeTotale(){
        return $this->_primeTotale;
    }

	public function tauxPrimeRemorque(){
        return $this->_tauxPrimeRemorque;
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