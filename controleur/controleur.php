<?php


require_once("modele/modele.php");
require_once("vue/vue.php");

function CtlAfficherPageConnection()
{
    afficherLogin();
}

function CtlSeConnecter($username, $password)
{
    $user = getUtilisateurByLogin($username, $password);
    if (!empty($user)) {
        $_SESSION["user_id"] = $user->ID_UTILISATEUR;
        if ($user->ROLE == "D") {
            CtlAfficherPageDirecteur();
        } elseif ($user->ROLE == "ACC") {
            afficherPageAgentAccueil();
        } elseif ($user->ROLE == "ADM") {
            $agentsadmin = recupererAgentsAdministratifs();
            afficherPageAdmin($agentsadmin);
        }
    } else {
        afficherLoginAvecMessage("<strong style='color:red'>Le nom d'utilisateur ou le mot de passe n'est pas correct !</strong>");
    }
}

function CtlAfficherErreurGenerale($err)
{
    afficherPageErreurGenerale($err);
}

function CtlAjoutUtilisateur($login, $mdp, $role, $nom, $prenom)
{
    ajouterUtilisateurUniv($login, $mdp, $role, $nom, $prenom);
    echo("<form action='index.php' method='post'><p>L'utilisateur $login a été ajouté avec succes !<br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

function CtlAfficherPageDirecteur()
{
    $agents = recupererListeAgents($_SESSION["user_id"]);
    $justif = recupererListeJustificatif();
    $service = recupererListeService();
    $user = getUtilisateurByID($_SESSION["user_id"]);
    afficherPageDirecteur($agents, $justif, $service, $user);

}

function CtlAfficherPageAgentAccueil(){
    afficherPageAgentAccueil();
}

function CtlAfficherPageAgentAdmin(){
    $agentsadmin = recupererAgentsAdministratifs();
    afficherPageAdmin($agentsadmin);
}

function CtlSupprimerUtilisateur($id)
{
    supprimerUtilisateur($id);
    echo("<form action='index.php' method='post'><p>L'utilisateur n° $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

function CtlModifLogin($login, $mdp, $user_id, $nom, $prenom)
{
    $user = getUtilisateurByID($user_id);
    $prenomuti = $user->PRENOM;
    modifLogin($login, $mdp, $user_id, $nom, $prenom);
    echo("<form action='index.php' method='post'><p>L'utilisateur $prenomuti a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifLogin($user_id)
{
    $user = getUtilisateurByID($user_id);
    $prenom = $user->PRENOM;
    echo(" <p>Modification du login de $prenom </p>
            <fieldset>
                    <form action='index.php' id='modifierlogin' method='post'>
                    <p><input name='idagent' type='hidden' value='$user_id'></p>
                    <p><label for='modifprenom'>Choisissez un nouveau prenom : </label><input type='text' name='modifprenom'></p>
                    <p><label for='modifnom'>Choisissez un nouveau nom : </label><input type='text' name='modifnom'></p>
                    <p><label for='modiflogin'>Choisissez un nouveau login : </label><input type='text' name='modiflogin'></p>
                    <p><label for='modifmdp'>Choisissez un nouveau mot de passe : </label><input type='text' name='modifmdp'></p>
                    <p><input type='submit' name='activemodiflogin' value='Modifier'></p>
            </fieldset>");
}

function CtlAjouterJustificatif($nom)
{
    ajouterJustificatif($nom);
    echo("<form action='index.php' method='post'><p>Le justificatif $nom a été ajouté avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlSupprimerJustificatif($id)
{
    supprimerJustificatif($id);
    echo("<form action='index.php' method='post'><p>Le justificatif n° $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlModifJustificatif($nom, $id_justificatif)
{
    $_res = getJustificatifByID($id_justificatif);
    $justif = $_res->NOM;
    modifJustificatif($nom, $id_justificatif);
    echo("<form action='index.php' method='post'><p>L'utilisateur $justif a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifJustificatif($id_justificatif)
{
    $_temp = getJustificatifByID($id_justificatif);
    $justif = $_temp->NOM;
    echo(" <p>Modification du login de $justif </p>
            <fieldset>
                    <form action='index.php' id='modifierjustif' method='post'>
                    <p><input name='idjustif' type='hidden' value='$id_justificatif'></p>
                    <p><label for='modifjustif'>Choisissez un nouveau justificatif : </label><input type='text' name='modifjustif'></p>
                    <p><input type='submit' name='activemodifjustif' value='Modifier'></p>
            </fieldset>");
}

function CtlAfficherPageAdminAvecPlanning($employe, $date)
{
    $agentsadmin = recupererAgentsAdministratifs();
    $formations = getFormations($employe, $date);
    $employename = getUtilisateurByID($employe);
    $rdv = getRendezVousComplet($employe, $date);
    afficherPageAdmin($agentsadmin, $formations, $employename->NOM . " " . $employename->PRENOM, $date, $rdv);
}

function CtlAjouterService($nom, $montant, $checked = null)
{
    $sid = ajouterService($nom, $montant);
    if ($checked != null) {
        foreach ($checked as $check) {
            ajouterAFournir($sid, $check);
        }
    }

    echo("<form action='index.php' method='post'><p>Le service $nom a été ajouté avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifService($id_service)
{
    $service = getServiceByID($id_service);
    $nomservice = $service->NOM;
    $listejus="";
    $listejustif="";
    $listedetoutlesjus= recupererListeJustificatif();
    foreach ($listedetoutlesjus as $justificatif){
        $listejus .= "<option value='$justificatif->ID_JUSTIFICATIF'>$justificatif->NOM</option>";
        $listejustif .= "<p><input type='checkbox' name='justifafournir[]' value='$justificatif->ID_JUSTIFICATIF'> $justificatif->NOM</p>";
    }
    echo(" <p>Modification du service $nomservice </p>
            <fieldset>
                    <form action='index.php' id='modifierservice' method='post'>
                    <p><input name='idservice' type='hidden' value='$id_service'></p>
                    <p><label for='modifservice'>Choisissez un nouveau nom pour le service : </label><input type='text' name='modifservice'></p>
                    <p>Choisissez les nouveaux justificatifs à fournir : </p>
                    <p> $listejustif</p>
                    <p><label for='modifmontant'>Choisissez un nouveau montant : </label><input type='text' name='modifmontant'></p>
                    <p><input type='submit' name='activemodifservice' value='Modifier'></p>
                    </form>
            </fieldset>");
}

function CtlModifService($nom, $montant, $id_service, $checked = null){
    modifService($nom, $montant, $id_service);
    suppAFournir($id_service);
    if ($checked != null){
        foreach ($checked as $check){
            ajouterAFournir($id_service, $check);
        }
    }
    echo("<form action='index.php' method='post'><p>Le service $nom a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");


}

function CtlSupprimerService($id){
    supprimerService($id);
    echo("<form action='index.php' method='post'><p>Le service $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAjouterEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance){
    ajouterEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance);
    echo("<form action='index.php' method='post'><p>L'étudiant $nom $prenom a été ajouté avec succès ! <br><button type='submit' name='affacc'>Retour vers l'accueil</button><form action='index.php' method='post'>");

}

function CtlRechercherEtudiant($nom){
    $etu = rechercherEtudiant($nom);
    echo ("<fieldset>
    <legend>Modifications des informations à propos de $etu->NOM :</legend>
    <form action='index.php' id='etu' method='post' autocomplete='off'>
        <p><label for='modifnumetu'>Numéro étudiant : </label><input type='number' name='modifnumetu' value='$etu->ID_ETUDIANT' required></p>
        <p><label for='modifnometu'>Nom : </label><input type='text' name='modifnometu' value='$etu->NOM' required></p>
        <p><label for='modifprenometu'>Prénom : </label><input type='text' name='modifprenometu' value='$etu->PRENOM' required></p>
        <p><label for='modifdatenaissanceetu'>Date de naissance : </label><input type='date' name='modifdatenaissanceetu' value='$etu->DATE_NAISSANCE' required></p>
        <p><label for='modifadresseetu'>Adresse : </label><input type='text' name='modifadresseetu' value='$etu->ADRESSE' required></p>
        <p><label for='modifteletu'>Numéro de téléphone : </label><input type='tel' name='modifteletu' value='$etu->TELEPHONE' required></p>
        <p><label for='modifmailetu'>Adresse mail : </label><input type='email' name='modifmailetu' value='$etu->MAIL' required></p>
        <p><label for='modifdecouvertetu'>Découvert autorisé : </label><input type='number' name='modifdecouvertetu' value='$etu->DECOUVERT' required></p>
        <p><input type='submit' value='Enregistrer modifications' name='activemodifetu'></p>
        <p><input type='submit' value='Supprimer étudiant' name='activesuppetu'></p>

    </form>

    </fieldset>");
}



function CtlModifierEtudiant($id_etu, $nom, $prenom, $datenaissance, $adresse, $tel, $mail, $decouvert){
    modifierEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance);
    echo("<form action='index.php' method='post'><p>Les informations de l'étudiant $nom $prenom ont été modifié avec succès ! <br><button type='submit' name='affacc'>Retour vers l'accueil</button><form action='index.php' method='post'>");
}
function CtlSupprimerEtu($nom){
    supprimerEtu($nom);
    echo("<form action='index.php' method='post'><p>L'étudiant $nom a été supprimé avec succès ! <br><button type='submit' name='affacc'>Retour vers l'accueil</button><form action='index.php' method='post'>");

}

function CtlChangerDecouvert($idetu, $montant)
{
    changerDecouvert($idetu, $montant);
    echo("<form action='index.php' method='post'><p>Le decouvert a été modifié a $montant<br><button type='submit' name='affadm'>Retour vers l'accueil</button><form action='index.php' method='post'>");

}

function CtlAfficherListeAPayer($nometu)
{
    $idetu = rechercherEtudiant($nometu);
    $paiements = getListePaiements($idetu->ID_ETUDIANT);
    afficherListePourPaiement($paiements, $nometu);
}

function CtlEffectuerUnPaiement($value, $nom)
{
    foreach ($value as $check)
    {
        $paie = getPaiementByID($check);
        effectuerUnPaiement($paie->ID_PAIEMENT);
    }
    echo("<form action='index.php' method='post'><p>Les paiements ont été effectués.<br><input type='hidden' name='etuname' value='$nom'><button type='submit' name='affpaie'>Revenir en arriere</button><form action='index.php' method='post'>");

}

function CtlPasserEnDiffere($data, $nom)
{
    $total = 0;
    foreach ($data as $check)
    {
        $paie = getPaiementByID($check);
        $service = getServiceByID($paie->ID_SERVICE);
        $total += $service->MONTANT;
    }

    if(peutDiffere($paie->ID_ETUDIANT, $total))
    {
        foreach ($data as $check)
        {
            $paie = getPaiementByID($check);
            passerEnDiffere($paie->ID_PAIEMENT);
        }
        echo("<form action='index.php' method='post'><p>Les paiements ont été passés en différé.<br><input type='hidden' name='etuname' value='$nom'><button type='submit' name='affpaie'>Revenir en arriere</button><form action='index.php' method='post'>");

    }else{
        echo("<form action='index.php' method='post'><p>Le montant total de différés de l'etudiant dépasse son découvert autorisé<br><input type='hidden' name='etuname' value='$nom'><button type='submit' name='affpaie'>Revenir en arriere</button><form action='index.php' method='post'>");
    }
}

function CtlSyntheseRdv($id_rdv){
    $etu = getNomEtuByIdRdv($id_rdv);
    $service = getServiceByIdRdv($id_rdv);
    $restant = $etu->DECOUVERT - getMontantEnDiffere($etu->ID_ETUDIANT);
    echo("<fieldset>
    <legend>Synthèse du rendez-vous :</legend>
        <p>Nom : $etu->NOM</p>
        <p>Prénom : $etu->PRENOM</p>
        <p>Le nom du service : $service->NOM</p>
        <p>Le montant du service : $service->MONTANT €</p>
    </fieldset>
    <br>

    <fieldset>
    <legend>Synthèse de $etu->NOM $etu->PRENOM :</legend>

        <p>Numéro étudiant : $etu->ID_ETUDIANT </p>
        <p>Nom : $etu->NOM</p>
        <p>Prénom : $etu->PRENOM</p>
        <p>Date de naissance : $etu->DATE_NAISSANCE</p>
        <p>Adresse : $etu->ADRESSE</p>
        <p>Numéro de téléphone : $etu->TELEPHONE</p>
        <p>Adresse mail : $etu->MAIL</p>
        <p>Découvert autorisé : $etu->DECOUVERT €</p>
        <p>Découvert autorisé restant : $restant €</p>

    </fieldset>
     <br>");

    echo("<form action='index.php' method='post'><button type='submit' name='affadm'>Retour vers l'accueil</button><form action='index.php' method='post'>");
}

function CtlSyntheseEtu($nom)
{
    $etu = rechercherEtudiant($nom);
    $restant = $etu->DECOUVERT - getMontantEnDiffere($etu->ID_ETUDIANT);
    echo("
    <fieldset>
    <legend>Synthèse de $etu->NOM $etu->PRENOM :</legend>

        <p>Numéro étudiant : $etu->ID_ETUDIANT </p>
        <p>Nom : $etu->NOM</p>
        <p>Prénom : $etu->PRENOM</p>
        <p>Date de naissance : $etu->DATE_NAISSANCE</p>
        <p>Adresse : $etu->ADRESSE</p>
        <p>Numéro de téléphone : $etu->TELEPHONE</p>
        <p>Adresse mail : $etu->MAIL</p>
        <p>Découvert autorisé : $etu->DECOUVERT €</p>
        <p>Découvert autorisé restant : $restant €</p>

    </fieldset>
     <br>");

    echo("<form action='index.php' method='post'><button type='submit' name='affacc'>Retour vers l'accueil</button><form action='index.php' method='post'>");
}


