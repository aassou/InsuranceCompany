<?php
class ContratAutoActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_contratAutoManager;

    //constructor
    public function __construct($source){
    	$this->_contratAutoManager = new ContratAutoManager(PDOFactory::getMysqlConnection());
    	$this->_source = $source;
    }

    //getters
    public function actionMessage(){
        return $this->_actionMessage;
    }
    

    public function typeMessage(){
        return $this->_typeMessage;
    }
    

    public function source(){
        return $this->_source;
    }
    
    //actions
    public function add($contratAuto){
        if( !empty($contratAuto['referenceCabinet']) ){
			$referenceCabinet = htmlentities($contratAuto['referenceCabinet']);
			$idCompagnie = htmlentities($contratAuto['idCompagnie']);
			$terme = htmlentities($contratAuto['terme']);
			$police = htmlentities($contratAuto['police']);
			$avenant = htmlentities($contratAuto['avenant']);
			$typeAffaire = htmlentities($contratAuto['typeAffaire']);
			$attestation = htmlentities($contratAuto['attestation']);
			$quittance = htmlentities($contratAuto['quittance']);
			$apporteur = htmlentities($contratAuto['apporteur']);
			$idBranche = htmlentities($contratAuto['idBranche']);
			$idUsage = htmlentities($contratAuto['idUsage']);
			$idClasse = htmlentities($contratAuto['idClasse']);
			$idSousClasse = htmlentities($contratAuto['idSousClasse']);
			$marque = htmlentities($contratAuto['marque']);
			$matricule = htmlentities($contratAuto['matricule']);
			$definitiveProvisoire = htmlentities($contratAuto['definitiveProvisoire']);
			$puissanceFiscale = htmlentities($contratAuto['puissanceFiscale']);
			$nombrePlaces = htmlentities($contratAuto['nombrePlaces']);
			$carburant = htmlentities($contratAuto['carburant']);
			$dateProduction = htmlentities($contratAuto['dateProduction']);
			$dateEffet = htmlentities($contratAuto['dateEffet']);
			$nombreMois = htmlentities($contratAuto['nombreMois']);
			$dateEcheance = htmlentities($contratAuto['dateEcheance']);
			$primeRC = htmlentities($contratAuto['primeRC']);
			$defenseRecours = htmlentities($contratAuto['defenseRecours']);
			$tierce = htmlentities($contratAuto['tierce']);
			$collision = htmlentities($contratAuto['collision']);
			$vol = htmlentities($contratAuto['vol']);
			$incendie = htmlentities($contratAuto['incendie']);
			$brisGlace = htmlentities($contratAuto['brisGlace']);
			$individuel = htmlentities($contratAuto['individuel']);
			$primeNette = htmlentities($contratAuto['primeNette']);
			$taxeAuto = htmlentities($contratAuto['taxeAuto']);
			$taxePTA = htmlentities($contratAuto['taxePTA']);
			$totalTaxe = htmlentities($contratAuto['totalTaxe']);
			$montantPTA = htmlentities($contratAuto['montantPTA']);
			$timbre = htmlentities($contratAuto['timbre']);
			$accessoires = htmlentities($contratAuto['accessoires']);
			$primeTotale = htmlentities($contratAuto['primeTotale']);
			$commissionAuto = htmlentities($contratAuto['commissionAuto']);
			$commissionPTA = htmlentities($contratAuto['commissionPTA']);
			$totalCommission = htmlentities($contratAuto['totalCommission']);
			$TPSAuto = htmlentities($contratAuto['TPSAuto']);
			$TPSPTA = htmlentities($contratAuto['TPSPTA']);
			$totalTPS = htmlentities($contratAuto['totalTPS']);
			$createdBy = $_SESSION['userAxaAmazigh']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $contratAuto = new ContratAuto(array(
				'referenceCabinet' => $referenceCabinet,
				'idCompagnie' => $idCompagnie,
				'terme' => $terme,
				'police' => $police,
				'avenant' => $avenant,
				'typeAffaire' => $typeAffaire,
				'attestation' => $attestation,
				'quittance' => $quittance,
				'apporteur' => $apporteur,
				'idBranche' => $idBranche,
				'idUsage' => $idUsage,
				'idClasse' => $idClasse,
				'idSousClasse' => $idSousClasse,
				'marque' => $marque,
				'matricule' => $matricule,
				'definitiveProvisoire' => $definitiveProvisoire,
				'puissanceFiscale' => $puissanceFiscale,
				'nombrePlaces' => $nombrePlaces,
				'carburant' => $carburant,
				'dateProduction' => $dateProduction,
				'dateEffet' => $dateEffet,
				'nombreMois' => $nombreMois,
				'dateEcheance' => $dateEcheance,
				'primeRC' => $primeRC,
				'defenseRecours' => $defenseRecours,
				'tierce' => $tierce,
				'collision' => $collision,
				'vol' => $vol,
				'incendie' => $incendie,
				'brisGlace' => $brisGlace,
				'individuel' => $individuel,
				'primeNette' => $primeNette,
				'taxeAuto' => $taxeAuto,
				'taxePTA' => $taxePTA,
				'totalTaxe' => $totalTaxe,
				'montantPTA' => $montantPTA,
				'timbre' => $timbre,
				'accessoires' => $accessoires,
				'primeTotale' => $primeTotale,
				'commissionAuto' => $commissionAuto,
				'commissionPTA' => $commissionPTA,
				'totalCommission' => $totalCommission,
				'TPSAuto' => $TPSAuto,
				'TPSPTA' => $TPSPTA,
				'totalTPS' => $totalTPS,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $this->_contratAutoManager->add($contratAuto);
            $this->_actionMessage = "Opération Valide : ContratAuto Ajouté(e) avec succès.";  
            $this->_typeMessage = "success";
            $this->_source = "view/contratAuto";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'referenceCabinet'.";
            $this->_typeMessage = "error";
            $this->_source = "view/contratAuto";
        }
    }
    

    public function update($contratAuto){
        if(!empty($contratAuto['referenceCabinet'])){
			$referenceCabinet = htmlentities($contratAuto['referenceCabinet']);
			$idCompagnie = htmlentities($contratAuto['idCompagnie']);
			$terme = htmlentities($contratAuto['terme']);
			$police = htmlentities($contratAuto['police']);
			$avenant = htmlentities($contratAuto['avenant']);
			$typeAffaire = htmlentities($contratAuto['typeAffaire']);
			$attestation = htmlentities($contratAuto['attestation']);
			$quittance = htmlentities($contratAuto['quittance']);
			$apporteur = htmlentities($contratAuto['apporteur']);
			$idBranche = htmlentities($contratAuto['idBranche']);
			$idUsage = htmlentities($contratAuto['idUsage']);
			$idClasse = htmlentities($contratAuto['idClasse']);
			$idSousClasse = htmlentities($contratAuto['idSousClasse']);
			$marque = htmlentities($contratAuto['marque']);
			$matricule = htmlentities($contratAuto['matricule']);
			$definitiveProvisoire = htmlentities($contratAuto['definitiveProvisoire']);
			$puissanceFiscale = htmlentities($contratAuto['puissanceFiscale']);
			$nombrePlaces = htmlentities($contratAuto['nombrePlaces']);
			$carburant = htmlentities($contratAuto['carburant']);
			$dateProduction = htmlentities($contratAuto['dateProduction']);
			$dateEffet = htmlentities($contratAuto['dateEffet']);
			$nombreMois = htmlentities($contratAuto['nombreMois']);
			$dateEcheance = htmlentities($contratAuto['dateEcheance']);
			$primeRC = htmlentities($contratAuto['primeRC']);
			$defenseRecours = htmlentities($contratAuto['defenseRecours']);
			$tierce = htmlentities($contratAuto['tierce']);
			$collision = htmlentities($contratAuto['collision']);
			$vol = htmlentities($contratAuto['vol']);
			$incendie = htmlentities($contratAuto['incendie']);
			$brisGlace = htmlentities($contratAuto['brisGlace']);
			$individuel = htmlentities($contratAuto['individuel']);
			$primeNette = htmlentities($contratAuto['primeNette']);
			$taxeAuto = htmlentities($contratAuto['taxeAuto']);
			$taxePTA = htmlentities($contratAuto['taxePTA']);
			$totalTaxe = htmlentities($contratAuto['totalTaxe']);
			$montantPTA = htmlentities($contratAuto['montantPTA']);
			$timbre = htmlentities($contratAuto['timbre']);
			$accessoires = htmlentities($contratAuto['accessoires']);
			$primeTotale = htmlentities($contratAuto['primeTotale']);
			$commissionAuto = htmlentities($contratAuto['commissionAuto']);
			$commissionPTA = htmlentities($contratAuto['commissionPTA']);
			$totalCommission = htmlentities($contratAuto['totalCommission']);
			$TPSAuto = htmlentities($contratAuto['TPSAuto']);
			$TPSPTA = htmlentities($contratAuto['TPSPTA']);
			$totalTPS = htmlentities($contratAuto['totalTPS']);
			$updatedBy = $_SESSION['userAxaAmazigh']->login();
            $updated = date('Y-m-d h:i:s');
            $contratAuto = new ContratAuto(array(
				'id' => $idContratAuto,
				'referenceCabinet' => $referenceCabinet,
				'idCompagnie' => $idCompagnie,
				'terme' => $terme,
				'police' => $police,
				'avenant' => $avenant,
				'typeAffaire' => $typeAffaire,
				'attestation' => $attestation,
				'quittance' => $quittance,
				'apporteur' => $apporteur,
				'idBranche' => $idBranche,
				'idUsage' => $idUsage,
				'idClasse' => $idClasse,
				'idSousClasse' => $idSousClasse,
				'marque' => $marque,
				'matricule' => $matricule,
				'definitiveProvisoire' => $definitiveProvisoire,
				'puissanceFiscale' => $puissanceFiscale,
				'nombrePlaces' => $nombrePlaces,
				'carburant' => $carburant,
				'dateProduction' => $dateProduction,
				'dateEffet' => $dateEffet,
				'nombreMois' => $nombreMois,
				'dateEcheance' => $dateEcheance,
				'primeRC' => $primeRC,
				'defenseRecours' => $defenseRecours,
				'tierce' => $tierce,
				'collision' => $collision,
				'vol' => $vol,
				'incendie' => $incendie,
				'brisGlace' => $brisGlace,
				'individuel' => $individuel,
				'primeNette' => $primeNette,
				'taxeAuto' => $taxeAuto,
				'taxePTA' => $taxePTA,
				'totalTaxe' => $totalTaxe,
				'montantPTA' => $montantPTA,
				'timbre' => $timbre,
				'accessoires' => $accessoires,
				'primeTotale' => $primeTotale,
				'commissionAuto' => $commissionAuto,
				'commissionPTA' => $commissionPTA,
				'totalCommission' => $totalCommission,
				'TPSAuto' => $TPSAuto,
				'TPSPTA' => $TPSPTA,
				'totalTPS' => $totalTPS,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $this->_contratAutoManager->update($contratAuto);
            $this->_actionMessage = "Opération Valide : ContratAuto Modifié(e) avec succès.";
            $this->_typeMessage = "success";
            $this->_source = "view/contratAuto";
        }
        else{
            $this->_actionMessage = "Opération Invalide : Vous devez remplir le champ 'referenceCabinet'.";
            $this->_typeMessage = "error";
            $this->_source = "view/contratAuto";
        }
    }
    

    public function delete($contratAuto){
        $idContratAuto = htmlentities($contratAuto['idContratAuto']);
        $this->_contratAutoManager->delete($idContratAuto);
        $this->_actionMessage = "Opération Valide : ContratAuto supprimé(e) avec succès.";
        $this->_typeMessage = "success";
        $this->_source = "view/contratAuto";
    }
    

    public function getContratAutoById($id){
        return $this->_contratAutoManager->getContratAutoById($id);
    }
    

    public function getContratAutos(){
        return  $this->_contratAutoManager->getContratAutos();
    }
    

    public function getContratAutosByLimits($begin, $end){
        return $this->_contratAutoManager->getContratAutosByLimits($begin, $end);
    }
    

    public function getContratAutosNumber(){
        return $this->_contratAutoManager->getContratAutosNumber();
    }
    

    public function getLastId(){
        return $this->_contratAutoManager->getLastId();
    }
    
}
    