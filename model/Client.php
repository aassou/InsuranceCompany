<?php
class Client{

	//attributes
	private $_id;
	private $_codeClient;
	private $_typeClient;
	private $_civilite;
	private $_nom;
	private $_adresse;
	private $_rue;
	private $_ville;
	private $_activite;
	private $_email;
	private $_debit;
	private $_credit;
	private $_tel1;
	private $_fax;
	private $_permis;
	private $_datePermis;
	private $_tel2;
	private $_codeRegion;
	private $_codeCommercial;
	private $_situationFamiliale;
	private $_cin;
	private $_dateNaissance;
	private $_solvabilite;
	private $_nombreIncident;
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
	public function setCodeClient($codeClient){
        $this->_codeClient = $codeClient;
    }

	public function setTypeClient($typeClient){
        $this->_typeClient = $typeClient;
    }

	public function setCivilite($civilite){
        $this->_civilite = $civilite;
    }

	public function setNom($nom){
        $this->_nom = $nom;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
    }

	public function setRue($rue){
        $this->_rue = $rue;
    }

	public function setVille($ville){
        $this->_ville = $ville;
    }

	public function setActivite($activite){
        $this->_activite = $activite;
    }

	public function setEmail($email){
        $this->_email = $email;
    }

	public function setDebit($debit){
        $this->_debit = $debit;
    }

	public function setCredit($credit){
        $this->_credit = $credit;
    }

	public function setTel1($tel1){
        $this->_tel1 = $tel1;
    }

	public function setFax($fax){
        $this->_fax = $fax;
    }

	public function setPermis($permis){
        $this->_permis = $permis;
    }

	public function setDatePermis($datePermis){
        $this->_datePermis = $datePermis;
    }

	public function setTel2($tel2){
        $this->_tel2 = $tel2;
    }

	public function setCodeRegion($codeRegion){
        $this->_codeRegion = $codeRegion;
    }

	public function setCodeCommercial($codeCommercial){
        $this->_codeCommercial = $codeCommercial;
    }

	public function setSituationFamiliale($situationFamiliale){
        $this->_situationFamiliale = $situationFamiliale;
    }

	public function setCin($cin){
        $this->_cin = $cin;
    }

	public function setDateNaissance($dateNaissance){
        $this->_dateNaissance = $dateNaissance;
    }

	public function setSolvabilite($solvabilite){
        $this->_solvabilite = $solvabilite;
    }

	public function setNombreIncident($nombreIncident){
        $this->_nombreIncident = $nombreIncident;
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
	public function codeClient(){
        return $this->_codeClient;
    }

	public function typeClient(){
        return $this->_typeClient;
    }

	public function civilite(){
        return $this->_civilite;
    }

	public function nom(){
        return $this->_nom;
    }

	public function adresse(){
        return $this->_adresse;
    }

	public function rue(){
        return $this->_rue;
    }

	public function ville(){
        return $this->_ville;
    }

	public function activite(){
        return $this->_activite;
    }

	public function email(){
        return $this->_email;
    }

	public function debit(){
        return $this->_debit;
    }

	public function credit(){
        return $this->_credit;
    }

	public function tel1(){
        return $this->_tel1;
    }

	public function fax(){
        return $this->_fax;
    }

	public function permis(){
        return $this->_permis;
    }

	public function datePermis(){
        return $this->_datePermis;
    }

	public function tel2(){
        return $this->_tel2;
    }

	public function codeRegion(){
        return $this->_codeRegion;
    }

	public function codeCommercial(){
        return $this->_codeCommercial;
    }

	public function situationFamiliale(){
        return $this->_situationFamiliale;
    }

	public function cin(){
        return $this->_cin;
    }

	public function dateNaissance(){
        return $this->_dateNaissance;
    }

	public function solvabilite(){
        return $this->_solvabilite;
    }

	public function nombreIncident(){
        return $this->_nombreIncident;
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