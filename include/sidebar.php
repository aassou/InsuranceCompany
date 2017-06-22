<?php $currentPage = basename($_SERVER['PHP_SELF']) ?>
<div class="page-sidebar nav-collapse collapse">
    <ul>
        <!--li>
            <form class="sidebar-search" action="controller/ClientActionController.php" method="post">
                <div class="input-box">
                    <a href="javascript:;" class="remove"></a>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="clients-search">
                    <input type="text" name="clientName" placeholder="Chercher un client">             
                    <input type="button" class="submit" value="">
                </div>
            </form>
        </li-->
		<li><div class="sidebar-toggler hidden-phone"></div></li>
		<li></li>
		<!---------------------------- Dashboard Begin  -------------------------------------------->
		<li class="start <?php if($currentPage=="dashboard.php" 
		or $currentPage=="recherches.php"
		or $currentPage=="compte-bancaire.php"
		or $currentPage=="conges.php"
		or $currentPage=="annuaire.php"
		or $currentPage=="statistiques.php"
		or $currentPage=="messages.php"
		or $currentPage=="user-profil.php"
		or $currentPage=="clients-search.php"
		or $currentPage=="fournisseurs-search.php"
		or $currentPage=="client.php"
		or $currentPage=="clients-synthese.php"
		or $currentPage=="clients-attente.php"
		or $currentPage=="clients-modification.php"
		or $currentPage=="contrats-synthese.php"
		or $currentPage=="employes-projet-search.php"
		or $currentPage=="tasks.php"
		or $currentPage=="bugs.php"
		or $currentPage=="alert.php"
		or $currentPage=="todo.php"
		or $currentPage=="collaboration.php"
		or $currentPage=="commissions.php"
		or $currentPage=="contrat-status.php"
		or $currentPage=="properties-status.php"
		or $currentPage=="operations-status.php"
		or $currentPage=="operations-status-group.php"
		or $currentPage=="status.php"
		or $currentPage=="contrats-desistes.php"
		or $currentPage=="suivi-company.php"
		or $currentPage=="charges-communs-type.php"
		or $currentPage=="charges-communs-grouped.php"
		or $currentPage=="releve-bancaire.php"
		){echo "active ";} ?>">
			<a href="dashboard.php">
			<i class="icon-dashboard"></i> 
			<span class="title">Accueil</span>
			</a>
		</li>
		<!---------------------------- Dashboard End    -------------------------------------------->
		<!---------------------------- Gestion des projets Begin ----------------------------------->
		<?php 
		if ( 
		    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
		    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
		    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
            ) { 
			$productionClass="";
			if($currentPage=="production.php"
			or $currentPage=="automobile.php"
			or $currentPage=="contratAuto.php"
			or $currentPage=="automobile-test.php"
			or $currentPage=="automobile-update.php"
			or $currentPage=="automobile-add-part-1.php"
			or $currentPage=="automobile-add-part-2.php"
			or $currentPage=="divers.php"
			or $currentPage=="attestation.php"
			or $currentPage=="assurancesFrontiers.php"
			or $currentPage=="assurances-frontiers-add.php"
			or $currentPage=="carteVerte.php"
			){
				$productionClass = "active ";
			}
		?> 
		<li class="<?= $productionClass ?> has-sub">
			<a href="production.php">
			<i class="icon-briefcase"></i> 
			<span class="title">Production</span>
			</a>
			<ul class="sub">
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="automobile.php"
                            or $currentPage=="automobile-add-part-1.php"
                            or $currentPage=="automobile-add-part-2.php"
                            ){
                    ?> class="active" <?php } ?> >
                    <a href="automobile.php">Automobile</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION["userAxaAmazigh"]->profil() == "user" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="divers.php"
                            or $currentPage=="autres.php"
                            ){?> class="active" <?php } ?> >
                    <a href="divers.php">Divers</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="attestation.php"
                            ){
                    ?> class="active" <?php } ?> >
                    <a href="attestation.php">Attestations</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="assurancesFrontiers.php"
                            or $currentPage=="assurances-frontiers-add.php"
                            ){
                    ?> class="active" <?php } ?> >
                    <a href="assurancesFrontiers.php">Assurances Frontières</a>
                </li>
                <li <?php if($currentPage=="carteVerte.php"){
                    ?> class="active" <?php } ?> >
                    <a href="carteVerte.php">Cartes Vertes</a>
                </li>
                <?php
                }
                ?>
            </ul>
		</li>
		<?php
		}
		?> 
		<!---------------------------- Gestion des Projets End -------------------------------------->
		<!---------------------------- Livraisons Begin  -------------------------------------------->
		<?php 
            $gestionLivraisonClass="";
            if(
            $currentPage=="livraisons-group.php"
            or $currentPage=="livraisons-fournisseur.php"
            or $currentPage=="livraisons-details.php"
            or $currentPage=="livraisons-group-iaaza.php"
            or $currentPage=="livraisons-fournisseur-iaaza.php"
            or $currentPage=="livraisons-details-iaaza.php"
            or $currentPage=="reglements-fournisseur.php"
            or $currentPage=="reglements-fournisseur-iaaza.php"
            or $currentPage=="livraisons-fournisseur-mois-list.php"
            or $currentPage=="livraisons-fournisseur-mois.php"
            or $currentPage=="livraisons-fournisseur-mois-iaaza.php"
            or $currentPage=="livraisons-fournisseur-mois-list-iaaza.php"
            ){
                $gestionLivraisonClass = "active ";
            } 
        ?> 
        <li class="<?= $gestionLivraisonClass; ?> has-sub ">
            <a href="javascript:;">
            <i class="icon-truck"></i> 
            <span class="title">Gestion Livraisons</span>
            <span class="arrow "></span>
            </a>
            <ul class="sub">
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="livraisons-group.php"
                            or $currentPage=="livraisons-fournisseur.php"
                            or $currentPage=="livraisons-details.php"
                            or $currentPage=="reglements-fournisseur.php"
                            or $currentPage=="livraisons-fournisseur-mois.php"
                            or $currentPage=="livraisons-fournisseur-mois-list.php"
                            ){
                    ?> class="active" <?php } ?> >
                    <a href="livraisons-group.php">Société Annahda</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION["userAxaAmazigh"]->profil() == "user" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="livraisons-group-iaaza.php"
                            or $currentPage=="livraisons-fournisseur-iaaza.php"
                            or $currentPage=="livraisons-details-iaaza.php"
                            or $currentPage=="reglements-fournisseur-iaaza.php"
                            ){?> class="active" <?php } ?> >
                    <a href="livraisons-group-iaaza.php">Société Iaaza</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <!---------------------------- Livraisons End    -------------------------------------------->
        <!---------------------------- Commandes Begin  -------------------------------------------->
        <?php 
            $gestionCommandeClass="";
            if(
            $currentPage=="commande-group.php"
            or $currentPage=="commande-group-iaaza.php"
            or $currentPage=="commande-details-iaaza.php"
            or $currentPage=="commande-mois-annee-iaaza.php"
            ){
                $gestionCommandeClass = "active ";
            } 
        ?> 
        <li class="<?= $gestionCommandeClass; ?> has-sub ">
            <a href="javascript:;">
            <i class="icon-shopping-cart"></i> 
            <span class="title">Gestion Commandes</span>
            <span class="arrow "></span>
            </a>
            <ul class="sub">
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="commande-group.php"
                            ){
                    ?> class="active" <?php } ?> >
                    <a href="commande-group.php">Société Annahda</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION["userAxaAmazigh"]->profil() == "user" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="commande-group-iaaza.php"
                            or $currentPage=="commande-details-iaaza.php"
                            or $currentPage=="commande-mois-annee-iaaza.php"
                            ){?> class="active" <?php } ?> >
                    <a href="commande-group-iaaza.php">Société Iaaza</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <!---------------------------- Commandes End    -------------------------------------------->
        <!---------------------------- Caisse Begin  -------------------------------------------->
        <?php 
            $gestionCaisseClass="";
            if(
            $currentPage=="caisse.php" or 
            $currentPage=="caisse-iaaza.php" or
            $currentPage=="caisse-group.php" or
            $currentPage=="caisse-mois-annee.php" or
            $currentPage=="caisse-group-iaaza.php" or
            $currentPage=="caisse-mois-annee-iaaza.php"
            ){
                $gestionCaisseClass = "active ";
            } 
        ?> 
        <li class="<?= $gestionCaisseClass; ?> has-sub ">
            <a href="javascript:;">
            <i class="icon-money"></i> 
            <span class="title">Gestion Caisses</span>
            <span class="arrow "></span>
            </a>
            <ul class="sub">
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION['userAxaAmazigh']->profil() == "manager" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="caisse-group.php"){
                    ?> class="active" <?php } ?> >
                    <a href="caisse-group.php">Société Annahda</a>
                </li>
                <?php
                }
                ?>
                <?php
                if ( 
                    $_SESSION["userAxaAmazigh"]->profil() == "admin" ||
                    $_SESSION["userAxaAmazigh"]->profil() == "user" ||
                    $_SESSION['userAxaAmazigh']->profil() == "consultant" 
                    ) {
                ?>
                <li <?php if($currentPage=="caisse-group-iaaza.php"){?> class="active" <?php } ?> >
                    <a href="caisse-group-iaaza.php">Société Iaaza</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <!---------------------------- Caisse End    -------------------------------------------->
		<!---------------------------- Parametrage Begin  -------------------------------------------->
		<?php
        if ( $_SESSION["userAxaAmazigh"]->profil() == "admin" ) {
        ?>
        <li class="start <?php if($currentPage=="configuration.php" 
        or $currentPage=="history-group.php"
        or $currentPage=="history.php"
        or $currentPage=="clients-list.php"
        or $currentPage=="employes-contrats.php"
        or $currentPage=="user.php"
        or $currentPage=="type-charges.php"
        or $currentPage=="type-charges-communs.php"
        or $currentPage=="fournisseurs.php"
        or $currentPage=="compagnie.php"
        or $currentPage=="branche.php"
        or $currentPage=="usage.php"
        or $currentPage=="classe.php"
        or $currentPage=="sousClasse.php"
        or $currentPage=="banque.php"
        or $currentPage=="region.php"
        or $currentPage=="commercial.php"
        or $currentPage=="expert.php"
        or $currentPage=="classeAT.php"
        or $currentPage=="activiteAT.php"
        or $currentPage=="motifRetourQuittance.php"
        or $currentPage=="tarifRC.php"
        or $currentPage=="tarifFrontiere.php"
        or $currentPage=="fractionPrimeRC.php"
        or $currentPage=="PTA.php"
        or $currentPage=="vol.php"
        or $currentPage=="incendie.php"
        or $currentPage=="tierce.php"
        or $currentPage=="defenseRecours.php"
        or $currentPage=="dommageCollision.php"
        or $currentPage=="individuelConducteur.php"
        or $currentPage=="codeReglementSinistre.php"
        or $currentPage=="operations-status-archive-group.php"
        or $currentPage=="operations-status-archive.php"
        or $currentPage=="releve-bancaire-archive.php"
        or $currentPage=="compteBancaire.php"
        or $currentPage=="tarifsAssurancesFrontieres.php"
        ){echo "active ";} ?>">
            <a href="configuration.php">
            <i class="icon-wrench"></i> 
            <span class="title">Paramètrages</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Parametrage End    -------------------------------------------->
	</ul>
	<!-- END SIDEBAR MENU -->
</div>