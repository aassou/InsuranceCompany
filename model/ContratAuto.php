<?php
class ContratAuto{

	//attributes
	private $_id;
    private $_codeClient;
	private $_referenceCabinet;
	private $_idCompagnie;
	private $_terme;
	private $_police;
	private $_avenant;
	private $_typeAffaire;
	private $_attestation;
	private $_quittance;
	private $_apporteur;
	private $_idBranche;
	private $_idUsage;
	private $_idClasse;
	private $_idSousClasse;
	private $_marque;
	private $_matricule;
	private $_definitiveProvisoire;
	private $_puissanceFiscale;
	private $_nombrePlaces;
	private $_carburant;
	private $_dateProduction;
	private $_dateEffet;
	private $_nombreMois;
	private $_dateEcheance;
	private $_primeRC;
	private $_defenseRecours;
	private $_tierce;
	private $_collision;
	private $_vol;
	private $_incendie;
	private $_brisGlace;
	private $_individuel;
	private $_primeNette;
	private $_taxeAuto;
	private $_taxePTA;
	private $_totalTaxe;
	private $_montantPTA;
	private $_timbre;
	private $_accessoires;
	private $_primeTotale;
	private $_commissionAuto;
	private $_commissionPTA;
	private $_totalCommission;
	private $_TPSAuto;
	private $_TPSPTA;
	private $_totalTPS;
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
    
	public function setReferenceCabinet($referenceCabinet){
        $this->_referenceCabinet = $referenceCabinet;
    }

	public function setIdCompagnie($idCompagnie){
        $this->_idCompagnie = $idCompagnie;
    }

	public function setTerme($terme){
        $this->_terme = $terme;
    }

	public function setPolice($police){
        $this->_police = $police;
    }

	public function setAvenant($avenant){
        $this->_avenant = $avenant;
    }

	public function setTypeAffaire($typeAffaire){
        $this->_typeAffaire = $typeAffaire;
    }

	public function setAttestation($attestation){
        $this->_attestation = $attestation;
    }

	public function setQuittance($quittance){
        $this->_quittance = $quittance;
    }

	public function setApporteur($apporteur){
        $this->_apporteur = $apporteur;
    }

	public function setIdBranche($idBranche){
        $this->_idBranche = $idBranche;
    }

	public function setIdUsage($idUsage){
        $this->_idUsage = $idUsage;
    }

	public function setIdClasse($idClasse){
        $this->_idClasse = $idClasse;
    }

	public function setIdSousClasse($idSousClasse){
        $this->_idSousClasse = $idSousClasse;
    }

	public function setMarque($marque){
        $this->_marque = $marque;
    }

	public function setMatricule($matricule){
        $this->_matricule = $matricule;
    }

	public function setDefinitiveProvisoire($definitiveProvisoire){
        $this->_definitiveProvisoire = $definitiveProvisoire;
    }

	public function setPuissanceFiscale($puissanceFiscale){
        $this->_puissanceFiscale = $puissanceFiscale;
    }

	public function setNombrePlaces($nombrePlaces){
        $this->_nombrePlaces = $nombrePlaces;
    }

	public function setCarburant($carburant){
        $this->_carburant = $carburant;
    }

	public function setDateProduction($dateProduction){
        $this->_dateProduction = $dateProduction;
    }

	public function setDateEffet($dateEffet){
        $this->_dateEffet = $dateEffet;
    }

	public function setNombreMois($nombreMois){
        $this->_nombreMois = $nombreMois;
    }

	public function setDateEcheance($dateEcheance){
        $this->_dateEcheance = $dateEcheance;
    }

	public function setPrimeRC($primeRC){
        $this->_primeRC = $primeRC;
    }

	public function setDefenseRecours($defenseRecours){
        $this->_defenseRecours = $defenseRecours;
    }

	public function setTierce($tierce){
        $this->_tierce = $tierce;
    }

	public function setCollision($collision){
        $this->_collision = $collision;
    }

	public function setVol($vol){
        $this->_vol = $vol;
    }

	public function setIncendie($incendie){
        $this->_incendie = $incendie;
    }

	public function setBrisGlace($brisGlace){
        $this->_brisGlace = $brisGlace;
    }

	public function setIndividuel($individuel){
        $this->_individuel = $individuel;
    }

	public function setPrimeNette($primeNette){
        $this->_primeNette = $primeNette;
    }

	public function setTaxeAuto($taxeAuto){
        $this->_taxeAuto = $taxeAuto;
    }

	public function setTaxePTA($taxePTA){
        $this->_taxePTA = $taxePTA;
    }

	public function setTotalTaxe($totalTaxe){
        $this->_totalTaxe = $totalTaxe;
    }

	public function setMontantPTA($montantPTA){
        $this->_montantPTA = $montantPTA;
    }

	public function setTimbre($timbre){
        $this->_timbre = $timbre;
    }

	public function setAccessoires($accessoires){
        $this->_accessoires = $accessoires;
    }

	public function setPrimeTotale($primeTotale){
        $this->_primeTotale = $primeTotale;
    }

	public function setCommissionAuto($commissionAuto){
        $this->_commissionAuto = $commissionAuto;
    }

	public function setCommissionPTA($commissionPTA){
        $this->_commissionPTA = $commissionPTA;
    }

	public function setTotalCommission($totalCommission){
        $this->_totalCommission = $totalCommission;
    }

	public function setTPSAuto($TPSAuto){
        $this->_TPSAuto = $TPSAuto;
    }

	public function setTPSPTA($TPSPTA){
        $this->_TPSPTA = $TPSPTA;
    }

	public function setTotalTPS($totalTPS){
        $this->_totalTPS = $totalTPS;
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
    
	public function referenceCabinet(){
        return $this->_referenceCabinet;
    }

	public function idCompagnie(){
        return $this->_idCompagnie;
    }

	public function terme(){
        return $this->_terme;
    }

	public function police(){
        return $this->_police;
    }

	public function avenant(){
        return $this->_avenant;
    }

	public function typeAffaire(){
        return $this->_typeAffaire;
    }

	public function attestation(){
        return $this->_attestation;
    }

	public function quittance(){
        return $this->_quittance;
    }

	public function apporteur(){
        return $this->_apporteur;
    }

	public function idBranche(){
        return $this->_idBranche;
    }

	public function idUsage(){
        return $this->_idUsage;
    }

	public function idClasse(){
        return $this->_idClasse;
    }

	public function idSousClasse(){
        return $this->_idSousClasse;
    }

	public function marque(){
        return $this->_marque;
    }

	public function matricule(){
        return $this->_matricule;
    }

	public function definitiveProvisoire(){
        return $this->_definitiveProvisoire;
    }

	public function puissanceFiscale(){
        return $this->_puissanceFiscale;
    }

	public function nombrePlaces(){
        return $this->_nombrePlaces;
    }

	public function carburant(){
        return $this->_carburant;
    }

	public function dateProduction(){
        return $this->_dateProduction;
    }

	public function dateEffet(){
        return $this->_dateEffet;
    }

	public function nombreMois(){
        return $this->_nombreMois;
    }

	public function dateEcheance(){
        return $this->_dateEcheance;
    }

	public function primeRC(){
        return $this->_primeRC;
    }

	public function defenseRecours(){
        return $this->_defenseRecours;
    }

	public function tierce(){
        return $this->_tierce;
    }

	public function collision(){
        return $this->_collision;
    }

	public function vol(){
        return $this->_vol;
    }

	public function incendie(){
        return $this->_incendie;
    }

	public function brisGlace(){
        return $this->_brisGlace;
    }

	public function individuel(){
        return $this->_individuel;
    }

	public function primeNette(){
        return $this->_primeNette;
    }

	public function taxeAuto(){
        return $this->_taxeAuto;
    }

	public function taxePTA(){
        return $this->_taxePTA;
    }

	public function totalTaxe(){
        return $this->_totalTaxe;
    }

	public function montantPTA(){
        return $this->_montantPTA;
    }

	public function timbre(){
        return $this->_timbre;
    }

	public function accessoires(){
        return $this->_accessoires;
    }

	public function primeTotale(){
        return $this->_primeTotale;
    }

	public function commissionAuto(){
        return $this->_commissionAuto;
    }

	public function commissionPTA(){
        return $this->_commissionPTA;
    }

	public function totalCommission(){
        return $this->_totalCommission;
    }

	public function TPSAuto(){
        return $this->_TPSAuto;
    }

	public function TPSPTA(){
        return $this->_TPSPTA;
    }

	public function totalTPS(){
        return $this->_totalTPS;
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