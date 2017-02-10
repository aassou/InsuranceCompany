<?php
class Compagnie{

	//attributes
	private $_id;
	private $_raisonSociale;
	private $_raisonSocialeAbrege;
	private $_codeIntermediaire;
	private $_codeMF;
	private $_correspondantAuto;
	private $_telCorrespondantAuto;
	private $_correspondantSinistre;
	private $_telCorrespondantSinistre;
	private $_correspondantRecouvrement;
	private $_telCorrespondantRecouvrement;
	private $_adresse;
	private $_rue;
	private $_fax;
	private $_tel;
	private $_email;
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
	public function setRaisonSociale($raisonSociale){
        $this->_raisonSociale = $raisonSociale;
    }

	public function setRaisonSocialeAbrege($raisonSocialeAbrege){
        $this->_raisonSocialeAbrege = $raisonSocialeAbrege;
    }

	public function setCodeIntermediaire($codeIntermediaire){
        $this->_codeIntermediaire = $codeIntermediaire;
    }

	public function setCodeMF($codeMF){
        $this->_codeMF = $codeMF;
    }

	public function setCorrespondantAuto($correspondantAuto){
        $this->_correspondantAuto = $correspondantAuto;
    }

	public function setTelCorrespondantAuto($telCorrespondantAuto){
        $this->_telCorrespondantAuto = $telCorrespondantAuto;
    }

	public function setCorrespondantSinistre($correspondantSinistre){
        $this->_correspondantSinistre = $correspondantSinistre;
    }

	public function setTelCorrespondantSinistre($telCorrespondantSinistre){
        $this->_telCorrespondantSinistre = $telCorrespondantSinistre;
    }

	public function setCorrespondantRecouvrement($correspondantRecouvrement){
        $this->_correspondantRecouvrement = $correspondantRecouvrement;
    }

	public function setTelCorrespondantRecouvrement($telCorrespondantRecouvrement){
        $this->_telCorrespondantRecouvrement = $telCorrespondantRecouvrement;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
    }

	public function setRue($rue){
        $this->_rue = $rue;
    }

	public function setFax($fax){
        $this->_fax = $fax;
    }

	public function setTel($tel){
        $this->_tel = $tel;
    }

	public function setEmail($email){
        $this->_email = $email;
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
	public function raisonSociale(){
        return $this->_raisonSociale;
    }

	public function raisonSocialeAbrege(){
        return $this->_raisonSocialeAbrege;
    }

	public function codeIntermediaire(){
        return $this->_codeIntermediaire;
    }

	public function codeMF(){
        return $this->_codeMF;
    }

	public function correspondantAuto(){
        return $this->_correspondantAuto;
    }

	public function telCorrespondantAuto(){
        return $this->_telCorrespondantAuto;
    }

	public function correspondantSinistre(){
        return $this->_correspondantSinistre;
    }

	public function telCorrespondantSinistre(){
        return $this->_telCorrespondantSinistre;
    }

	public function correspondantRecouvrement(){
        return $this->_correspondantRecouvrement;
    }

	public function telCorrespondantRecouvrement(){
        return $this->_telCorrespondantRecouvrement;
    }

	public function adresse(){
        return $this->_adresse;
    }

	public function rue(){
        return $this->_rue;
    }

	public function fax(){
        return $this->_fax;
    }

	public function tel(){
        return $this->_tel;
    }

	public function email(){
        return $this->_email;
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