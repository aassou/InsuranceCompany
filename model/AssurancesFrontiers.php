<?php
class AssurancesFrontiers{

	//attributes
	private $_id;
	private $_police;
	private $_attestation;
	private $_idUsage;
	private $_dateEffet;
	private $_duree;
	private $_dateExpiration;
	private $_proprietaire;
	private $_passeport;
	private $_cin;
	private $_adresse;
	private $_permis;
	private $_datePermis;
	private $_categorie;
	private $_immatriculation;
	private $_moteur;
	private $_chassis;
	private $_marque;
	private $_type;
	private $_typeCarrosserie;
	private $_poidsTotalCharge;
	private $_nombrePlaces;
	private $_remorque;
	private $_immatriculationRemorque;
	private $_cylindre;
	private $_intermediaire;
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
	public function setPolice($police){
        $this->_police = $police;
    }

	public function setAttestation($attestation){
        $this->_attestation = $attestation;
    }

	public function setIdUsage($idUsage){
        $this->_idUsage = $idUsage;
    }

	public function setDateEffet($dateEffet){
        $this->_dateEffet = $dateEffet;
    }

	public function setDuree($duree){
        $this->_duree = $duree;
    }

	public function setDateExpiration($dateExpiration){
        $this->_dateExpiration = $dateExpiration;
    }

	public function setProprietaire($proprietaire){
        $this->_proprietaire = $proprietaire;
    }

	public function setPasseport($passeport){
        $this->_passeport = $passeport;
    }

	public function setCin($cin){
        $this->_cin = $cin;
    }

	public function setAdresse($adresse){
        $this->_adresse = $adresse;
    }

	public function setPermis($permis){
        $this->_permis = $permis;
    }

	public function setDatePermis($datePermis){
        $this->_datePermis = $datePermis;
    }

	public function setCategorie($categorie){
        $this->_categorie = $categorie;
    }

	public function setImmatriculation($immatriculation){
        $this->_immatriculation = $immatriculation;
    }

	public function setMoteur($moteur){
        $this->_moteur = $moteur;
    }

	public function setChassis($chassis){
        $this->_chassis = $chassis;
    }

	public function setMarque($marque){
        $this->_marque = $marque;
    }

	public function setType($type){
        $this->_type = $type;
    }

	public function setTypeCarrosserie($typeCarrosserie){
        $this->_typeCarrosserie = $typeCarrosserie;
    }

	public function setPoidsTotalCharge($poidsTotalCharge){
        $this->_poidsTotalCharge = $poidsTotalCharge;
    }

	public function setNombrePlaces($nombrePlaces){
        $this->_nombrePlaces = $nombrePlaces;
    }

	public function setRemorque($remorque){
        $this->_remorque = $remorque;
    }

	public function setImmatriculationRemorque($immatriculationRemorque){
        $this->_immatriculationRemorque = $immatriculationRemorque;
    }

	public function setCylindre($cylindre){
        $this->_cylindre = $cylindre;
    }

	public function setIntermediaire($intermediaire){
        $this->_intermediaire = $intermediaire;
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
	public function police(){
        return $this->_police;
    }

	public function attestation(){
        return $this->_attestation;
    }

	public function idUsage(){
        return $this->_idUsage;
    }

	public function dateEffet(){
        return $this->_dateEffet;
    }

	public function duree(){
        return $this->_duree;
    }

	public function dateExpiration(){
        return $this->_dateExpiration;
    }

	public function proprietaire(){
        return $this->_proprietaire;
    }

	public function passeport(){
        return $this->_passeport;
    }

	public function cin(){
        return $this->_cin;
    }

	public function adresse(){
        return $this->_adresse;
    }

	public function permis(){
        return $this->_permis;
    }

	public function datePermis(){
        return $this->_datePermis;
    }

	public function categorie(){
        return $this->_categorie;
    }

	public function immatriculation(){
        return $this->_immatriculation;
    }

	public function moteur(){
        return $this->_moteur;
    }

	public function chassis(){
        return $this->_chassis;
    }

	public function marque(){
        return $this->_marque;
    }

	public function type(){
        return $this->_type;
    }

	public function typeCarrosserie(){
        return $this->_typeCarrosserie;
    }

	public function poidsTotalCharge(){
        return $this->_poidsTotalCharge;
    }

	public function nombrePlaces(){
        return $this->_nombrePlaces;
    }

	public function remorque(){
        return $this->_remorque;
    }

	public function immatriculationRemorque(){
        return $this->_immatriculationRemorque;
    }

	public function cylindre(){
        return $this->_cylindre;
    }

	public function intermediaire(){
        return $this->_intermediaire;
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